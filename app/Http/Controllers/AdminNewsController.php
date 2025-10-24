<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Jobs\PostToFacebookJob;

class AdminNewsController extends Controller
{
    public function dashboard()
    {
        // Get statistics
        $totalNews = News::count();
        $publishedNews = News::where('status', 'published')->count();
        $draftNews = News::where('status', 'draft')->count();
        $totalCategories = Category::count();

        // Get recent news (last 10)
        $recentNews = News::with(['category', 'author'])
            ->latest()
            ->limit(10)
            ->get();

        // Get categories with news count
        $categories = Category::withCount('news')
            ->active()
            ->ordered()
            ->get();

        return view('admin.news-dashboard', compact(
            'totalNews',
            'publishedNews', 
            'draftNews',
            'totalCategories',
            'recentNews',
            'categories'
        ));
    }

    public function index()
    {
        $news = News::with(['author', 'category'])
            ->latest()
            ->paginate(15);
        
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::with('parent')->active()->ordered()->get();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Normalize youtube_url to include scheme if missing
        if ($request->filled('youtube_url')) {
            $normalized = trim((string) $request->input('youtube_url'));
            if ($normalized !== '' && !preg_match('/^https?:\/\//i', $normalized)) {
                $request->merge(['youtube_url' => 'https://' . $normalized]);
            }
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'youtube_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published',
            'category_id' => 'nullable|exists:categories,id'
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'excerpt.max' => 'Tóm tắt không được vượt quá 500 ký tự.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif hoặc webp.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'content_images.*.image' => 'File phải là hình ảnh.',
            'content_images.*.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif hoặc webp.',
            'content_images.*.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'youtube_url.url' => 'Đường dẫn YouTube không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'category_id.exists' => 'Danh mục không tồn tại.'
        ]);

        try {
            DB::beginTransaction();

            $news = new News();
            $news->title = $request->title;
            $news->content = $request->content;
            $news->excerpt = $request->excerpt;
            $news->youtube_url = $request->youtube_url;
            $news->status = $request->status;
            $news->author_id = Auth::id();
            $news->category_id = $request->category_id;
            
            // Generate slug
            $news->slug = \Illuminate\Support\Str::slug($request->title);
            
            // Handle main image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . \Illuminate\Support\Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('news', $imageName, 'public');
                $news->image = $imageName;
            }

            $news->save();

            // Handle content images upload
            if ($request->hasFile('content_images')) {
                $contentImages = [];
                foreach ($request->file('content_images') as $index => $image) {
                    $imageName = time() . '_' . $index . '_' . \Illuminate\Support\Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('news/content', $imageName, 'public');
                    $contentImages[] = $imageName;
                }
                
                // Update content with image URLs
                $content = $news->content;
                foreach ($contentImages as $index => $imageName) {
                    $placeholder = '[IMAGE_' . ($index + 1) . ':';
                    $replacement = '<img src="' . asset('storage/news/content/' . $imageName) . '" alt="Content Image" style="max-width: 100%; height: auto; margin: 10px 0; border-radius: 8px;">';
                    $content = str_replace($placeholder, $replacement, $content);
                }
                $news->content = $content;
                $news->save();
            }
            
            DB::commit();
            
            // Dispatch Facebook post job AFTER commit
            if ($news->status === 'published') {
                Log::info('Dispatching Facebook post job for news (AdminNewsController)', [
                    'news_id' => $news->id,
                    'title' => $news->title,
                    'status' => $news->status
                ]);
                PostToFacebookJob::dispatch($news);
            } else {
                Log::info('News not published, skipping Facebook post (AdminNewsController)', [
                    'news_id' => $news->id,
                    'status' => $news->status
                ]);
            }
            
            return redirect()->route('admin.news.dashboard')
                ->with('success', 'Tạo bài viết thành công!');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Tạo bài viết thất bại: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::with('parent')->active()->ordered()->get();
        
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        // Normalize youtube_url to include scheme if missing
        if ($request->filled('youtube_url')) {
            $normalized = trim((string) $request->input('youtube_url'));
            if ($normalized !== '' && !preg_match('/^https?:\/\//i', $normalized)) {
                $request->merge(['youtube_url' => 'https://' . $normalized]);
            }
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'youtube_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published',
            'category_id' => 'nullable|exists:categories,id'
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'excerpt.max' => 'Tóm tắt không được vượt quá 500 ký tự.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif hoặc webp.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'content_images.*.image' => 'File phải là hình ảnh.',
            'content_images.*.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif hoặc webp.',
            'content_images.*.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'youtube_url.url' => 'Đường dẫn YouTube không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'category_id.exists' => 'Danh mục không tồn tại.'
        ]);

        try {
            DB::beginTransaction();

            $news->title = $request->title;
            $news->content = $request->content;
            $news->excerpt = $request->excerpt;
            $news->youtube_url = $request->youtube_url;
            $news->status = $request->status;
            $news->category_id = $request->category_id;
            
            // Update slug if title changed
            if ($news->isDirty('title')) {
                $news->slug = \Illuminate\Support\Str::slug($request->title);
            }
            
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image
                if ($news->image && \Illuminate\Support\Facades\Storage::disk('public')->exists('news/' . $news->image)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('news/' . $news->image);
                }
                
                $image = $request->file('image');
                $imageName = time() . '_' . \Illuminate\Support\Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('news', $imageName, 'public');
                $news->image = $imageName;
            }

            $news->save();

            // Handle content images upload
            if ($request->hasFile('content_images')) {
                $contentImages = [];
                foreach ($request->file('content_images') as $index => $image) {
                    $imageName = time() . '_' . $index . '_' . \Illuminate\Support\Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('news/content', $imageName, 'public');
                    $contentImages[] = $imageName;
                }
                
                // Update content with image URLs
                $content = $news->content;
                foreach ($contentImages as $index => $imageName) {
                    $placeholder = '[IMAGE_' . ($index + 1) . ':';
                    $replacement = '<img src="' . asset('storage/news/content/' . $imageName) . '" alt="Content Image" style="max-width: 100%; height: auto; margin: 10px 0; border-radius: 8px;">';
                    $content = str_replace($placeholder, $replacement, $content);
                }
                $news->content = $content;
                $news->save();
            }
            
            DB::commit();
            
            // Dispatch Facebook post job if news status changed to published AFTER commit
            if ($news->status === 'published' && $news->wasChanged('status')) {
                Log::info('Dispatching Facebook post job for updated news (AdminNewsController)', [
                    'news_id' => $news->id,
                    'title' => $news->title,
                    'status' => $news->status
                ]);
                PostToFacebookJob::dispatch($news);
            }
            
            return redirect()->route('admin.news.dashboard')
                ->with('success', 'Cập nhật bài viết thành công!');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Cập nhật bài viết thất bại: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        
        try {
            DB::beginTransaction();
            
            // Delete image if exists
            if ($news->image && \Illuminate\Support\Facades\Storage::disk('public')->exists('news/' . $news->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete('news/' . $news->image);
            }
            
            $news->delete();
            
            DB::commit();
            
            return redirect()->route('admin.news.dashboard')
                ->with('success', 'Xóa bài viết thành công!');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Xóa bài viết thất bại: ' . $e->getMessage());
        }
    }

    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ], [
                'upload.required' => 'Vui lòng chọn file ảnh.',
                'upload.image' => 'File phải là hình ảnh.',
                'upload.mimes' => 'File phải có định dạng jpeg, png, jpg, gif hoặc webp.',
                'upload.max' => 'Kích thước file không được vượt quá 2MB.'
            ]);

            $image = $request->file('upload');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('news/content', $imageName, 'public');
            
            $url = Storage::url($imagePath);
            
            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'uploaded' => false,
                'error' => [
                    'message' => 'Validation failed',
                    'details' => $e->errors()
                ]
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'uploaded' => false,
                'error' => [
                    'message' => 'Lỗi khi upload ảnh: ' . $e->getMessage()
                ]
            ], 500);
        }
    }
}
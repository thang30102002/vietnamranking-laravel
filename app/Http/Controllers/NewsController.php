<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    // Public methods - for viewing news
    public function index()
    {
        // Hot news (most viewed in last 7 days)
        $hotNews = News::published()
            ->with(['author', 'category'])
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        // Latest news
        $latestNews = News::published()
            ->with(['author', 'category'])
            ->latest()
            ->take(10)
            ->get();

        // Featured news (with images)
        $featuredNews = News::published()
            ->with(['author', 'category'])
            ->whereNotNull('image')
            ->latest()
            ->take(6)
            ->get();

        // Category-based news
        $categories = Category::with(['news' => function($query) {
            $query->published()->latest()->take(3);
        }])->active()->ordered()->get();

        // All news for pagination
        $news = News::published()
            ->with(['author', 'category'])
            ->latest()
            ->paginate(12);
        
        return view('news.index', compact('news', 'hotNews', 'latestNews', 'featuredNews', 'categories'));
    }

    public function show($slug)
    {
        $news = News::published()
            ->where('slug', $slug)
            ->with(['author', 'category', 'comments'])
            ->firstOrFail();
        
        // Increment views
        $news->incrementViews();
        
        // Get related news
        $relatedNews = News::published()
            ->where('id', '!=', $news->id)
            ->latest()
            ->limit(3)
            ->get();
        
        return view('news.show', compact('news', 'relatedNews'));
    }

    // Admin methods - for managing news
    public function adminIndex()
    {
        $news = News::with(['author', 'category', 'topic'])
            ->latest()
            ->paginate(10);
        
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::with('parent')->active()->ordered()->get();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'category_id' => 'nullable|exists:categories,id'
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'excerpt.max' => 'Tóm tắt không được vượt quá 500 ký tự.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'File phải có định dạng jpeg, png, jpg, gif.',
            'image.max' => 'Dung lượng file không được vượt quá 2MB.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        try {
            DB::beginTransaction();

            $news = new News();
            $news->title = $request->title;
            $news->content = $request->content;
            $news->excerpt = $request->excerpt;
            $news->status = $request->status;
            $news->author_id = Auth::id();
            $news->category_id = $request->category_id;
            
            // Generate slug
            $news->slug = Str::slug($request->title);
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('news', $imageName, 'public');
                $news->image = $imageName;
            }

            $news->save();
            
            DB::commit();
            
            return redirect()->route('admin.news.index')
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
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        try {
            DB::beginTransaction();

            $news->title = $request->title;
            $news->content = $request->content;
            $news->excerpt = $request->excerpt;
            $news->status = $request->status;
            $news->category_id = $request->category_id;
            
            // Update slug if title changed
            if ($news->isDirty('title')) {
                $news->slug = Str::slug($request->title);
            }
            
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image
                if ($news->image) {
                    Storage::disk('public')->delete('news/' . $news->image);
                }
                
                $image = $request->file('image');
                $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('news', $imageName, 'public');
                $news->image = $imageName;
            }

            $news->save();
            
            DB::commit();
            
            return redirect()->route('admin.news.index')
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
            
            // Delete image
            if ($news->image) {
                Storage::disk('public')->delete('news/' . $news->image);
            }
            
            $news->delete();
            
            DB::commit();
            
            return redirect()->route('admin.news.index')
                ->with('success', 'Xóa bài viết thành công!');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Xóa bài viết thất bại: ' . $e->getMessage());
        }
    }

    // Legacy methods for backward compatibility
    public function showAll()
    {
        return $this->adminIndex();
    }

    public function showEdit($id)
    {
        return $this->edit($id);
    }

    public function showCreate()
    {
        return $this->create();
    }
}


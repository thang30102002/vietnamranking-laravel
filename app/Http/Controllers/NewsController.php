<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Jobs\PostToFacebookJob;
use App\Models\Comment;

class NewsController extends Controller
{
    // Public methods - for viewing news
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));

        // Hot news (most viewed in last 7 days) - cached
        $hotNews = Cache::remember('news_hot_5', 600, function() {
            return News::published()
                ->select(['id','title','slug','image','views','created_at','category_id','author_id','status','excerpt'])
                ->with([
                    'author',
                    'category:id,name,color'
                ])
                ->where('created_at', '>=', now()->subDays(7))
                ->orderBy('views', 'desc')
                ->take(5)
                ->get();
        });

        // Latest news
        $latestNews = Cache::remember('news_latest_10', 600, function() {
            return News::published()
                ->select(['id','title','slug','image','views','created_at','category_id','author_id','status','excerpt'])
                ->with([
                    'author',
                    'category:id,name,color'
                ])
                ->latest()
                ->take(10)
                ->get();
        });

        // Featured news (with images)
        $featuredNews = Cache::remember('news_featured_6', 600, function() {
            return News::published()
                ->select(['id','title','slug','image','views','created_at','category_id','author_id','status'])
                ->with([
                    'author',
                    'category:id,name,color'
                ])
                ->whereNotNull('image')
                ->latest()
                ->take(6)
                ->get();
        });

        // Category-based news (only parent categories)
        $categories = Cache::remember('news_categories_tree', 600, function() {
            return Category::with([
                'news' => function($query) {
                    $query->published()->latest()->take(3);
                }, 
                'children' => function($query) {
                    $query->active()->ordered()->withCount('news');
                }
            ])->whereNull('parent_id')->active()->ordered()->withCount('news')->get();
        });

        // Search results (when query present)
        $searchResults = null;
        if ($search !== '') {
            $searchResults = News::published()
                ->with(['author', 'category'])
                ->where(function($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(12)
                ->withQueryString();
        }
        
        return view('news.index', [
            'hotNews' => $hotNews,
            'latestNews' => $latestNews,
            'featuredNews' => $featuredNews,
            'categories' => $categories,
            'search' => $search,
            'searchResults' => $searchResults,
        ]);
    }

    public function show($slug)
    {
        $news = News::published()
            ->where('slug', $slug)
            ->with([
                'author', 
                'category', 
                'comments.user.player', 
                'comments.user.user_role', 
                'comments.user.admin_tournament',
                'comments.children.user.player',
                'comments.children.user.user_role',
                'comments.children.user.admin_tournament',
                'comments.children.children' // eager a second level; deeper will lazy load in view if present
            ])
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

    public function comment(Request $request, $slug)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $news = News::where('slug', $slug)->firstOrFail();

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'news_id' => $news->id,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('news.show', $slug)->with('success', 'Đã gửi bình luận.');
    }

    // Admin methods - for managing news
    public function adminIndex()
    {
        $news = News::with(['author', 'category'])
            ->latest()
            ->paginate(10);
        
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->active()->ordered()->get();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'youtube_url' => 'nullable|url|max:255',
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
            'youtube_url.url' => 'Đường dẫn YouTube không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
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
            
            // Dispatch Facebook post job AFTER commit
            if ($news->status === 'published') {
                Log::info('Dispatching Facebook post job for news', [
                    'news_id' => $news->id,
                    'title' => $news->title,
                    'status' => $news->status
                ]);
                PostToFacebookJob::dispatch($news);
            } else {
                Log::info('News not published, skipping Facebook post', [
                    'news_id' => $news->id,
                    'status' => $news->status
                ]);
            }
            
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
        $categories = Category::whereNull('parent_id')->active()->ordered()->get();
        
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'youtube_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published',
            'category_id' => 'nullable|exists:categories,id'
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
            
            // Dispatch Facebook post job if news status changed to published AFTER commit
            if ($news->status === 'published' && $news->wasChanged('status')) {
                Log::info('Dispatching Facebook post job for updated news', [
                    'news_id' => $news->id,
                    'title' => $news->title,
                    'status' => $news->status
                ]);
                PostToFacebookJob::dispatch($news);
            }
            
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

    // API method to get news by category
    public function getByCategory($categoryId)
    {
        try {
            if ($categoryId === 'all') {
                $news = News::published()
                    ->with(['author', 'category'])
                    ->latest()
                    ->take(20)
                    ->get();
            } else {
                $category = Category::with('children')->find($categoryId);
                if (!$category) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Chủ đề không tồn tại'
                    ], 404);
                }
                
                // Get category IDs (parent + children)
                $categoryIds = [$category->id];
                if ($category->children->count() > 0) {
                    $categoryIds = array_merge($categoryIds, $category->children->pluck('id')->toArray());
                }
                
                $news = News::published()
                    ->with(['author', 'category'])
                    ->whereIn('category_id', $categoryIds)
                    ->latest()
                    ->take(20)
                    ->get();
            }

            return response()->json([
                'success' => true,
                'data' => $news,
                'count' => $news->count(),
                'category_name' => $categoryId !== 'all' ? $category->name : 'Tất cả chủ đề'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi tải tin tức: ' . $e->getMessage()
            ], 500);
        }
    }

    // API method to get child categories
    public function getChildCategories($categoryId)
    {
        try {
            $category = Category::with('children')->find($categoryId);
            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Chủ đề không tồn tại'
                ], 404);
            }

            $children = $category->children->map(function($child) {
                return [
                    'id' => $child->id,
                    'name' => $child->name,
                    'color' => $child->color,
                    'news_count' => $child->news->count()
                ];
            });

            return response()->json([
                'success' => true,
                'children' => $children,
                'parent_name' => $category->name
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi tải chủ đề con: ' . $e->getMessage()
            ], 500);
        }
    }
}


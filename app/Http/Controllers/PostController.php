<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Post_comment;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('post_images')->orderBy('created_at', 'desc')->paginate(5);
        return view('community', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'content' => ['required'],
        ], [
            'content.max' => 'Nội dung không được vượt quá 255 kí tự.',
            'content.required' => 'Nội dung không được để trống.',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $post = Post::create([
                    'content' => $request->content,
                    'user_id' => auth()->user()->id,
                    'status' => 1,
                    'slug' => 'post-' . time(),
                ]);
                if($request->file('files'))
                {
                    foreach ($request->file('files') as $file) {
                        $filePath = $file->store('posts/' . $post->id, 'public');
                        $post->post_images()->create([
                            'image' => $filePath,
                            'post_id' => $post->id,
                        ]);
                    }
                }
                
            });

            return back()->with('success', 'Đăng tải bài viết thành công.');
        } catch (\Exception $e) {
            return back()->with('error', 'Đăng tải bài viết không thành công.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $postId)
    {
        // Eager load bình luận và sắp xếp theo ngày tạo mới nhất
        $post = Post::with(['post_comments' => function($query) {
            $query->orderBy('created_at', 'desc'); // Sắp xếp bình luận theo ngày tạo mới nhất
        }])->find($postId);

        if (!$post) {
            abort(404, 'Post not found');
        }

        // Lấy các bình luận đã được sắp xếp
        $comments = $post->post_comments->where('parent_id', null);

        return view('post/post-detail', ['post'=> $post, 'comments'=>$comments]); 
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $postId, Request $request)
    {
        $post = Post::find($postId);
        try {
            DB::transaction(function () use ($request, $post) {
                // Cập nhật nội dung bài viết
                $post->update([
                    'content' => $request->content,
                ]);
                if($request->file('files'))
                {
                    // Xóa tất cả ảnh cũ trong storage và database
                    foreach ($post->post_images as $image) {
                        Storage::disk('public')->delete($image->image); // Xóa file vật lý
                        $image->delete(); // Xóa record trong database
                    }

                    // Thêm ảnh mới nếu có
                    if ($request->hasFile('files')) {
                        foreach ($request->file('files') as $file) {
                            $filePath = $file->store('posts/' . $post->id, 'public');
                            $post->post_images()->create([
                                'image' => $filePath,
                                'post_id' => $post->id,
                            ]);
                        }
                    }
                }
            });

            return back()->with('success', 'Cập nhật bài viết thành công.');
        } catch (\Exception $e) {
            return back()->with('error', 'Cập nhật bài viết không thành công.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $postId)
    {
        try
        {
            DB::transaction(function () use ($postId) {
                $post = Post::find($postId);
                if ($post) {
                    // Xóa tất cả ảnh trong storage và database
                    foreach ($post->post_images as $image) {
                        Storage::disk('public')->delete($image->image); // Xóa file vật lý
                        $image->delete(); // Xóa record trong database
                    }
                    // Xóa bài viết
                    $post->delete();
                }
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Xóa bài viết không thành công.');
        }

        return back()->with('success', 'Xóa bài viết thành công.');
    }
}

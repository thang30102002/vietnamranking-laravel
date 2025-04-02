<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Post_comment;

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
            'content' => ['required', 'max:255'],
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
                
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $image->move(public_path('images/posts'), $imageName);
                        $post->post_images()->create([
                            'image' => $imageName,
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function like($postId)
    {
        // Lấy bài viết cần like
        $post = Post::find($postId);
        $user = Auth::user();

        // Kiểm tra nếu user đã like bài viết này chưa
        $like = Like::where('user_id', $user->id)->where('post_id', $postId)->first();

        if ($like) {
            // Nếu đã like thì bỏ like (Unlike)
            $like->delete();
            $liked = false;
        } else {
            // Nếu chưa like thì thêm vào database
            Like::create([
                'user_id' => $user->id,
                'post_id' => $postId,
            ]);
            $liked = true;
        }

        // Trả về số lượt like mới
        $likeCount = Like::where('post_id', $postId)->count();

        return response()->json([
            'status' => 'success',
            'liked' => $liked,
            'likeCount' => $likeCount,
        ]);
    }

    public function comment(Request $request,$postId)
    {
        $user = auth()->user();
        $comment = Post_comment::create([
        'user_id' => $user->id,
        'post_id' => $postId,
        'content' => $request->comment,
        'parent_id' => isset($request->parent_id) ? $request->parent_id : null,
        ]);
        if($comment)
        {
            return back()->with('success','Bình luận bài viết thành công');
        }
        else
        {
            return back()->with('error','Bình luận bài viết thất bại');
        }
    }
}

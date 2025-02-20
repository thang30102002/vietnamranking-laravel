<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Topic;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(5);
        return view('news.index', compact('news'));
    }

    public function showAll()
    {
        $news = News::latest()->paginate(5);
        return view('admin.showAllNews', compact('news'));
    }

    public function showEdit($id)
    {
        $news = News::where('id', $id)->firstOrFail();
        return view('admin.showEditNews', compact('news'));
    }

    public function showCreate()
    {
        $topics = Topic::all();
        return view('admin.createNews', compact('topics'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'slug' => ['required'],
            'content' => ['required'],
            'img' => ['image', 'mimes:jpeg,png,jpg', 'max:2048', 'required'],
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'slug.required' => 'Vui lòng nhập slug.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'img.image' => 'File phải là hình ảnh.',
            'img.mimes' => 'File phải có định dạng jpeg, png, jpg.',
            'img.max' => 'Dung lượng file không được vượt quá 2MB.',
            'img.required' => 'Vui lòng chọn ảnh.',
        ]);
        try {
            $fileName = $request->slug . '.' . $request->file('img')->extension();
            // Lấy tất cả các file trong thư mục (không bao gồm thư mục con)
            $files = Storage::disk('public')->files('news/' . $request->slug);

            // Xóa tất cả các file
            foreach ($files as $file) {
                Storage::disk('public')->delete($file);
            }
            // Lưu file ảnh
            $file = $request->file('img');
            $filePath = $file->storeAs('news/' . $request->slug, $fileName, 'public');
            DB::transaction(function () {});
            $news = News::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'image' => $fileName,
                'topic_id' => $request->topic_id,
            ]);
            $news->save();
            return redirect()->route('news.showAll')->with('success', 'Thêm bài viết thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Thêm bài viết thất bại!');
        }
    }

    public function store(Request $request, $id)
    {
        $news = News::find($id);
        $request->validate([
            'title' => ['required'],
            'slug' => ['required'],
            'content' => ['required'],
            'img' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'slug.required' => 'Vui lòng nhập slug.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'img.image' => 'File phải là hình ảnh.',
            'img.mimes' => 'File phải có định dạng jpeg, png, jpg.',
            'img.max' => 'Dung lượng file không được vượt quá 2MB.',
        ]);
        try {
            DB::transaction(function () use ($request, $news) {

                if ($request->img != null) {
                    $fileName = $news->slug . '.' . $request->file('img')->extension();

                    Storage::disk('public')->deleteDirectory('news/' . $news->slug);
                    // Lưu file ảnh
                    $file = $request->file('img');
                    $filePath = $file->storeAs('news/' . $news->slug, $fileName, 'public');
                    $news->image = $fileName;
                }

                $news->title = $request->title;
                $news->slug = $request->slug;
                $news->content = $request->content;
                $news->save();
            });
            return redirect()->route('news.showAll')->with('success', 'Sửa bài viết thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Sửa bài viết thất bại!');
        }
    }

    public function delete($id)
    {
        $news = News::find($id);

        if (!$news) {
            return redirect()->route('news.showAll')->with('error', 'Bài viết không tồn tại!');
        }
        try {
            $slug = $news->slug;
            $news->delete();
            // Xóa thư mục chứa các tệp liên quan đến bài viết
            Storage::disk('public')->deleteDirectory('news/' . $slug);

            return back()->with('success', 'Xoá bài viết thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Xoá bài viết thất bại!');
        }
    }
}

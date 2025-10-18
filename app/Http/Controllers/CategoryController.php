<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Admin methods - for managing categories
    public function index()
    {
        $categories = Category::withCount('news')
            ->with(['parent', 'children'])
            ->ordered()
            ->paginate(15);
        
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::root()->active()->ordered()->get();
        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
            'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'parent_id' => 'nullable|exists:categories,id'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            'color.regex' => 'Mã màu không hợp lệ (ví dụ: #FF0000).',
            'icon.max' => 'Tên icon không được vượt quá 100 ký tự.',
            'sort_order.integer' => 'Thứ tự sắp xếp phải là số nguyên.',
            'sort_order.min' => 'Thứ tự sắp xếp không được nhỏ hơn 0.'
        ]);

        try {
            DB::beginTransaction();

            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->color = $request->color ?: '#21324C';
            $category->is_active = $request->has('is_active');
            $category->sort_order = $request->sort_order ?: 0;
            $category->parent_id = $request->parent_id;
            
            // Generate slug
            $category->slug = Str::slug($request->name);

            $category->save();
            
            DB::commit();
            
            return redirect()->route('admin.categories.index')
                ->with('success', 'Tạo danh mục thành công!');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Tạo danh mục thất bại: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $parentCategories = Category::root()->active()->ordered()->where('id', '!=', $id)->get();
        
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string|max:1000',
            'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'parent_id' => 'nullable|exists:categories,id|different:' . $id
        ]);

        try {
            DB::beginTransaction();

            $category->name = $request->name;
            $category->description = $request->description;
            $category->color = $request->color ?: '#21324C';
            $category->is_active = $request->has('is_active');
            $category->sort_order = $request->sort_order ?: 0;
            $category->parent_id = $request->parent_id;
            
            // Update slug if name changed
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($request->name);
            }

            $category->save();
            
            DB::commit();
            
            return redirect()->route('admin.categories.index')
                ->with('success', 'Cập nhật danh mục thành công!');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Cập nhật danh mục thất bại: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        try {
            DB::beginTransaction();
            
            // Check if category has news
            if ($category->hasNews()) {
                return back()->with('error', 'Không thể xóa danh mục có chứa tin tức. Vui lòng di chuyển hoặc xóa các tin tức trước.');
            }
            
            $category->delete();
            
            DB::commit();
            
            return redirect()->route('admin.categories.index')
                ->with('success', 'Xóa danh mục thành công!');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Xóa danh mục thất bại: ' . $e->getMessage());
        }
    }

    // Toggle active status
    public function toggleStatus($id)
    {
        $category = Category::findOrFail($id);
        
        try {
            $category->is_active = !$category->is_active;
            $category->save();
            
            $status = $category->is_active ? 'kích hoạt' : 'vô hiệu hóa';
            return back()->with('success', "Đã {$status} danh mục thành công!");
            
        } catch (\Exception $e) {
            return back()->with('error', 'Cập nhật trạng thái thất bại: ' . $e->getMessage());
        }
    }

    // Public method - get categories for dropdown
    public function getCategories()
    {
        return Category::active()->ordered()->get();
    }
}
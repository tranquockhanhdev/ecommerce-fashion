<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::all();
        return view('admin.qldanhmuc.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.qldanhmuc.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'unique:category',
            'slug' => 'unique:category',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/category');
        }

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagePath ? str_replace('public/', 'storage/', $imagePath) : null,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.qldanhmuc.index')->with('success', 'Danh mục đã được thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->get();

        return view('admin.qldanhmuc.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                function ($attribute, $value, $fail) use ($id) {
                    if (Category::where('name', $value)->where('id', '!=', $id)->exists()) {
                        $fail('Tên danh mục đã tồn tại.');
                    }
                }
            ]
        ]);

        $category = Category::findOrFail($id);

        // Cập nhật ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/category');
            $category->image = str_replace('public/', 'storage/', $imagePath);
        }

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.qldanhmuc.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $category = Category::findOrFail($id);

    // Xóa tất cả sản phẩm thuộc danh mục này
    $category->products()->delete();  // Xóa tất cả sản phẩm thuộc danh mục này

    // Xóa danh mục
    $category->delete();

    return redirect()->route('admin.qldanhmuc.index')->with('success', 'Danh mục và tất cả sản phẩm đã được xóa thành công.');
}
}

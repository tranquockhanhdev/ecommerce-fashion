<?php

namespace App\Http\Controllers;

use App\Models\ColorProduct;
use App\Models\Category;
use App\Models\SizeProduct;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    // Hiển thị danh sách màu sắc
    public function index()
    {

        $categories = Category::all(); // Lấy danh mục sản phẩm
        $colors = ColorProduct::all(); // Lấy danh sách màu sắc (nếu cần)
        $sizes = SizeProduct::all(); // Lấy danh sách kích thước (nếu cần)
        return view('admin.qlsanpham.create', compact('categories', 'colors', 'sizes'));
    }

    // Hiển thị form thêm màu sắc mới
    public function create()
    {
        $colors = ColorProduct::all(); // Lấy danh sách màu sắc (nếu cần)
        return view('admin.qlmau.create', compact('colors'));
    }

    // Lưu màu sắc mới
    public function store(Request $request)
    {
        $request->validate([
            'color_name' => 'required|string|max:255',
        ]);

        // Tạo màu mới
        ColorProduct::create([
            'color_name' => $request->color_name,
        ]);

        // Chuyển hướng về trang thêm sản phẩm
        return redirect()->route('products.create')->with('success', 'Màu đã được thêm thành công!');
    }


    // Hiển thị form sửa màu sắc
    public function edit($id)
    {
        $color = ColorProduct::findOrFail($id);
        return view('admin.colors.edit', compact('color'));
    }

    // Cập nhật màu sắc
    public function update(Request $request, $id)
    {
        $request->validate([
            'color_name' => 'required|string|max:255',
        ]);

        $color = ColorProduct::findOrFail($id);
        $color->update([
            'color_name' => $request->color_name,
        ]);

        return redirect()->route('colors.index')->with('success', 'Màu sắc đã được cập nhật!');
    }

    // Xóa màu sắc
    public function destroy($id)
    {
        $color = ColorProduct::findOrFail($id);
        $color->delete();

        return redirect()->route('colors.index')->with('success', 'Màu sắc đã được xóa!');
    }
}

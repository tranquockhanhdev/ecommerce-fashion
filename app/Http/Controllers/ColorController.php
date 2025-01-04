<?php

namespace App\Http\Controllers;

use App\Models\ColorProduct;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    // Hiển thị danh sách màu sắc
    public function index()
    {
        $colors = ColorProduct::all();
        return view('admin.colors.index', compact('colors'));
    }

    // Hiển thị form thêm màu sắc mới
    public function create()
    {
        return view('admin.colors.create');
    }

    // Lưu màu sắc mới
    public function store(Request $request)
    {
        $request->validate([
            'color_name' => 'required|string|max:255',
        ]);

        ColorProduct::create([
            'color_name' => $request->color_name,
        ]);

        return redirect()->route('colors.index')->with('success', 'Màu sắc đã được thêm thành công!');
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

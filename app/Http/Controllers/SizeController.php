<?php

namespace App\Http\Controllers;

use App\Models\SizeProduct;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    // Hiển thị danh sách kích thước
    public function index()
    {
        $sizes = SizeProduct::all();
        return view('admin.sizes.index', compact('sizes'));
    }

    // Hiển thị form thêm kích thước mới
    public function create()
    {
        return view('admin.sizes.create');
    }

    // Lưu kích thước mới
    public function store(Request $request)
    {
        $request->validate([
            'size_name' => 'required|string|max:255',
        ]);

        SizeProduct::create([
            'size_name' => $request->size_name,
        ]);

        return redirect()->route('sizes.index')->with('success', 'Kích thước đã được thêm thành công!');
    }

    // Hiển thị form sửa kích thước
    public function edit($id)
    {
        $size = SizeProduct::findOrFail($id);
        return view('admin.sizes.edit', compact('size'));
    }

    // Cập nhật kích thước
    public function update(Request $request, $id)
    {
        $request->validate([
            'size_name' => 'required|string|max:255',
        ]);

        $size = SizeProduct::findOrFail($id);
        $size->update([
            'size_name' => $request->size_name,
        ]);

        return redirect()->route('sizes.index')->with('success', 'Kích thước đã được cập nhật!');
    }

    // Xóa kích thước
    public function destroy($id)
    {
        $size = SizeProduct::findOrFail($id);
        $size->delete();

        return redirect()->route('sizes.index')->with('success', 'Kích thước đã được xóa!');
    }
}

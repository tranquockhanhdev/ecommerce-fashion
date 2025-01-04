<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ColorProduct;
use App\Models\SizeProduct;
use App\Models\ProductDetail;
use App\Models\ImageProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách sản phẩm kèm danh mục, ảnh, màu sắc và kích thước
        $products = Product::with(['category', 'images', 'details.color', 'details.size'])->get();

        // Trả về view kèm dữ liệu
        return view('admin.qlsanpham.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lấy tất cả danh mục, màu sắc và kích thước
        $categories = Category::all();
        $colors = ColorProduct::all();
        $sizes = SizeProduct::all();

        return view('admin.qlsanpham.create', compact('categories', 'colors', 'sizes'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'color_id' => 'required|exists:color_product,id',
            'size_id' => 'required|exists:size_product,id',
        ]);

        // Thêm sản phẩm mới
        $product = Product::create($validatedData);

        // Thêm hình ảnh sản phẩm
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'link' => $path,
                ]);
            }
        }

        // Thêm chi tiết sản phẩm (màu và kích thước)
        $product->details()->create([
            'colorproduct_id' => $request->color_id,
            'sizeproduct_id' => $request->size_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công!');
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
}

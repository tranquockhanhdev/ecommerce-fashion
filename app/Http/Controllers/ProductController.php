<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ColorProduct;
use App\Models\SizeProduct;
use App\Models\ProductDetail;
use App\Models\ImageProduct;
use Illuminate\Support\Facades\Storage;

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
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'color_ids' => 'nullable|array',
            'color_ids.*' => 'exists:color_product,id',
            'size_ids' => 'nullable|array',
            'size_ids.*' => 'exists:size_product,id',
        ]);

        // Create new product
        $newProduct = Product::create($validatedData);

        // Handle images
        if ($files = $request->file('images')) {
            $imageData = [];
            foreach ($files as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $path = 'products';
                $filePath = $file->storeAs($path, $filename, 'public');

                $imageData[] = [
                    'product_id' => $newProduct->id,
                    'link' => 'storage/' . $filePath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            ImageProduct::insert($imageData);
        }

        // Add color and size combinations to product details
        if ($request->has('color_ids') || $request->has('size_ids')) {
            $colorIds = $request->has('color_ids') ? array_unique($request->color_ids) : [null];
            $sizeIds = $request->has('size_ids') ? array_unique($request->size_ids) : [null];

            foreach ($colorIds as $colorId) {
                foreach ($sizeIds as $sizeId) {
                    // Check if the combination already exists
                    $existingDetail = ProductDetail::where('product_id', $newProduct->id)
                        ->where('colorproduct_id', $colorId)
                        ->where('sizeproduct_id', $sizeId)
                        ->first();

                    // If it doesn't exist, insert the combination
                    if (!$existingDetail) {
                        ProductDetail::create([
                            'product_id' => $newProduct->id,
                            'colorproduct_id' => $colorId,
                            'sizeproduct_id' => $sizeId,
                        ]);
                    }
                }
            }
        }

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
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Lấy sản phẩm cần chỉnh sửa cùng với danh mục, màu sắc, kích thước và hình ảnh
        $product = Product::with(['category', 'details.color', 'details.size', 'images'])->findOrFail($id);
        $categories = Category::all();
        $colors = ColorProduct::all();
        $sizes = SizeProduct::all();

        // Trả về view chỉnh sửa sản phẩm
        return view('admin.qlsanpham.edit', compact('product', 'categories', 'colors', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function deleteImage($imageId)
    {
        // Find the image by its ID
        $image = ImageProduct::findOrFail($imageId);

        // Delete the image file from storage
        Storage::disk('public')->delete(str_replace('storage/', '', $image->link));

        // Delete the image record from the database
        $image->delete();

        // Return a response indicating success
        return response()->json(['message' => 'Image deleted successfully.']);
    }

    public function update(Request $request, string $id)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'color_ids' => 'nullable|array',
            'color_ids.*' => 'exists:color_product,id',
            'size_ids' => 'nullable|array',
            'size_ids.*' => 'exists:size_product,id',
        ]);

        // Lấy sản phẩm cần cập nhật
        $product = Product::findOrFail($id);

        // Cập nhật thông tin cơ bản của sản phẩm
        $product->update($validatedData);

        // Cập nhật hình ảnh
        if ($files = $request->file('images')) {
            // Thêm hình ảnh mới
            $imageData = [];
            foreach ($files as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $path = 'products';
                $filePath = $file->storeAs($path, $filename, 'public');

                $imageData[] = [
                    'product_id' => $product->id,
                    'link' => 'storage/' . $filePath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Chỉ chèn hình ảnh mới vào database nếu có ảnh mới
            if (!empty($imageData)) {
                ImageProduct::insert($imageData);
            }
        }

        // Cập nhật các kết hợp màu sắc và kích thước
        if ($request->has('color_ids') || $request->has('size_ids')) {
            $colorIds = $request->has('color_ids') ? array_unique($request->color_ids) : [null];
            $sizeIds = $request->has('size_ids') ? array_unique($request->size_ids) : [null];

            // Xóa các chi tiết cũ không thuộc lựa chọn mới
            ProductDetail::where('product_id', $product->id)->delete();

            // Thêm các kết hợp mới
            foreach ($colorIds as $colorId) {
                foreach ($sizeIds as $sizeId) {
                    ProductDetail::create([
                        'product_id' => $product->id,
                        'colorproduct_id' => $colorId,
                        'sizeproduct_id' => $sizeId,
                    ]);
                }
            }
        }

        // Trả về trang danh sách sản phẩm với thông báo thành công
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

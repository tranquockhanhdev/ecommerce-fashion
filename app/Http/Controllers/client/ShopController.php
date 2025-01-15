<?php

namespace App\Http\Controllers\client;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductDetail;

class ShopController extends Controller
{
    // Controller
    public function index()
    {
        // Lấy danh sách sản phẩm cùng thông tin hình ảnh và bình luận (phân trang)
        $products = Product::where('status', 1) // Chỉ lấy sản phẩm có trạng thái là 1 (hiển thị)
            ->with(['images', 'comments'])
            ->paginate(10);

        // Biến đổi dữ liệu để chỉ lấy những thông tin cần thiết (name, price, image, rating)
        $productData = collect($products->items())->map(function ($product) {
            // Tính trung bình rating từ comments (nếu có)
            $averageRating = $product->comments->isNotEmpty() ? $product->comments->avg('rating') : 0;

            // Lấy ảnh đầu tiên (nếu có)
            $imageLink = $product->images->first() ? $product->images->first()->link : null;

            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'image' => $imageLink,
                'rating' => $averageRating,
            ];
        });

        // Trả về view với dữ liệu sản phẩm (bao gồm cả đối tượng phân trang)
        return view('client.shop.shop', [
            'productData' => $productData,
            'products' => $products, // Để dùng đối tượng phân trang trong view
        ]);
    }
    public function show($id)
    {
        // Lấy thông tin sản phẩm theo slug
        $product = Product::with('images')->where('slug', $id)->firstOrFail();

        // Lấy danh sách hình ảnh sản phẩm
        $imageProduct = $product->images->pluck('link');

        // Lấy thông tin chi tiết sản phẩm
        $productDetails = ProductDetail::with('color', 'size')
            ->where('product_id', $product->id)
            ->get();

        // Lọc danh sách màu sắc và kích thước duy nhất
        $colors = $productDetails->unique('colorproduct_id')->pluck('color');
        $sizes = $productDetails->unique('sizeproduct_id')->pluck('size');

        return view('client.shop.product-details', compact('product', 'imageProduct', 'productDetails', 'colors', 'sizes'));
    }
}

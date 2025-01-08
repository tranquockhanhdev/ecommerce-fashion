<?php

namespace App\Http\Controllers\client;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
        // Lấy danh sách sản phẩm cùng thông tin hình ảnh và đánh giá
        $products = Product::with(['images', 'comments'])->get();

        // Biến đổi dữ liệu để chỉ lấy những thông tin cần thiết (name, price, image, rating)
        $productData = $products->map(function ($product) {
            // Tính trung bình rating từ comments
            $averageRating = $product->comments->avg('rating'); // Tính trung bình rating

            // Lấy ảnh đầu tiên (nếu có)
            $imageLink = $product->images->first() ? $product->images->first()->link : null;

            return [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $imageLink, // Lấy link ảnh đầu tiên từ bảng images
                'rating' => $averageRating,
            ];
        });

        // Trả về view với dữ liệu sản phẩm
        return view('client.shop.shop', compact('productData'));
    }
}

<?php

namespace App\Http\Controllers\client;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    // Controller hiển thị trang Shop
    public function index(Request $request)
    {
        // Lấy dữ liệu lọc từ request
        $categoryFilter = $request->input('category');
        $sort = $request->input('sort'); // Tham số sắp xếp

        // Lọc sản phẩm theo danh mục và sắp xếp (nếu có)
        $products = Product::with(['images', 'comments'])
            ->when($categoryFilter, function ($query) use ($categoryFilter) {
                return $query->where('category_id', $categoryFilter); // Lọc theo danh mục
            })
            ->when($sort, function ($query) use ($sort) {
                switch ($sort) {
                    case 'latest':
                        return $query->orderBy('created_at', 'desc'); // Sắp xếp theo mới nhất
                    case 'oldest':
                        return $query->orderBy('created_at', 'asc'); // Sắp xếp theo cũ nhất
                    case 'price_asc':
                        return $query->orderBy('price', 'asc'); // Sắp xếp theo giá thấp -> cao
                    case 'price_desc':
                        return $query->orderBy('price', 'desc'); // Sắp xếp theo giá cao -> thấp
                    default:
                        return $query;
                }
            })
            ->paginate(10); // Phân trang sản phẩm

        // Biến đổi dữ liệu để chỉ lấy những thông tin cần thiết (name, price, image, rating)
        $productData = collect($products->items())->map(function ($product) {
            // Tính trung bình rating từ comments (nếu có)
            $averageRating = $product->comments->isNotEmpty() ? $product->comments->avg('rating') : 0;

            // Lấy ảnh đầu tiên (nếu có)
            $imageLink = $product->images->first() ? $product->images->first()->link : null;

            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $imageLink,
                'rating' => $averageRating,
            ];
        });

        // Lấy tất cả danh mục để hiển thị trong phần lọc
        $categories = Category::all();

        // Trả về view với dữ liệu sản phẩm (bao gồm cả đối tượng phân trang)
        return view('client.shop.shop', [
            'productData' => $productData,
            'products' => $products, // Để dùng đối tượng phân trang trong view
            'categories' => $categories,
            'categoryFilter' => $categoryFilter, // Truyền danh mục lọc đã chọn
            'sort' => $sort, // Truyền tham số sắp xếp
        ]);
    }


    // Phương thức lọc sản phẩm
    public function filter(Request $request)
    {
        $categoryFilter = $request->input('category');

        // Lọc sản phẩm theo danh mục
        $products = Product::with(['images', 'comments'])
            ->when($categoryFilter, function ($query) use ($categoryFilter) {
                return $query->where('category_id', $categoryFilter);
            })
            ->paginate(10); // Phân trang sản phẩm

        // Lấy tất cả danh mục
        $categories = Category::all();

        // Trả về view và truyền biến
        return view('client.shop.shop', compact('categories', 'products'));
    }
}

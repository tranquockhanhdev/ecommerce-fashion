<?php

namespace App\Http\Controllers\client;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductDetail;

class ShopController extends Controller
{
    // Controller hiển thị trang Shop
    public function index(Request $request)
    {


        // Lấy dữ liệu lọc từ request
        $categoryFilter = $request->input('category');
        $sort = $request->input('sort'); // Tham số sắp xếp
        $minPrice = $request->input('min_price'); // Lọc theo giá thấp nhất
        $maxPrice = $request->input('max_price'); // Lọc theo giá cao nhất
        $ratingFilter = $request->input('ratings', []); // Lọc theo đánh giá

        // Lọc sản phẩm theo danh mục, giá, đánh giá và sắp xếp (nếu có)
        $products = Product::with(['images', 'comments'])
            ->where('status', 1) // Chỉ hiển thị sản phẩm có status = 1
            ->when($categoryFilter, function ($query) use ($categoryFilter) {
                return $query->where('category_id', $categoryFilter); // Lọc theo danh mục
            })
            ->when($minPrice, function ($query) use ($minPrice) {
                return $query->where('price', '>=', $minPrice); // Lọc theo giá thấp nhất
            })
            ->when($maxPrice, function ($query) use ($maxPrice) {
                return $query->where('price', '<=', $maxPrice); // Lọc theo giá cao nhất
            })
            ->when(count($ratingFilter) > 0, function ($query) use ($ratingFilter) {
                return $query->whereHas('comments', function ($q) use ($ratingFilter) {
                    $q->whereIn('rating', $ratingFilter); // Lọc theo đánh giá đã chọn
                });
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
            ->paginate(12); // Phân trang sản phẩm


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

        // Lấy tất cả danh mục và các mức đánh giá có sẵn để hiển thị trong phần lọc
        $categories = Category::all();
        $ratingOptions = [1, 2, 3, 4, 5]; // Các mức đánh giá từ 1 đến 5

        // Trả về view với dữ liệu sản phẩm (bao gồm cả đối tượng phân trang)
        return view('client.shop.shop', [
            'productData' => $productData,
            'products' => $products, // Để dùng đối tượng phân trang trong view
            'categories' => $categories,
            'categoryFilter' => $categoryFilter, // Truyền danh mục lọc đã chọn
            'sort' => $sort, // Truyền tham số sắp xếp
            'minPrice' => $minPrice, // Truyền giá min đã chọn
            'maxPrice' => $maxPrice, // Truyền giá max đã chọn
            'ratingFilter' => $ratingFilter, // Truyền đánh giá lọc đã chọn
            'ratingOptions' => $ratingOptions, // Các mức đánh giá có sẵn
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

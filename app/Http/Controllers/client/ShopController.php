<?php

namespace App\Http\Controllers\client;

use App\Models\Product;
use App\Models\Category;
use App\Models\Account;
use App\Models\Comment;
use App\Models\FavoriteProduct;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


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
        $product = Product::with(['images', 'comments.account'])->where('slug', $id)->firstOrFail();

        // Lấy danh sách hình ảnh sản phẩm
        $imageProduct = $product->images->pluck('link');

        // Lấy thông tin chi tiết sản phẩm
        $productDetails = ProductDetail::with(['color', 'size'])
            ->where('product_id', $product->id)
            ->get();

        // Lọc danh sách màu sắc và kích thước duy nhất
        $colors = $productDetails->unique('colorproduct_id')->pluck('color');
        $sizes = $productDetails->unique('sizeproduct_id')->pluck('size');

        // Đếm số lượt bình luận
        $commentCount = $product->comments()->count();

        // Tăng số lượt xem sản phẩm lên 1
        $product->increment('view');

        // Tính rating trung bình
        $rating = $product->comments()->avg('rating');

        // Lấy danh sách 5 bình luận mới nhất
        $comments = $product->comments()
            ->join('account', 'comment.account_id', '=', 'account.id')
            ->select('comment.*', 'account.lastname', 'account.firstname')
            ->orderBy('comment.created_at', 'desc')
            ->take(5)
            ->get();

        // Kiểm tra xem sản phẩm có được yêu thích hay không
        $isFavourite = false;
        if (Auth::check()) {
            $isFavourite = FavoriteProduct::where('account_id', Auth::id())
                ->where('product_id', $product->id)
                ->exists();
        }

        // Lấy danh sách sản phẩm liên quan
        $relatedProducts = Product::relatedProducts($id);
        // Kiểm tra xem người dùng đã mua sản phẩm chưa
        $hasPurchased = false;
        if (Auth::check()) {
            $accountId = Auth::id();
            $hasPurchased = Order::whereHas('orderCustomer', function ($query) use ($accountId) {
                $query->where('account_id', $accountId);
            })
                ->where('status_payment', 2)
                ->whereHas('orderItems', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                })
                ->exists();
        }

        // Lấy slug sản phẩm
        $productSlug = $id;

        return view('client.shop.product-details', compact(
            'product',
            'imageProduct',
            'productDetails',
            'colors',
            'sizes',
            'rating',
            'commentCount',
            'comments',
            'isFavourite',
            'relatedProducts',
            'hasPurchased',
            'productSlug'
        ));
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
    //DŨng
    // public function showCommet($id)
    // {
    //     $product = Product::where('slug', $id)->firstOrFail();
    //     $imageProduct = $product->images->pluck('link');
    //     $productDetail = ProductDetail::where('product_id', $product->id)->get();

    //     $commentCount = $product->comments()->count(); // Đếm số lượt bình luận trong bảng comment
    //     $product->increment('view'); // Tăng số lượt xem lên 1
    //     $rating = $product->comments()->avg('rating'); // Lấy rating trung bình từ bảng comment
    //     $comments = $product->comments()
    //         ->join('account', 'comment.account_id', '=', 'account.id') // Kết nối bảng 'account'
    //         ->select('comment.*', 'account.lastname', 'account.firstname') // Chọn các cột cần thiết
    //         ->orderBy('comment.created_at', 'desc') // Sắp xếp theo thời gian mới nhất
    //         ->take(5) // Lấy 5 bình luận
    //         ->get();
    //     $isFavourite = false;
    //     if (Auth::check()) {
    //         $isFavourite = FavoriteProduct::where('account_id', Auth::id())
    //             ->where('product_id', $product->id)
    //             ->exists();
    //     }

    //     // dd($comments);
    //     return view('client.shop.product-details', compact('product', 'imageProduct', 'productDetail', 'rating', 'commentCount', 'comments', 'isFavourite'));
    // }


    //Duy
    // public function getViews($id)
    // {
    //     // $product = Product::findOrFail($id);
    //     // return response()->json(['view' => $product->view]);

    //     $productSlug = $id;
    //     $product = Product::where('slug', $id)->firstOrFail();
    //     $relatedProducts = Product::relatedProducts($id);
    //     $imageProduct = $product->images->pluck('link');
    //     $productDetail = ProductDetail::where('product_id', $product->id)->get();
    //     $accountId = Auth::id();
    //     $hasPurchased = Order::whereHas('orderCustomer', function ($query) use ($accountId) {
    //         $query->where('account_id', $accountId);
    //     })
    //         ->where('status_payment', 2)
    //         ->whereHas('orderItems', function ($query) use ($product) {
    //             $query->where('product_id', $product->id);
    //         })
    //         ->exists();

    //     return view('client.shop.product-details', compact('product', 'imageProduct', 'productDetail', 'relatedProducts', 'hasPurchased', 'productSlug'));
    // }
    public function getProductQuantity($slug)
    {
        // Tìm sản phẩm theo slug thay vì id
        $product = Product::where('slug', $slug)->firstOrFail();

        // Trả về số lượng sản phẩm dưới dạng JSON
        return response()->json(['quantity' => $product->quantity]);
    }
}

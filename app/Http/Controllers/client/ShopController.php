<?php

namespace App\Http\Controllers\client;

use App\Models\Product;
use App\Models\Account;
use App\Models\Comment;
use App\Models\FavoriteProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ShopController extends Controller
{
    // Controller
    public function index()
    {
        // Lấy danh sách sản phẩm cùng thông tin hình ảnh và bình luận (phân trang)
        $products = Product::with(['images', 'comments'])->paginate(10);

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
        $product = Product::where('slug', $id)->firstOrFail();
        $imageProduct = $product->images->pluck('link');
        $productDetail = ProductDetail::where('product_id', $product->id)->get();
        $commentCount = $product->comments()->count(); // Đếm số lượt bình luận trong bảng comment
        $product->increment('view'); // Tăng số lượt xem lên 1
        $rating = $product->comments()->avg('rating'); // Lấy rating trung bình từ bảng comment
        $comments = $product->comments()
            ->join('account', 'comment.account_id', '=', 'account.id') // Kết nối bảng 'account'
            ->select('comment.*', 'account.lastname', 'account.firstname') // Chọn các cột cần thiết
            ->orderBy('comment.created_at', 'desc') // Sắp xếp theo thời gian mới nhất
            ->take(5) // Lấy 5 bình luận
            ->get();
        $isFavourite = false;
        if (Auth::check()) {
            $isFavourite = FavoriteProduct::where('account_id', Auth::id())
                ->where('product_id', $product->id)
                ->exists();
        }
        // dd($comments);
        return view('client.shop.product-details', compact('product', 'imageProduct', 'productDetail', 'rating', 'commentCount', 'comments', 'isFavourite'));
    }
    public function getViews($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['view' => $product->view]);
    }

}

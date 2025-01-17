<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Order;
use App\Models\OrderCustomer;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Comment;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountOrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $orders = Order::whereHas('orderCustomer', function ($query) use ($userId) {
            $query->where('account_id',  $userId);
        })->get(); // Phân trang, 10 bản ghi mỗi trang

        // Ánh xạ giá trị status và status_payment
        $statusMap = [
            1 => 'ĐÃ NHẬN ĐƠN',
            2 => 'ĐANG VẬN CHUYỂN',
            3 => 'ĐÃ GIAO',
            0 => 'ĐÃ HUỶ',
        ];

        $statusPaymentMap = [
            2 => 'THÀNH CÔNG',
            0 => 'THẤT BẠI',
            1 => 'ĐANG XỬ LÝ',
        ];

        // Chuyển đổi giá trị status và status_payment
        foreach ($orders as $order) {
            $order->status_text = $statusMap[$order->status] ?? 'Không xác định';
            $order->status_payment_text = $statusPaymentMap[$order->status_payment] ?? 'Không xác định';
            // Format tiền theo định dạng Việt Nam Đồng
            $order->formatted_total = number_format($order->total, 0, ',', '.') . ' VND';
            $order->formatted_shipping = number_format($order->shipping_fee, 0, ',', '.') . ' VND';
        }
        return view('client.user.order-history', compact('orders'));
    }
    public function details(string $id)
    {

        // Tìm đơn hàng theo ID
        $orders = Order::findOrFail($id);

        // Tìm thông tin khách hàng của đơn hàng
        $orderCustomer = OrderCustomer::findOrFail($orders->ordercustomer_id);

        // Tìm phương thức thanh toán của đơn hàng
        $paymentMethod = PaymentMethod::findOrFail($orders->payment_method_id);

        // Tìm các sản phẩm trong đơn hàng
        $orderItems = OrderItem::where('order_id',  $orders->id)->get();

        // Lấy thông tin sản phẩm từ OrderItem
        $products = Product::whereIn('id', $orderItems->pluck('product_id'))
            ->with(['images', 'comments'])
            ->get();

        // Biến đổi dữ liệu để chỉ lấy những thông tin cần thiết (name, price, image, rating)
        $productData = $products->map(function ($product) {
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


        // Format tiền theo định dạng Việt Nam Đồng
        $orders->formatted_total = number_format($orders->total, 0, ',', '.') . ' VND';
        $orders->formatted_shipping = number_format($orders->shipping_fee, 0, ',', '.') . ' VND';
        foreach ($orderItems as $orderItem) {
            $orderItem->formatted_price = number_format($orderItem->price, 0, ',', '.') . ' VND';
        }
        // Trả về view với các dữ liệu cần thiết
        return view('client.user.order-details', [
            'orders' => $orders,
            'orderCustomer' => $orderCustomer,
            'paymentMethod' => $paymentMethod,
            'orderItems' => $orderItems,
            'productData' => $productData
        ]);
    }
    public function cancelOrder(string $id)
    {
        $order = Order::find($id);

        // Kiểm tra nếu đơn hàng không ở trạng thái có thể hủy
        if ($order->status != 1) {
            return redirect()->back()->with('error', 'Không thể hủy đơn hàng này!');
        }

        // Cập nhật trạng thái đơn hàng thành hủy
        $order->status = 0; // Giả sử 0 là trạng thái hủy
        $order->status_payment = 0; // Giả sử 0 là trạng thái hủy
        $order->save();

        return redirect()->route('client.user.order-history')->with('success', 'Đơn hàng đã được hủy thành công!');
    }

    public function product_details($slug)
    {
        $productSlug = $slug;
        $relatedProducts = Product::relatedProducts($slug);
        $product = Product::where('slug', $slug)->firstOrFail();
        $imageProduct = $product->images->pluck('link');
        $productDetail = ProductDetail::where('product_id', $product->id)->get();

        $accountId = Auth::id();
        $hasPurchased = Order::whereHas('orderCustomer', function ($query) use ($accountId) {
            $query->where('account_id', $accountId);
        })

            ->where('status_payment', 2)
            ->whereHas('orderItems', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->exists();
        return view('client.shop.product-details', compact('product', 'imageProduct', 'productDetail', 'hasPurchased'));
    }

    public function comment(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $imageProduct = $product->images->pluck('link');
        $productDetail = ProductDetail::where('product_id', $product->id)->get();

        $accountId = Auth::id();
        $hasPurchased = Order::whereHas('orderCustomer', function ($query) use ($accountId) {
            $query->where('account_id', $accountId);
        })
            ->where('status_payment', 2)
            ->whereHas('orderItems', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->exists();

        // Kiểm tra tính hợp lệ của dữ liệu nhập vào
        $validated = $request->validate([
            'rating' => 'required',
            'content' => 'required|string',
        ], [
            'rating.required' => 'Vui lòng đánh giá.',
            'content.required' => 'Vui lòng nhập bình luận.',
            'content.string' => 'Bình luận là 1 chuỗi kí tự.',
        ]);

        // Tìm sản phẩm theo slug
        $product = Product::where('slug', $slug)->firstOrFail();

        Comment::create([
            'account_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $validated['rating'],
            'content' => $validated['content'],
            'status' => 0
        ]);

        return redirect()->route('client.shop.shopdetails', ['slug' => $slug])
            ->with([
                'success' => 'Bình luận của bạn đã được gửi thành công!',
                'product' => $product,
                'imageProduct' => $imageProduct,
                'productDetail' => $productDetail,
                'hasPurchased' => $hasPurchased,
            ]);
    }
}

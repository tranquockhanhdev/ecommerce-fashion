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
        })->paginate(10); // Phân trang, 10 bản ghi mỗi trang

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
        // Format tiền theo định dạng Việt Nam Đồng
        $orders->formatted_total = number_format($orders->total, 0, ',', '.') . ' VND';
        $orders->formatted_shipping = number_format($orders->shipping_fee, 0, ',', '.') . ' VND';
        foreach ($orderItems as $orderItem) {
            $orderItem->formatted_price = number_format($orderItem->price, 0, ',', '.') . ' VND';
        }
        // Trả về view với các dữ liệu cần thiết
        return view('client.user.order-details', compact('orders', 'orderCustomer', 'paymentMethod', 'orderItems'));
    }
}

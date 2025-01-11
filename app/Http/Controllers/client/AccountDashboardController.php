<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Order;
use App\Models\OrderCustomer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $account = Account::findOrFail($userId);
        $orders = Order::whereHas('orderCustomer', function ($query) use ($userId) {
            $query->where('account_id',  $userId);
        })->paginate(5); // Phân trang, 10 bản ghi mỗi trang

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
        return view('client.user.user-dashboard', compact('account', 'orders'));
    }
}

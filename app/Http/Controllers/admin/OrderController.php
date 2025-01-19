<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderCustomer;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách các đơn hàng.
     */
    public function index()
    {
        // Lấy danh sách đơn hàng kèm thông tin order_customer và phương thức thanh toán
        $order = Order::with(['orderCustomer', 'paymentMethod'])->get();

        // Trả về view với dữ liệu đơn hàng
        return view('admin.qldonhang.index', compact('order'));
    }

    /**
     * Hiển thị form tạo đơn hàng mới.
     */
    public function create()
    {
        // Lấy tất cả tài khoản từ bảng accounts để tạo dropdown
        $orderCustomers = OrderCustomer::all();
        return view('admin.qldonhang.create', compact('orderCustomers'));
    }

    /**
     * Lưu đơn hàng mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'ordercustomer_id' => 'required|exists:order_customer,id',
            'status' => 'required|string',
            'status_payment' => 'required|string',
            'shipping_fee' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        // Tạo đơn hàng mới
        Order::create($request->all());

        return redirect()->route('admin.qldonhang.index')->with('success', 'Đơn hàng đã được tạo!');
    }

    public function show($id)
    {
        // Lấy thông tin đơn hàng theo ID
        $order = Order::findOrFail($id);

        // Lấy thông tin order_customer của đơn hàng
        $orderCustomer = $order->orderCustomer;

        // Lấy danh sách các sản phẩm trong đơn hàng
        $orderItems = $order->orderItems;

        // Trả về view với dữ liệu đơn hàng, tài khoản và các sản phẩm
        return view('admin.qldonhang.detail', compact('order', 'orderCustomer', 'orderItems'));
    }
    /**
     * Hiển thị form chỉnh sửa đơn hàng.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $orderCustomers = OrderCustomer::all(); // Lấy danh sách tài khoản (với địa chỉ và số điện thoại)
        $paymentMethods = PaymentMethod::all(); // Lấy danh sách phương thức thanh toán

        return view('admin.qldonhang.edit', compact('order', 'orderCustomers', 'paymentMethods'));
    }


    /**
     * Cập nhật đơn hàng đã chỉnh sửa.
     */
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'ordercustomer_id' => 'required|exists:order_customer,id',
            'payment_method_id' => 'required|exists:payment_method,id',
            'status' => 'required|in:Đã nhận đơn,Đang vận chuyển,Đã giao,Đã hủy',
            'status_payment' => 'required|in:Thành công,Thất bại,Đang xử lí',
            'shipping_fee' => 'required|numeric|min:0|max:999999999999999.99',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
        ]);

        // Lấy đơn hàng cần cập nhật
        $order = Order::findOrFail($id);

        if (in_array($order->status, [3, 0])) {
            return redirect()->route('admin.qldonhang.index')->with('error', 'Đơn hàng không thể cập nhật vì đã hoàn thành hoặc đã hủy.');
        }
        
        // Lấy thông tin khách hàng của đơn hàng
        $orderCustomer = $order->orderCustomer;

        // Cập nhật địa chỉ và số điện thoại trong OrderCustomer
        $orderCustomer->update([
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        // Ánh xạ giá trị status sang số (0, 1, 2, 3)
        $statusMap = [
            'Đã nhận đơn' => 1,
            'Đang vận chuyển' => 2,
            'Đã giao' => 3,
            'Đã hủy' => 0
        ];

        // Ánh xạ giá trị status_payment sang số (0, 1, 2)
        $statusPaymentMap = [
            'Đang xử lí' => 1,
            'Thành công' => 2,
            'Thất bại' => 0
        ];

        // Tính toán total: Tổng giá các sản phẩm trong đơn hàng + phí vận chuyển
        $orderItemsTotal = $order->orderItems->sum(function ($item) {
            return $item->quantity * $item->price; // Giả sử bạn có quantity và price trong OrderItem
        });
        $total = $orderItemsTotal + $request->input('shipping_fee');

        // Cập nhật giá trị đơn hàng
        $order->update([
            'ordercustomer_id' => $request->ordercustomer_id,
            'payment_method_id' => $request->payment_method_id,
            'status' => $statusMap[$request->status] ?? null,
            'status_payment' => $statusPaymentMap[$request->status_payment] ?? null,
            'shipping_fee' => $request->input('shipping_fee'),
            'total' => $total, // Ghi lại total đã tính toán
        ]);

        return redirect()->route('admin.qldonhang.index')->with('success', 'Đơn hàng đã được cập nhật!');
    }


    /**
     * Xóa đơn hàng.
     */
    public function destroy($id)
    {
        // Tìm đơn hàng
        $order = Order::findOrFail($id);

        // Kiểm tra trạng thái đơn hàng có được phép xóa hay không (chỉ xóa đơn hàng đã hủy)
        if (!in_array($order->status, [0])) {
            return redirect()->route('admin.qldonhang.index')->with('error', 'Đơn hàng không thể xóa vì chưa hoàn thành".');
        }

        // Xóa tất cả các sản phẩm liên quan trong order_item và sau đó xóa đơn hàng
        $order->orderItems()->delete();
        $order->delete();

        return redirect()->route('admin.qldonhang.index')->with('success', 'Đơn hàng đã bị xóa thành công!');
    }
}

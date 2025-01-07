<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderCustomer;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

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
            'order_customer_id' => 'required|exists:order_customer,id',
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
            'order_customer_id' => 'required|exists:order_customer,id',
            'payment_method_id' => 'required|exists:payment_method,id',
            'status' => 'required|in:Đang xử lý,Đã giao,Đã hủy',
            'status_payment' => 'required|in:Thanh toán thành công,Thanh toán thất bại',
            'shipping_fee' => 'required|numeric|min:0|max:999999999999999.99',
            'total' => 'required|numeric|min:0|max:999999999999999.99',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        // Lấy đơn hàng cần cập nhật
        $order = Order::findOrFail($id);
        // Lấy thông tin khách hàng của đơn hàng
        $orderCustomer = $order->orderCustomer;

        // Cập nhật địa chỉ và số điện thoại trong OrderCustomer
        $orderCustomer->update([
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        // Ánh xạ giá trị status sang số (0, 1, 2)
        $statusMap = [
            'Đang xử lý' => 0,
            'Đã giao' => 1,
            'Đã hủy' => 2
        ];

        // Ánh xạ giá trị status_payment sang số (0, 1)
        $statusPaymentMap = [
            'Thanh toán thành công' => 0,
            'Thanh toán thất bại' => 1
        ];

        // Cập nhật giá trị trực tiếp
        $order->ordercustomer_id = $request->order_customer_id;
        $order->payment_method_id = $request->payment_method_id;
        $order->status = $statusMap[$request->status] ?? null;
        $order->status_payment = $statusPaymentMap[$request->status_payment] ?? null;
        $order->shipping_fee = $request->input('shipping_fee');
        $order->total = $request->input('total');



        // Lưu lại thay đổi
        $order->save();


        return redirect()->route('admin.qldonhang.index')->with('success', 'Đơn hàng đã được cập nhật!');
    }

    /**
     * Xóa đơn hàng.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.qldonhang.index')->with('success', 'Đơn hàng đã bị xóa!');
    }
}

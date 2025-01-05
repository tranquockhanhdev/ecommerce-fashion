<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Account;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách các đơn hàng.
     */
    public function index()
    {
        // Lấy tất cả các đơn hàng từ bảng orders
        $order = Order::all();

        // Trả về view với dữ liệu đơn hàng
        return view('admin.qldonhang.index', compact('order'));
    }

    /**
     * Hiển thị form tạo đơn hàng mới.
     */
    public function create()
    {
        // Lấy tất cả tài khoản từ bảng accounts để tạo dropdown
        $accounts = Account::all();
        return view('admin.qldonhang.create', compact('account'));
    }

    /**
     * Lưu đơn hàng mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
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

        // Lấy thông tin tài khoản của đơn hàng
        $account = $order->account;

        // Lấy danh sách các sản phẩm trong đơn hàng
        $orderItems = $order->orderItems;

        // Trả về view với dữ liệu đơn hàng, tài khoản và các sản phẩm
        return view('admin.qldonhang.detail', compact('order', 'account', 'orderItems'));
    }
    /**
     * Hiển thị form chỉnh sửa đơn hàng.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $account = Account::all(); // Lấy thông tin tài khoản
        return view('admin.qldonhang.edit', compact('order', 'account'));
    }

    /**
     * Cập nhật đơn hàng đã chỉnh sửa.
     */
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'account_id' => 'required|exists:account,id',
            'status' => 'required|in:Đang xử lý,Đã giao,Đã hủy',
            'status_payment' => 'required|in:Thanh toán thành công,Thanh toán thất bại',
            'shipping_fee' => 'required|numeric|min:0|max:999999999999999.99',
            'total' => 'required|numeric|min:0|max:999999999999999.99',
        ]);

        // Lấy đơn hàng cần cập nhật
        $order = Order::findOrFail($id);

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
        $order->account_id = $request->account_id;
        $order->status = $statusMap[$request->status] ?? null; // Kiểm tra nếu không tìm thấy giá trị thì sẽ là null
        $order->status_payment = $statusPaymentMap[$request->status_payment] ?? null; // Ánh xạ trạng thái thanh toán
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

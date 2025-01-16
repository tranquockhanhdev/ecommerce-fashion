@extends('layouts.admin')
@section('content')
    <h1>Chỉnh Sửa Đơn Hàng</h1>
    <form action="{{ route('admin.qldonhang.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Chọn tài khoản -->
        <div class="form-group">
            <label for="order_customer_id">Tài Khoản</label>
            <input type="text" class="form-control" value="{{ $order->orderCustomer->lastname }} {{ $order->orderCustomer->firstname }}"readonly>
        </div>
        <input type="hidden" name="ordercustomer_id" value="{{ $order->ordercustomer_id }}">

        <!-- Địa chỉ -->
        <div class="form-group">
            <label for="address">Địa chỉ (Address)</label>
            <input type="text" id="address" name="address" class="form-control"
                   value="{{ old('address', $order->orderCustomer->address) }}" required>
        </div>

        <!-- Số điện thoại -->
        <div class="form-group">
            <label for="phone">Số điện thoại (Phone)</label>
            <input type="text" id="phone" name="phone" class="form-control"
                   value="{{ old('phone', $order->orderCustomer->phone) }}" required>
        </div>

        <!-- Phương thức thanh toán -->
        <div class="form-group">
            <label for="payment_method_id">Phương Thức Thanh Toán</label>
            <select class="form-control" name="payment_method_id" required>
                @foreach ($paymentMethods as $paymentMethod)
                    <option value="{{ $paymentMethod->id }}"
                        {{ $order->payment_method_id == $paymentMethod->id ? 'selected' : '' }}>
                        {{ $paymentMethod->method }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Trạng thái đơn hàng -->
        <div class="form-group">
            <label for="status">Trạng Thái</label>
                <select class="form-control" name="status" required>
                <option value="Đã nhận đơn" {{ $order->status == 'Đã nhận đơn' ? 'selected' : '' }}>Đã nhận đơn</option>
                <option value="Đang vận chuyển" {{ $order->status == 'Đang vận chuyển' ? 'selected' : '' }}>Đang vận chuyển</option>
                <option value="Đã giao" {{ $order->status == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                <option value="Đã hủy" {{ $order->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>

        <!-- Trạng thái thanh toán -->
        <div class="form-group">
            <label for="status_payment">Trạng Thái Thanh Toán</label>
            <select class="form-control" name="status_payment" required>
                <option value="Đang xử lí" {{ $order->status_payment == 'Đang xử lí' ? 'selected' : '' }}>Đang xử lí</option>
                <option value="Thành công" {{ $order->status_payment == 'Thành công' ? 'selected' : '' }}>Thanh toán thành công</option>
                <option value="Thất bại" {{ $order->status_payment == 'Thất bại' ? 'selected' : '' }}>Thanh toán thất bại</option>
            </select>
        </div>

        <!-- Phí vận chuyển -->
        <div class="form-group">
            <label for="shipping_fee">Phí Vận Chuyển</label>
            <input type="number" step="0.01" name="shipping_fee" class="form-control"
                value="{{ old('shipping_fee', $order->shipping_fee) }}" required>
        </div>

        <!-- Tổng -->
        <div class="form-group">
            <label for="total">Tổng cộng (Total)</label>
            <input type="text" id="total" class="form-control" value="{{ $order->total }}" readonly>
        </div>

        <!-- Nút cập nhật -->
        <button type="submit" class="btn btn-primary">Cập Nhật Đơn Hàng</button>

        <!-- Nút quay lại -->
        <a href="{{ route('admin.qldonhang.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>

    <!-- Hiển thị lỗi -->
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

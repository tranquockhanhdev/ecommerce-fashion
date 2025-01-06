@extends('layouts.admin')
@section('content')
<h1>Chỉnh Sửa Đơn Hàng</h1>
<form action="{{ route('admin.qldonhang.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="account_id">Tài Khoản</label>
        <select class="form-control" name="account_id" required>
            @foreach($account as $account)
                <option value="{{ $account->id }}" {{ $order->account_id == $account->id ? 'selected' : '' }}>
                    {{ $account->lastname }} {{ $account->firstname }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="status">Trạng Thái</label>
        <select class="form-control" name="status" required>
            <option value="Đang xử lý" {{ $order->status == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
            <option value="Đã giao" {{ $order->status == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
            <option value="Đã hủy" {{ $order->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
        </select>
    </div>

    <div class="form-group">
        <label for="status_payment">Trạng Thái Thanh Toán</label>
        <select class="form-control" name="status_payment" required>
            <option value="Thanh toán thành công" {{ $order->status_payment == 'Thanh Toán Thành Công' ? 'selected' : '' }}>Thanh Toán Thành Công</option>
            <option value="Thanh toán thất bại" {{ $order->status_payment == 'Thanh Toán Thất Bại' ? 'selected' : '' }}>
                Thanh Toán Thất Bại</option>
        </select>
    </div>

    <div class="form-group">
        <label for="shipping_fee">Phí Vận Chuyển</label>
        <input type="number" step="0.01" name="shipping_fee" class="form-control"
            value="{{ old('shipping_fee', $order->shipping_fee) }}" required>
    </div>

    <div class="form-group">
        <label for="total">Tổng</label>
        <input type="number" step="0.01" name="total" class="form-control" value="{{ old('total', $order->total) }}"
            required>
    </div>

    <button type="submit" class="btn btn-primary">Cập Nhật Đơn Hàng</button>
</form>
@endsection
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

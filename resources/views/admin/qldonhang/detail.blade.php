@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Chi Tiết Đơn Hàng</h1>

    <!-- Thông tin đơn hàng -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Thông Tin Đơn Hàng
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Mã đơn hàng:</strong> {{ $order->id }}</p>
                    <p><strong>Tên khách hàng:</strong> {{ $order->account->lastname }} {{ $order->account->firstname }}</p>
                    <p><strong>Trạng thái:</strong>
                        @if ($order->status == 0) Đang xử lý
                        @elseif ($order->status == 1) Đã giao
                        @elseif ($order->status == 2) Đã hủy
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Phí vận chuyển:</strong> {{ number_format($order->shipping_fee, 0, ',', '.') }} VND</p>
                    <p><strong>Tổng cộng:</strong> {{ number_format($order->total, 0, ',', '.') }} VND</p>
                    <p><strong>Ngày tạo:</strong> {{ $order->created_at }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chi tiết sản phẩm -->
    <div class="card">
        <div class="card-header bg-success text-white">
            Chi Tiết Sản Phẩm
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá (VND)</th>
                        <th>Thành tiền (VND)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Tổng cộng:</strong></td>
                        <td>{{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Nút quay lại -->
    <div class="mt-3">
        <a href="{{ route('admin.qldonhang.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay Lại
        </a>
    </div>
</div>
@endsection

@extends('layouts.client')
@section('title', 'Lịch Sử Đặt Hàng | Synergy 4.0')
@section('content-nav')
<div class="section--xl pt-0">
    <div class="container">
        <!-- Order History  -->
        <div class="dashboard__order-history">
            <div class="dashboard__order-history-title">
                <h2 class="font-body--xxl-500">Lịch Sử Đơn Hàng</h2>
            </div>
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <!-- Đã Nhận Đơn -->
            <div class="dashboard__order-history-table">
                <h3>Đã Nhận Đơn</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="dashboard__order-history-table-title">Order Id</th>
                                <th scope="col" class="dashboard__order-history-table-title">Date</th>
                                <th scope="col" class="dashboard__order-history-table-title">Total</th>
                                <th scope="col" class="dashboard__order-history-table-title">Shipping Fee</th>
                                <th scope="col" class="dashboard__order-history-table-title">Status</th>
                                <th scope="col" class="dashboard__order-history-table-title">Status Payment</th>
                                <th scope="col" class="dashboard__order-history-table-title">Payment Method</th>
                                <th scope="col" class="dashboard__order-history-table-title"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders->where('status', 1) as $order)
                            <tr>
                                <td class="dashboard__order-history-table-item order-id">{{ $order->id }}</td>
                                <td class="dashboard__order-history-table-item order-date">{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                                <td class="dashboard__order-history-table-item order-total">{{$order->formatted_total}}</td>
                                <td class="dashboard__order-history-table-item order-total">{{$order->formatted_shipping}}</td>
                                <td class="dashboard__order-history-table-item order-status">{{ $order->status_text }}</td>
                                <td class="dashboard__order-history-table-item order-status">{{ $order->status_payment_text }}</td>
                                <td class="dashboard__order-history-table-item order-status"> @if ($order->payment_method_id == 1)
                                    VNPAY
                                    @elseif ($order->payment_method_id == 2)
                                    Thanh toán khi nhận hàng
                                    @else
                                    Phương thức thanh toán không xác định
                                    @endif</td>
                                <td class="dashboard__order-history-table-item order-details"><a href="{{ route('client.user.order-details', $order->id) }}">Xem Chi Tiết</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Đang Vận Chuyển -->
            <div class="dashboard__order-history-table">
                <h3>Đang Vận Chuyển <img src="https://cdn.pixabay.com/animation/2022/11/10/13/26/13-26-03-556_512.gif" alt="" style="width:5%"></h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="dashboard__order-history-table-title">Order Id</th>
                                <th scope="col" class="dashboard__order-history-table-title">Date</th>
                                <th scope="col" class="dashboard__order-history-table-title">Total</th>
                                <th scope="col" class="dashboard__order-history-table-title">Shipping Fee</th>
                                <th scope="col" class="dashboard__order-history-table-title">Status</th>
                                <th scope="col" class="dashboard__order-history-table-title">Status Payment</th>
                                <th scope="col" class="dashboard__order-history-table-title">Payment Method</th>
                                <th scope="col" class="dashboard__order-history-table-title"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders->where('status', 2) as $order)
                            <tr>
                                <td class="dashboard__order-history-table-item order-id">{{ $order->id }}</td>
                                <td class="dashboard__order-history-table-item order-date">{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                                <td class="dashboard__order-history-table-item order-total">{{$order->formatted_total}}</td>
                                <td class="dashboard__order-history-table-item order-total">{{$order->formatted_shipping}}</td>
                                <td class="dashboard__order-history-table-item order-status">{{ $order->status_text }}</td>
                                <td class="dashboard__order-history-table-item order-status">{{ $order->status_payment_text }}</td>
                                <td class="dashboard__order-history-table-item order-status"> @if ($order->payment_method_id == 1)
                                    VNPAY
                                    @elseif ($order->payment_method_id == 2)
                                    Thanh toán khi nhận hàng
                                    @else
                                    Phương thức thanh toán không xác định
                                    @endif</td>
                                <td class="dashboard__order-history-table-item order-details"><a href="{{ route('client.user.order-details', $order->id) }}">Xem Chi Tiết</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Đã Giao -->
            <div class="dashboard__order-history-table">
                <h3>Đã Giao <img src="https://cdn.pixabay.com/animation/2023/09/14/14/44/14-44-18-825_512.gif" alt="" style="width: 5%;"></h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="dashboard__order-history-table-title">Order Id</th>
                                <th scope="col" class="dashboard__order-history-table-title">Date</th>
                                <th scope="col" class="dashboard__order-history-table-title">Total</th>
                                <th scope="col" class="dashboard__order-history-table-title">Shipping Fee</th>
                                <th scope="col" class="dashboard__order-history-table-title">Status</th>
                                <th scope="col" class="dashboard__order-history-table-title">Status Payment</th>
                                <th scope="col" class="dashboard__order-history-table-title">Payment Method</th>
                                <th scope="col" class="dashboard__order-history-table-title"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders->where('status', 3) as $order)
                            <tr>
                                <td class="dashboard__order-history-table-item order-id">{{ $order->id }}</td>
                                <td class="dashboard__order-history-table-item order-date">{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                                <td class="dashboard__order-history-table-item order-total">{{$order->formatted_total}}</td>
                                <td class="dashboard__order-history-table-item order-total">{{$order->formatted_shipping}}</td>
                                <td class="dashboard__order-history-table-item order-status">{{ $order->status_text }}</td>
                                <td class="dashboard__order-history-table-item order-status">{{ $order->status_payment_text }}</td>
                                <td class="dashboard__order-history-table-item order-status"> @if ($order->payment_method_id == 1)
                                    VNPAY
                                    @elseif ($order->payment_method_id == 2)
                                    Thanh toán khi nhận hàng
                                    @else
                                    Phương thức thanh toán không xác định
                                    @endif</td>
                                <td class="dashboard__order-history-table-item order-details"><a href="{{ route('client.user.order-details', $order->id) }}">Xem Chi Tiết</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Đã Huỷ -->
            <div class="dashboard__order-history-table">
                <h3>Đã Huỷ <img src="https://cdn.pixabay.com/animation/2023/09/14/14/44/14-44-18-961_512.gif" alt="" style="width: 5%;"></h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="dashboard__order-history-table-title">Order Id</th>
                                <th scope="col" class="dashboard__order-history-table-title">Date</th>
                                <th scope="col" class="dashboard__order-history-table-title">Total</th>
                                <th scope="col" class="dashboard__order-history-table-title">Shipping Fee</th>
                                <th scope="col" class="dashboard__order-history-table-title">Status</th>
                                <th scope="col" class="dashboard__order-history-table-title">Status Payment</th>
                                <th scope="col" class="dashboard__order-history-table-title">Payment Method</th>
                                <th scope="col" class="dashboard__order-history-table-title"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders->where('status', 0) as $order)
                            <tr>
                                <td class="dashboard__order-history-table-item order-id">{{ $order->id }}</td>
                                <td class="dashboard__order-history-table-item order-date">{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                                <td class="dashboard__order-history-table-item order-total">{{$order->formatted_total}}</td>
                                <td class="dashboard__order-history-table-item order-total">{{$order->formatted_shipping}}</td>
                                <td class="dashboard__order-history-table-item order-status">{{ $order->status_text }}</td>
                                <td class="dashboard__order-history-table-item order-status">{{ $order->status_payment_text }}</td>
                                <td class="dashboard__order-history-table-item order-status"> @if ($order->payment_method_id == 1)
                                    VNPAY
                                    @elseif ($order->payment_method_id == 2)
                                    Thanh toán khi nhận hàng
                                    @else
                                    Phương thức thanh toán không xác định
                                    @endif</td>
                                <td class="dashboard__order-history-table-item order-details"><a href="{{ route('client.user.order-details', $order->id) }}">Xem Chi Tiết</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        }
    }, 5000); // 5 giây
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').style.backgroundImage = `url('${e.target.result}')`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
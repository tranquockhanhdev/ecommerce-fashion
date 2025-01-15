@extends('layouts.client')
@section('title', 'Chi Tiết Đơn Hàng | Synergy 4.0')
@section('content-nav')
<div class="section--xl pt-0">
    <div class="container">
        <!-- Order History  -->
        <div class="dashboard__order-history">
            <div class="dashboard__order-history-title">
                <h2 class="font-body--xxl-500">Chi Tiết Đơn Hàng</h2>
                <a href="{{route('client.user.order-history')}}">quay lại</a>
            </div>
            @if($orders->status == 1)
            <div class="alert alert-danger " role="alert">
                <!-- Nút hủy đơn hàng -->
                <form action="{{ route('client.user.cancel-order', $orders->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                        Hủy đơn hàng
                    </button>
                </form>
            </div>
            @endif

            <div class="dashboard__details-content">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="dashboard__details-card">
                            <div class="dashboard__details-card-item">
                                <h5 class="dashboard__details-card-title">
                                    Địa Chỉ Thanh Toán
                                </h5>
                                <!-- billing Address -->
                                <div class="dashboard__details-card-item__inner">
                                    <h2 class="font-body--lg-400 name">
                                        {{ $orderCustomer->lastname }} {{ $orderCustomer->firstname }}
                                    </h2>
                                    <p class="font-body--md-400">
                                        {{ $orderCustomer->address }}
                                    </p>
                                </div>
                                <div class="dashboard__details-card-item__inner">
                                    <div
                                        class="
                        dashboard__details-card-item__inner-contact
                      ">
                                        <h5 class="title">Email</h5>
                                        <p class="font-body--md-400">
                                            {{Auth::user()->email}}
                                        </p>
                                    </div>
                                    <div
                                        class="
                        dashboard__details-card-item__inner-contact
                      ">
                                        <h5 class="title">Phone</h5>
                                        <p class="font-body--md-400">{{$orderCustomer->phone}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard__details-card-item">
                                <h5 class="dashboard__details-card-title">
                                    Địa Chỉ Giao Hàng
                                </h5>
                                <!-- Shipping Address -->
                                <div class="dashboard__details-card-item__inner">
                                    <h2 class="font-body--lg-400 name">
                                        {{ $orderCustomer->lastname }} {{ $orderCustomer->firstname }}
                                    </h2>
                                    <p class="font-body--md-400">
                                        {{ $orderCustomer->address }}
                                    </p>
                                </div>
                                <div class="dashboard__details-card-item__inner">
                                    <div
                                        class="
                        dashboard__details-card-item__inner-contact
                      ">
                                        <h5 class="title">Email</h5>
                                        <p class="font-body--md-400">
                                            {{Auth::user()->email}}
                                        </p>
                                    </div>
                                    <div
                                        class="
                        dashboard__details-card-item__inner-contact
                      ">
                                        <h5 class="title">Phone</h5>
                                        <p class="font-body--md-400">{{$orderCustomer->phone}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="dashboard__totalpayment-card">
                            <div class="dashboard__totalpayment-card-header">
                                <div class="dashboard__totalpayment-card-header-item">
                                    <h5 class="title">Order id:</h5>
                                    <p class="details order-id">{{$orders->id}}</p>
                                </div>
                                <div class="dashboard__totalpayment-card-header-item">
                                    <h5 class="title">Payment Method:</h5>
                                    <p class="details order-id">{{$paymentMethod->method}}</p>
                                </div>
                            </div>

                            <div class="dashboard__totalpayment-card-body">


                                <div class="dashboard__totalpayment-card-body-item">
                                    <h5 class="font-body--md-400">Shipping Fee</h5>
                                    <p class="font-body--md-500">{{$orders->formatted_shipping}}</p>
                                </div>
                                <div class="dashboard__totalpayment-card-body-item total">
                                    <h5 class="font-body--xl-400">Total:</h5>
                                    <p class="font-body--xl-500">{{$orders->formatted_total}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($orders->status == 0)
            <div class="alert alert-danger" role="alert">
                <strong>Đơn hàng đã huỷ</strong>
            </div>
            @elseif($orders->status == 1)
            <div class="progress__bar progress__bar-1x">
                <div class="progress__bar-border">
                    <span class="progress__bar-border-active"></span>
                </div>
                <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                        <p class="font-body--md-400 count-number count-number-active">01</p>
                        <span class="check-mark">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <h2 class="font-body--md-400">Đã nhận đơn</h2>
                </div>
                <div class="progress__bar-item">
                    <div class="progress__bar-item-ball">
                        <p class="font-body--md-400 count-number">02</p>
                    </div>
                    <h2 class="font-body--md-400">Đang Vận Chuyển</h2>
                </div>
                <div class="progress__bar-item">
                    <div class="progress__bar-item-ball">
                        <p class="font-body--md-400 count-number">03</p>
                    </div>
                    <h2 class="font-body--md-400">Đã Giao</h2>
                </div>
            </div>
            @elseif($orders->status == 2)
            <div class="progress__bar progress__bar-3x">
                <div class="progress__bar-border">
                    <span class="progress__bar-border-active"></span>
                </div>
                <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                        <p class="font-body--md-400 count-number count-number-active">01</p>
                        <span class="check-mark">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <h2 class="font-body--md-400">Đã nhận đơn</h2>
                </div>
                <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                        <p class="font-body--md-400 count-number count-number-active">02</p>
                        <span class="check-mark">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <h2 class="font-body--md-400">Đang Vận Chuyển</h2>
                </div>
                <div class="progress__bar-item">
                    <div class="progress__bar-item-ball">
                        <p class="font-body--md-400 count-number">03</p>
                    </div>
                    <h2 class="font-body--md-400">Đã Giao</h2>
                </div>
            </div>
            @elseif($orders->status == 3)
            <div class="progress__bar progress__bar-4x">
                <div class="progress__bar-border">
                    <span class="progress__bar-border-active"></span>
                </div>
                <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                        <p class="font-body--md-400 count-number count-number-active">01</p>
                        <span class="check-mark">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <h2 class="font-body--md-400">Đã nhận đơn</h2>
                </div>
                <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                        <p class="font-body--md-400 count-number count-number-active">02</p>
                        <span class="check-mark">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <h2 class="font-body--md-400">Đang Vận Chuyển</h2>
                </div>
                <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                        <p class="font-body--md-400 count-number count-number-active">03</p>
                        <span class="check-mark">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <h2 class="font-body--md-400">Đã Giao</h2>
                </div>
            </div>
            @endif
            <div
                class="
            dashboard__order-history-table
            dashboard__order-history-table__product-content
          ">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Product
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Price
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    quantity
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Subtotal
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    chi tiết
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderItems as $orderItem)
                            <tr>
                                <!-- Product item  -->
                                <td
                                    class="
                      dashboard__order-history-table-item
                      align-middle
                    ">
                                    <a href="product-details.html" class="dashboard__product-item">
                                        <div class="dashboard__product-item-img">
                                            <img src="{{ asset($orderItem->product->images->first()->link) }}" alt="product" />

                                        </div>
                                        <h5 class="font-body--md-400"> {{$orderItem->name}}</h5>
                                    </a>
                                </td>
                                <!-- Price  -->
                                <td
                                    class="
                      dashboard__order-history-table-item
                      order-date
                      align-middle
                    ">
                                    {{$orderItem->formatted_price}}
                                </td>
                                <!-- quantity -->
                                <td
                                    class="
                      dashboard__order-history-table-item
                      order-total
                      align-middle
                    ">
                                    <p class="order-total-price"> {{$orderItem->quantity}}</p>
                                </td>
                                <!-- Subtotal  -->
                                <td class="
                      dashboard__order-history-table-item
                      order-status
                      align-middle
                    "
                                    style="text-align: left">
                                    <p class="font-body--md-500"> {{ number_format($orderItem->price * $orderItem->quantity, 0, ',', '.') }} VND</p>
                                </td>
                                <!-- Chi tiết sản phẩm  -->
                                <td class="
                      dashboard__order-history-table-item
                      order-status
                      align-middle
                    "
                                    style="text-align: left">
                                    @foreach ($productData as $product)
                                    <a href="{{ route('client.user.product_details', $product['slug']) }}">Chi tiết</a>
                                    @endforeach
                                </td>
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
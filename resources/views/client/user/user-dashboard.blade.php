@extends('layouts.client')
@section('title', 'Thông Tin Cá Nhân | Synergy 4.0')
@section('content-nav')

<div class="section--xl pt-0">
    <div class="container">
        <div class="row">
            <!-- User Info -->
            <div class="col-lg-7">
                <div class="dashboard__user-profile dashboard-card">
                    <div class="dashboard__user-profile-img">
                        <img src="{{ asset('storage/logos/' . $account->image) }}" alt="userImg" />
                    </div>
                    <div class="dashboard__user-profile-info">
                        <h5 class="font-body--xxl-500 name">{{$account->lastname}} {{$account->firstname}}</h5>
                        <p class="font-body--md-400 designation">{{$account->role}}</p>
                        <a href="{{route('client.user.account-setting')}}" class="edit font-body--lg-500">
                            Chỉnh Sửa Hồ Sơ
                        </a>
                    </div>
                </div>
            </div>
            <!-- User Billing Address -->
            <div class="col-lg-5">
                <div class="dashboard__user-billing dashboard-card">
                    <h2 class="dashboard__user-billing-title font-body--md-500">
                        Địa Chỉ Thanh Toán
                    </h2>
                    <div class="dashboard__user-billing-info">
                        <h5 class="dashboard__user-billing-name font-body--xl-500">
                            {{$account->lastname}} {{$account->firstname}}
                        </h5>
                        <p
                            class="
                            dashboard__user-billing-location
                            font-body--md-400
                          ">
                            {{$account->address}}
                        </p>
                        <p class="dashboard__user-billing-email font-body--lg-400">
                            {{$account->email}}
                        </p>
                        <p class="dashboard__user-billing-number font-body--lg-400">
                            {{$account->phone}}
                        </p>
                    </div>
                    <a href="{{route('client.user.account-setting')}}"
                        class="
                          dashboard__user-billing-editaddress
                          font-body--lg-500
                        ">
                        Chỉnh Sửa Địa Chỉ</a>
                </div>
            </div>
        </div>
        <!-- Order History  -->
        <div class="dashboard__order-history" style="margin-top: 24px">
            <div class="dashboard__order-history-title">
                <h2 class="font-body--xxl-500">Lịch Sử Đặt Hàng Gần Đây</h2>
                <a href="{{route('client.user.order-history')}}" class="font-body--lg-500">
                    Xem Tất Cả</a>
            </div>
            <div class="dashboard__order-history-table">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Order Id
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Date
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Total
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Shipping Fee
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Status
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Status Payment
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <!-- Order Id  -->
                                <td class="dashboard__order-history-table-item order-id">
                                    {{ $order->id }}
                                </td>
                                <!-- Date  -->
                                <td
                                    class="
                                dashboard__order-history-table-item
                                order-date
                              ">
                                    {{ date('Y-m-d', strtotime($order->created_at ))}}
                                </td>
                                <!-- Total  -->
                                <td
                                    class="
                                dashboard__order-history-table-item
                                order-total
                              ">
                                    <p class="order-total-price">
                                        {{$order->formatted_total }}
                                        <!-- <span class="quantity"> (5 Products)</span> -->
                                    </p>
                                </td>
                                <!-- shipping fee  -->
                                <td
                                    class="
                                dashboard__order-history-table-item
                                order-total
                              ">
                                    <p class="order-total-price">
                                        {{$order->formatted_shipping }}
                                        <!-- <span class="quantity"> (5 Products)</span> -->
                                    </p>
                                </td>
                                <!-- Status -->
                                <td
                                    class="
                                dashboard__order-history-table-item
                                order-status
                              ">
                                    {{ $order->status_text  }}
                                </td>
                                <!-- Status Payment -->
                                <td
                                    class="
                                dashboard__order-history-table-item
                                order-status
                              ">
                                    {{ $order->status_payment_text}}
                                </td>
                                <!-- Details page  -->
                                <td
                                    class="
                                dashboard__order-history-table-item
                                order-details
                              ">
                                    <a href="{{ route('client.user.order-details', $order->id) }}">Xem Chi Tiết</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- More content here -->
            </div>
        </div>
    </div>
    @endsection
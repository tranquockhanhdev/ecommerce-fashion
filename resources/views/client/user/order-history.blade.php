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
                <div>
                    {{ $orders->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
                            <img src="{{ asset('client/images/user/img-07.png') }}" alt="userImg" />
                        </div>
                        <div class="dashboard__user-profile-info">
                            <h5 class="font-body--xxl-500 name">Dianne Russell</h5>
                            <p class="font-body--md-400 designation">Khách Hàng</p>
                            <a href="account-setting.html" class="edit font-body--lg-500">
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
                                Dainne Russell
                            </h5>
                            <p
                                class="
                            dashboard__user-billing-location
                            font-body--md-400
                          ">
                                4140 Parker Rd. Allentown, New Mexico 31134
                            </p>
                            <p class="dashboard__user-billing-email font-body--lg-400">
                                dainne.ressell@gmail.com
                            </p>
                            <p class="dashboard__user-billing-number font-body--lg-400">
                                (671) 555-0110
                            </p>
                        </div>
                        <a href="account-setting.html"
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
                    <a href="order-history.html" class="font-body--lg-500">
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
                                        Status
                                    </th>
                                    <th scope="col" class="dashboard__order-history-table-title"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- Order Id  -->
                                    <td class="dashboard__order-history-table-item order-id">
                                        #738
                                    </td>
                                    <!-- Date  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-date
                              ">
                                        8 Sep, 20220
                                    </td>
                                    <!-- Total  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-total
                              ">
                                        <p class="order-total-price">
                                            $135.00
                                            <span class="quantity"> (5 Products)</span>
                                        </p>
                                    </td>
                                    <!-- Status -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-status
                              ">
                                        Processing
                                    </td>
                                    <!-- Details page  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-details
                              ">
                                        <a href="order-details.html">Xem Chi Tiết</a>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- Order Id  -->
                                    <td class="dashboard__order-history-table-item order-id">
                                        #703
                                    </td>
                                    <!-- Date  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-date
                              ">
                                        24 May, 2020
                                    </td>
                                    <!-- Total  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-total
                              ">
                                        <p class="order-total-price">
                                            $25.00 <span class="quantity"> (1 Products)</span>
                                        </p>
                                    </td>
                                    <!-- Status -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-status
                              ">
                                        on the way
                                    </td>
                                    <!-- Details page  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-details
                              ">
                                        <a href="order-details.html"> Xem Chi Tiết</a>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- Order Id  -->
                                    <td class="dashboard__order-history-table-item order-id">
                                        #130
                                    </td>
                                    <!-- Date  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-date
                              ">
                                        22 Oct, 2020
                                    </td>
                                    <!-- Total  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-total
                              ">
                                        <p class="order-total-price">
                                            $250.00
                                            <span class="quantity"> (4 Products)</span>
                                        </p>
                                    </td>
                                    <!-- Status -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-status
                              ">
                                        Completed
                                    </td>
                                    <!-- Details page  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-details
                              ">
                                        <a href="order-details.html"> Xem Chi Tiết</a>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- Order Id  -->
                                    <td class="dashboard__order-history-table-item order-id">
                                        #130
                                    </td>
                                    <!-- Date  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-date
                              ">
                                        22 Oct, 2020
                                    </td>
                                    <!-- Total  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-total
                              ">
                                        <p class="order-total-price">
                                            $250.00
                                            <span class="quantity"> (4 Products)</span>
                                        </p>
                                    </td>
                                    <!-- Status -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-status
                              ">
                                        Completed
                                    </td>
                                    <!-- Details page  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-details
                              ">
                                        <a href="order-details.html"> Xem Chi Tiết</a>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- Order Id  -->
                                    <td class="dashboard__order-history-table-item order-id">
                                        #130
                                    </td>
                                    <!-- Date  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-date
                              ">
                                        22 Oct, 2020
                                    </td>
                                    <!-- Total  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-total
                              ">
                                        <p class="order-total-price">
                                            $250.00
                                            <span class="quantity"> (4 Products)</span>
                                        </p>
                                    </td>
                                    <!-- Status -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-status
                              ">
                                        Completed
                                    </td>
                                    <!-- Details page  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-details
                              ">
                                        <a href="order-details.html"> Xem Chi Tiết</a>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- Order Id  -->
                                    <td class="dashboard__order-history-table-item order-id">
                                        #130
                                    </td>
                                    <!-- Date  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-date
                              ">
                                        22 Oct, 2020
                                    </td>
                                    <!-- Total  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-total
                              ">
                                        <p class="order-total-price">
                                            $250.00
                                            <span class="quantity"> (4 Products)</span>
                                        </p>
                                    </td>
                                    <!-- Status -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-status
                              ">
                                        Completed
                                    </td>
                                    <!-- Details page  -->
                                    <td
                                        class="
                                dashboard__order-history-table-item
                                order-details
                              ">
                                        <a href="order-details.html"> Xem Chi Tiết</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- More content here -->
                </div>
            </div>
        </div>
    @endsection

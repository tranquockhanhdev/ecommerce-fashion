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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
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
                                        <a href="order-details.html"> View Details</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="dashboard__order-pagination">
                        <nav aria-label="Page navigation pagination--one" class="pagination-wrapper">
                            <ul class="pagination justify-content-center">
                                <li class="page-item pagination-item disabled">
                                    <a class="page-link pagination-link" href="#" tabindex="-1">
                                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.91663 1.16634L1.08329 6.99967L6.91663 12.833" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li class="page-item pagination-item">
                                    <a class="page-link pagination-link active" href="#">1</a>
                                </li>
                                <li class="page-item pagination-item">
                                    <a class="page-link pagination-link" href="#">2</a>
                                </li>
                                <li class="page-item pagination-item">
                                    <a class="page-link pagination-link" href="#">3</a>
                                </li>
                                <li class="page-item pagination-item">
                                    <a class="page-link pagination-link" href="#">4</a>
                                </li>
                                <li class="page-item pagination-item">
                                    <a class="page-link pagination-link" href="#">5</a>
                                </li>
                                <li class="page-item pagination-item">
                                    <p class="page-link pagination-link">...</p>
                                </li>
                                <li class="page-item pagination-item">
                                    <a class="page-link pagination-link" href="#">21</a>
                                </li>
                                <li class="page-item pagination-item">
                                    <a class="page-link pagination-link" href="#">
                                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.08337 1.16634L6.91671 6.99967L1.08337 12.833" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

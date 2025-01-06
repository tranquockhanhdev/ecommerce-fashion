@extends('layouts.client')
@section('title', 'Giỏ Hàng | Synergy 4.0')
@section('content')
    <!-- Shopping Cart Section Start   -->
    <section class="shoping-cart section section--xl">
        <div class="container">
            <div class="section__head justify-content-center">
                <h2 class="section--title-four font-title--sm">Giỏ Hàng Của Tôi</h2>
            </div>
            <div class="row shoping-cart__content">
                <div class="col-lg-8">
                    <div class="cart-table">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="cart-table-title">Product</th>
                                        <th scope="col" class="cart-table-title">Price</th>
                                        <th scope="col" class="cart-table-title">quantity</th>
                                        <th scope="col" class="cart-table-title">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- Product item  -->
                                        <td class="cart-table-item align-middle">
                                            <a href="product-details.html" class="cart-table__product-item">
                                                <div class="cart-table__product-item-img">
                                                    <img src="{{ asset('client/images/products/img-01.png') }}"
                                                        alt="product" />
                                                </div>
                                                <h5 class="font-body--lg-400">Green Apple</h5>
                                            </a>
                                        </td>
                                        <!-- Price  -->
                                        <td class="cart-table-item order-date align-middle">
                                            $14.00
                                        </td>
                                        <!-- quantity -->
                                        <td class="cart-table-item order-total align-middle">
                                            <div class="counter-btn-wrapper">
                                                <button class="counter-btn-dec counter-btn" onclick="decrement()">
                                                    -
                                                </button>
                                                <input type="number" id="counter-btn-counter" class="counter-btn-counter"
                                                    min="1" max="1000" placeholder="1" />
                                                <button class="counter-btn-inc counter-btn" onclick="increment()">
                                                    +
                                                </button>
                                            </div>
                                        </td>
                                        <!-- Subtotal  -->
                                        <td class="cart-table-item order-subtotal align-middle">
                                            <div
                                                class="
                          d-flex
                          justify-content-between
                          align-items-center
                        ">
                                                <p class="font-body--md-500">$70.00</p>
                                                <button class="delete-item">
                                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 23.5C18.0748 23.5 23 18.5748 23 12.5C23 6.42525 18.0748 1.5 12 1.5C5.92525 1.5 1 6.42525 1 12.5C1 18.5748 5.92525 23.5 12 23.5Z"
                                                            stroke="#CCCCCC" stroke-miterlimit="10" />
                                                        <path d="M16 8.5L8 16.5" stroke="#666666" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M16 16.5L8 8.5" stroke="#666666" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- Product item  -->
                                        <td class="cart-table-item align-middle">
                                            <a href="product-details.html" class="cart-table__product-item">
                                                <div class="cart-table__product-item-img">
                                                    <img src="{{ asset('client/images/products/img-02.png') }}"
                                                        alt="product" />
                                                </div>
                                                <h5 class="font-body--lg-400">Fresh Orrange</h5>
                                            </a>
                                        </td>
                                        <!-- Price  -->
                                        <td class="cart-table-item order-date align-middle">
                                            $14.00
                                        </td>
                                        <!-- quantity -->
                                        <td class="cart-table-item order-total align-middle">
                                            <div class="counter-btn-wrapper">
                                                <button class="counter-btn-dec counter-btn" onclick="decrement()">
                                                    -
                                                </button>
                                                <input type="number" id="counter-btn-counter" class="counter-btn-counter"
                                                    min="1" max="1000" placeholder="1" />
                                                <button class="counter-btn-inc counter-btn" onclick="increment()">
                                                    +
                                                </button>
                                            </div>
                                        </td>
                                        <!-- Subtotal  -->
                                        <td class="cart-table-item order-subtotal align-middle">
                                            <div
                                                class="
                          d-flex
                          justify-content-between
                          align-items-center
                        ">
                                                <p class="font-body--md-500">$70.00</p>
                                                <button class="delete-item">
                                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 23.5C18.0748 23.5 23 18.5748 23 12.5C23 6.42525 18.0748 1.5 12 1.5C5.92525 1.5 1 6.42525 1 12.5C1 18.5748 5.92525 23.5 12 23.5Z"
                                                            stroke="#CCCCCC" stroke-miterlimit="10" />
                                                        <path d="M16 8.5L8 16.5" stroke="#666666" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M16 16.5L8 8.5" stroke="#666666" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Action Buttons  -->
                        <form action="#">
                            <div class="cart-table-action-btn d-flex">
                                <a href="shop-01.html" class="button button--md button--disable shop">Quay lại cửa hàng</a>
                                <a href="#" class="button button--md button--disable update">Cập nhật giỏ hàng</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bill-card">
                        <div class="bill-card__content">
                            <div class="bill-card__header">
                                <h2 class="bill-card__header-title font-body--xxl-500">
                                    Tóm Tắt Đơn Hàng
                                </h2>
                            </div>
                            <div class="bill-card__body">
                                <!-- memo  -->
                                <div class="bill-card__memo">
                                    <!-- Subtotal  -->
                                    <div class="bill-card__memo-item subtotal">
                                        <p class="font-body--md-400">Subtotal:</p>
                                        <span class="font-body--md-500">$84.00</span>
                                    </div>
                                    <!-- Shipping  -->
                                    <div class="bill-card__memo-item shipping">
                                        <p class="font-body--md-400">Shipping:</p>
                                        <span class="font-body--md-500">Free</span>
                                    </div>
                                    <!-- total  -->
                                    <div class="bill-card__memo-item total">
                                        <p class="font-body--lg-400">Total:</p>
                                        <span class="font-body--xl-500">$84.00</span>
                                    </div>
                                </div>
                                <form action="#">
                                    <button class="button button--lg w-100" style="margin-top: 20px" type="submit">
                                        Đặt Hàng
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End    -->
@endsection

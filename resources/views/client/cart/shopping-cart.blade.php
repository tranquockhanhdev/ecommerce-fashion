@extends('layouts.client')
@section('title', 'Giỏ Hàng | Synergy 4.0')
@section('css')
<style>
    .cart-table__product-item {
        display: flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
        color: #333;
    }

    .cart-table__product-item-img {
        width: 80px;
        height: 80px;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .cart-table__product-item-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cart-table__product-item h5 {
        font-size: 16px;
        font-weight: 500;
        color: #333;
        margin: 0;
    }

    .cart-table__product-item:hover h5 {
        color: #007bff;
        /* Màu chữ khi hover */
    }
</style>
@endsection
@section('content')
<!-- Shopping Cart Section Start -->
<section class="shoping-cart section section--xl">
    <div class="container">
        <div class="section__head justify-content-center">
            <h2 class="section--title-four font-title--sm">Giỏ Hàng Của Tôi</h2>
        </div>
        <div class="row shoping-cart__content">
            @if ($cartItems->isEmpty())
            <!-- Hiển thị thông báo nếu giỏ hàng trống -->
            <div class="col-12 text-center">
                <p class="font-body--lg-400">Giỏ hàng của bạn đang trống.</p>
                <a href="{{ route('client.shop.shop') }}" class="button button--md shop">Quay lại cửa
                    hàng</a>
            </div>
            @else
            <div class="col-lg-8">
                <div class="cart-table">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="cart-table-title">Sản phẩm</th>
                                    <th scope="col" class="cart-table-title">Giá</th>
                                    <th scope="col" class="cart-table-title">Số lượng</th>
                                    <th scope="col" class="cart-table-title">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $cartItem)
                                <tr>

                                    <!-- Product item -->
                                    <td class="cart-table-item align-middle">
                                        <a href="{{ route('client.shop.product-details') }}"
                                            class="cart-table__product-item d-flex align-items-center">
                                            <!-- Product Image -->
                                            <div class="cart-table__product-item-img"
                                                style="width: 80px; height: 80px; overflow: hidden; border-radius: 8px;">
                                                <img src="{{ asset($cartItem['product']['images'][0]['link'] ?? 'images/default-product.png') }}"
                                                    alt="{{ $cartItem['product']['name'] }}"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                            <!-- Product Name -->
                                            <h5 class="font-body--lg-400 ms-3 mb-0"
                                                style="flex: 1; font-size: 16px; font-weight: 500;">
                                                {{ $cartItem->product->name }}
                                            </h5>
                                        </a>
                                    </td>

                                    <!-- Price -->
                                    <td class="cart-table-item align-middle">
                                        {{ number_format($cartItem->product->price, 0, ',', '.') }} VNĐ
                                    </td>

                                    <!-- Quantity -->
                                    <td class="cart-table-item align-middle">
                                        <form method="POST" action="{{ route('cart.update', $cartItem->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="counter-btn-wrapper">
                                                <button type="button" class="counter-btn-dec counter-btn"
                                                    onclick="updateQuantity(this, -1)">
                                                    -
                                                </button>
                                                <input type="number" name="quantity"
                                                    class="counter-btn-counter" min="1"
                                                    value="{{ $cartItem->quantity }}" />
                                                <button type="button" class="counter-btn-inc counter-btn"
                                                    onclick="updateQuantity(this, 1)">
                                                    +
                                                </button>
                                            </div>
                                        </form>
                                    </td>

                                    <!-- Subtotal -->
                                    <td class="cart-table-item align-middle">
                                        <p class="font-body--md-500">
                                            {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}
                                            VNĐ
                                        </p>
                                    </td>

                                    <td class="cart-table-item align-middle">
                                        <form method="POST" action="{{ route('cart.remove', $cartItem->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete-item" type="submit">
                                                <svg width="24" height="25" viewBox="0 0 24 25"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 23.5C18.0748 23.5 23 18.5748 23 12.5C23 6.42525 18.0748 1.5 12 1.5C5.92525 1.5 1 6.42525 1 12.5C1 18.5748 5.92525 23.5 12 23.5Z"
                                                        stroke="#CCCCCC" stroke-miterlimit="10" />
                                                    <path d="M16 8.5L8 16.5" stroke="#666666" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M16 16.5L8 8.5" stroke="#666666" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Action Buttons -->
                    <div class="cart-table-action-btn d-flex">
                        <a href="{{ route('client.shop.shop') }}" class="button button--md shop">Quay lại
                            cửa hàng</a>

                        <!-- Xóa giỏ hàng -->
                        <button type="button" id="clearCartBtn" class="button button--md update">Xóa giỏ
                            hàng</button>
                    </div>


                    <div class="d-flex justify-content-center">
                        {{ $cartItems->links() }}
                    </div>

                </div>

            </div>

            <div class="col-lg-4">
                <div class="bill-card">
                    <div class="bill-card__content">
                        <div class="bill-card__header">
                            <h2 class="bill-card__header-title font-body--xxl-500">Tóm Tắt Đơn Hàng</h2>
                        </div>
                        <div class="bill-card__body">
                            <div class="bill-card__memo">
                                <!-- Subtotal -->
                                <div class="bill-card__memo-item subtotal">
                                    <p class="font-body--md-400">Tạm tính:</p>
                                    <span class="font-body--md-500">{{ number_format($total, 0, ',', '.') }}
                                        VNĐ</span>
                                </div>

                                <!-- Shipping -->
                                <div class="bill-card__memo-item shipping">
                                    <p class="font-body--md-400">Phí vận chuyển:</p>
                                    <span class="font-body--md-500">Miễn phí</span>
                                </div>
                                <!-- Total -->
                                <div class="bill-card__memo-item total">
                                    <p class="font-body--lg-400">Tổng cộng:</p>
                                    <span class="font-body--xl-500">{{ number_format($total, 0, ',', '.') }}
                                        VNĐ</span>
                                </div>

                            </div>
                            <form action="{{ route('client.cart.checkout', $cart->id) }}">
                                <button class="button button--lg w-100" style="margin-top: 20px" type="submit">
                                    Đặt Hàng
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection
@section('js')
<script>
    function updateQuantity(button, change) {
        // Lấy input số lượng liên quan đến button
        const inputField = button.closest('.counter-btn-wrapper').querySelector('input[name="quantity"]');

        // Lấy giá trị hiện tại và tính giá trị mới
        let currentQuantity = parseInt(inputField.value);
        const newQuantity = currentQuantity + change;

        // Đảm bảo số lượng mới không nhỏ hơn 1
        if (newQuantity >= 1) {
            inputField.value = newQuantity;

            // Gửi form tự động
            const form = inputField.closest('form');
            form.submit();
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#clearCartBtn').click(function() {
            if (confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng?')) {
                $.ajax({
                    url: @json(route('cart.removeAll')),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            // Cập nhật lại giao diện giỏ hàng (ví dụ: làm trống giỏ hàng)
                            location.reload(); // Tải lại trang để cập nhật lại giỏ hàng
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                });
            }
        });
    });
</script>


@endsection
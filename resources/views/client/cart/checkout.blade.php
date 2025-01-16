@extends('layouts.client')
@section('title', 'Thanh Toán | Synergy 4.0')
@section('content')
<!-- Billing Section Start  -->
<section class="section billing section--xl pt-0">
    <div class="container">
        <div class="row billing__content">
            <div class="col-lg-7">
                <div class="billing__content-card">
                    <div class="billing__content-card-header">
                        <h2 class="font-body--xxxl-500">Thông Tin Thanh Toán</h2>
                    </div>
                    <div class="billing__content-card-body">
                        <form action="{{route('checkout', $cart)}}" method="POST">
                            <div class="contact-form__content">
                                <div class="contact-form__content-group">
                                    <div class="contact-form-input">
                                        <label for="fname1">Tên</label>
                                        <input type="text" id="fname1" placeholder="Điền tên của bạn" name="firstname" require value="{{ Auth::user()->firstname }}" readonly />
                                    </div>
                                    <div class="contact-form-input">
                                        <label for="lname2">họ và tên lót</label>
                                        <input type="text" id="lname2" placeholder="Nhập họ và tên lót của bạn" name="lastname" require value="{{ Auth::user()->lastname }}" readonly />
                                    </div>

                                </div>

                                <div class="contact-form-input">
                                    <label for="address">Địa Chỉ </label>
                                    <input type="text" id="address" placeholder="Nhập địa chỉ của bạn" name="address" require value="{{ Auth::user()->address }}" readonly />
                                </div>

                                <div class="contact-form__content-group">
                                    <!-- Country -->
                                    <div class="contact-form-input">
                                        <label for="country">Quốc Gia</label>
                                        <select id="country" class="contact-form-input__dropdown">
                                            <option value="01" selected>Việt Nam</option>

                                        </select>
                                    </div>
                                    <div class="contact-form-input">
                                        <label for="email"> email </label>
                                        <input type="text" id="email" placeholder="Nhập Địa chỉ email" value="{{ Auth::user()->email }}" require readonly />
                                    </div>
                                </div>
                                <div class="contact-form__content-group">
                                    <div class="contact-form-input">
                                        <label for="phone"> Phone </label>
                                        <input type="number" id="phone" placeholder="Nhập Số Điện Thoại" name="phone" value="{{ Auth::user()->phone }}" require readonly />
                                    </div>
                                </div>
                                <a target="_blank" href="{{route('client.user.account-setting')}}"
                                    class="
                          dashboard__user-billing-editaddress
                          font-body--lg-500
                          
                        ">
                                    @csrf
                                    <input type="text" name="account_id" value="{{Auth::user()->id}}" hidden>

                                    Chỉnh Sửa Thông Tin Thanh Toán</a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="bill-card">
                    <div class="bill-card__content">
                        <div class="bill-card__header">
                            <h2 class="bill-card__header-title font-body--xxl-500">
                                Danh Sách Sản Phẩm
                            </h2>
                        </div>
                        <div class="bill-card__body">
                            <!-- Product Info -->
                            <div class="bill-card__product">
                                <input type="text" name="orderItem" value="{{$orderItem}}" hidden>
                                @foreach($orderItem as $orderItem)
                                <div class="bill-card__product-item">
                                    <div class="bill-card__product-item-content d-flex align-items-center">
                                        <div class="img-wrapper mr-3">
                                            <img src="{{ asset($orderItem['product']['images'][0]['link']) }}" alt="product-img" />
                                        </div>
                                        <p class="font-body--md-400 text-truncate mb-0" style="max-width: 200px;">
                                            {{$orderItem->product->name}}
                                        </p>
                                        <span class="quantity">x{{$orderItem->quantity}}</span>
                                    </div>


                                    <p class="bill-card__product-price font-body--md-500">
                                        {{ number_format($orderItem->product->price, 0, ',', '.') }} VNĐ

                                    </p>
                                </div>
                                @endforeach
                            </div>
                            <!-- memo  -->
                            <div class="bill-card__memo">
                                <!-- Subtotal  -->
                                <div class="bill-card__memo-item subtotal">
                                    <p class="font-body--md-400">Tổng Cộng:</p>
                                    <span class="font-body--md-500">{{ number_format($totalItem, 0, ',', '.') }} VNĐ</span>

                                </div>
                                <!-- Shipping  -->
                                <div class="bill-card__memo-item shipping">
                                    <p class="font-body--md-400">Phí Vận Chuyển:</p>
                                    <span class="font-body--md-500">
                                        {{ number_format($shippingCost, 0, ',', '.') }} VNĐ
                                        <input type="text" name="shippingCost" value="{{$shippingCost}}" hidden>
                                    </span>

                                </div>
                                <p style="color:red">Lưu Ý:Cước phí mỗi km là 10.000VNĐ</p>
                                <!-- total  -->
                                <div class="bill-card__memo-item total">
                                    <p class="font-body--lg-400">Tổng Cộng:</p>
                                    <span class="font-body--xl-500">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
                                    <input type="text" name="totalItem" value="{{$total}}" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bill-card__content">
                        <div class="bill-card__header">
                            <div class="bill-card__header">
                                <h2 class="bill-card__header-title font-body--xxl-500">
                                    Phương Thức Thanh Toán
                                </h2>
                            </div>
                        </div>
                        <div class="bill-card__body">
                            <!-- Payment Methods  -->
                            <div class="bill-card__payment-method">
                                <div class="bill-card__payment-method-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" id="cash" value="2" checked />
                                        <label class="form-check-label font-body--400" for="cash">
                                            Thanh Toán Khi Nhận Hàng
                                        </label>
                                    </div>
                                </div>

                                <div class="bill-card__payment-method-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" id="paypal" value="1" />
                                        <label class="form-check-label font-body--400" for="paypal">
                                            VNPay
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <button class="button button--lg w-100" type="submit">
                                Place Order
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Billing Section  End  -->
@endsection
@extends('layouts.client')
@section('title', 'Cài Đặt | Synergy 4.0')
@section('css')
<link rel="stylesheet" href="{{ asset('client/lib/css/swiper-bundle.min.css') }}" />
<link rel="stylesheet" href="{{ asset('client/lib/css/bvselect.css') }}" />
<link rel="stylesheet" href="{{ asset('client/lib/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('client/css/style.css') }}" />
@endsection
@section('content-nav')
<div class="section--xl pt-0">
    <div class="container">
        <!-- Account Settings  -->
        <div class="dashboard__content-card">
            <div class="dashboard__content-card-header">
                <h5 class="font-body--xxl-500">Cài Đặt Tài Khoản</h5>
            </div>
            <div class="dashboard__content-card-body">
                <div class="row">
                    <div class="col-lg-7 order-lg-0 order-2">
                        <form action="#">
                            <div class="contact-form__content">
                                <div class="contact-form-input">
                                    <label for="fname1">First Name </label>
                                    <input type="text" id="fname1" placeholder="Điền First Name" value="{{ old('firstname', $website->firstname) }}" />
                                </div>
                                <div class="contact-form-input">
                                    <label for="lname2">Last Name </label>
                                    <input type="text" id="lname2" placeholder="Điền LastName" value="{{ old('lastname', $website->lastname) }}" />
                                </div>
                                <div class="contact-form-input">
                                    <label for="email1">Email </label>
                                    <input type="text" id="email1" placeholder="Điền email" value="{{ old('email', $website->email) }}" />
                                </div>
                                <div class="contact-form-input">
                                    <label for="number1">Phone Number</label>
                                    <input type="number" id="number1" placeholder="Điền Sđt" value="{{ old('phone', $website->phone) }}" />
                                </div>
                                <div class="contact-form-input">
                                    <label for="date">Date</label>
                                    <input type="date" id="date" value="{{ old('date', date('Y-m-d', strtotime($website->date))) }}" />
                                </div>
                                <div class="contact-form-btn">
                                    <button class="button button--md" type="submit">
                                        Lưu Thay Đổi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 order-lg-0 order-1">
                        <div class="dashboard__content-card-img">
                            <form action="#" style="text-align: center">
                                <div class="dashboard__content-img-wrapper">
                                    <div id="imagePreview"
                                        style="background-image: url('{{ asset('./client/images/user/img-07.png') }}');">
                                    </div>
                                </div>
                                <!-- <button class="button button--outline">
                                            Choose Image
                                          </button> -->
                                <div class="upload-image button button--outline">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg"
                                        id="imageUpload" />
                                    <label for="imageUpload">Chọn Hình Ảnh</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Billing Address  -->
        <div class="dashboard__content-card">
            <div class="dashboard__content-card-header">
                <h5 class="font-body--xxl-500">Địa Chỉ Thanh Toán</h5>
            </div>
            <div class="dashboard__content-card-body">
                <form action="#">
                    <div class="contact-form__content">
                        <div class="contact-form__content-group">
                            <div class="contact-form-input">
                                <label for="fname">First Name </label>
                                <input type="text" id="fname" placeholder="First Name" />
                            </div>
                            <div class="contact-form-input">
                                <label for="lname">Last Name </label>
                                <input type="text" id="lname" placeholder="Last Name" />
                            </div>
                            <div class="contact-form-input">
                                <label for="cname">Company Name <span>(Optional)</span>
                                </label>
                                <input type="text" id="cname" placeholder="Your Company Name" />
                            </div>
                        </div>
                        <div class="contact-form-input">
                            <label for="address">Street Address </label>
                            <input type="text" id="address" placeholder="Your address" />
                        </div>
                        <div class="contact-form__content-group">
                            <!-- Country -->
                            <div class="contact-form-input">
                                <label for="country">Country / Region </label>
                                <select id="country" class="contact-form-input__dropdown">
                                    <option value="01">United States</option>
                                    <option value="02">Canada</option>
                                    <option value="03">United Kingdom</option>
                                    <option value="04">Bangladesh</option>
                                </select>
                            </div>
                            <!-- states -->
                            <div class="contact-form-input">
                                <label for="states">states </label>
                                <select id="states" class="contact-form-input__dropdown">
                                    <option value="01">Washington DC</option>
                                    <option value="02">Nova Scotia</option>
                                    <option value="03">Alberta</option>
                                    <option value="04">Manitoba</option>
                                    <option value="05">Dhaka</option>
                                </select>
                            </div>
                            <!-- zip -->
                            <div class="contact-form-input">
                                <label for="zip">Zip Code</label>
                                <select id="zip" class="contact-form-input__dropdown">
                                    <option value="01">20033</option>
                                    <option value="02">975</option>
                                    <option value="03">880</option>
                                    <option value="04">95</option>
                                </select>
                            </div>
                        </div>
                        <div class="contact-form__content-group">
                            <div class="contact-form-input">
                                <label for="email"> email </label>
                                <input type="text" id="email" placeholder="Email Address" />
                            </div>
                            <div class="contact-form-input">
                                <label for="phone"> Phone </label>
                                <input type="number" id="phone" placeholder="Phone number" />
                            </div>
                        </div>
                        <div class="contact-form-btn">
                            <button class="button button--md" type="submit">
                                Lưu Thay Đổi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
        </div>
        @endif
        <!-- Change Password  -->
        <div class="mb-3">
            <form action="{{ route('client.user.account-setting') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="cpassword" class="form-label">Current Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="cpassword" placeholder="Password" name="current_password">
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="showPassword('cpassword', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </span>
                        </div>
                    </div>

                </div>
                @error('current_password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
        </div>

        <div class="mb-3">
            <label for="npassword" class="form-label">New Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="npassword" placeholder="Password" name="password">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="showPassword('npassword', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </span>
                </div>
            </div>

        </div>

        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" name="password_confirmation">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="showPassword('confirmPassword', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </span>
                </div>
            </div>

            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Đổi Mật Khẩu</button>
        </form>
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
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const image = document.getElementById('logoPreview');
            image.src = e.target.result;
            image.style.display = 'block'; // Hiển thị ảnh preview
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
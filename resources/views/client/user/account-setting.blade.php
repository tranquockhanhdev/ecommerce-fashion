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
        @if (session('successinfo'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('successinfo') }}</strong>
        </div>
        @endif
        <div class="dashboard__content-card">
            <div class="dashboard__content-card-header">
                <h5 class="font-body--xxl-500">Cài Đặt Tài Khoản</h5>
            </div>
            <div class="dashboard__content-card-body">
                <div class="row">
                    <div class="col-lg-7 order-lg-0 order-2">
                        <form action="{{ route('client.user.account-settingchangeInfo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="form-group">
                                    <label for="fname1">First Name</label>
                                    <input type="text" id="fname1" class="form-control" placeholder="Điền First Name" value="{{ old('firstname', $website->firstname) }}" name="firstname" />
                                    @error('firstname')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="lname2">Last Name</label>
                                    <input type="text" id="lname2" class="form-control" placeholder="Điền Last Name" value="{{ old('lastname', $website->lastname) }}" name="lastname" />
                                    @error('lastname')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email1">Email</label>
                                    <input type="email" id="email1" class="form-control" placeholder="Điền email" value="{{ old('email', $website->email) }}" name="email" />
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" id="date" class="form-control" value="{{ old('date', date('Y-m-d', strtotime($website->date))) }}" name="date" />
                                    @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Lưu Thay Đổi</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-lg-5 order-lg-0 order-1">
                        <div class="dashboard__content-card-img">
                            <form action="{{ route('client.user.account-settingchangeAvatar') }}" method="POST" enctype="multipart/form-data" style="text-align: center">
                                @csrf
                                <div class="dashboard__content-img-wrapper">
                                    <div id="imagePreview"
                                        style="background-image: url('{{ asset('storage/logos/' . $website->image) }}'); background-size: cover; background-position: center; width: 150px; height: 150px; border-radius: 50%; margin: 0 auto;">
                                    </div>
                                </div>

                                <div class="upload-image button button--outline" style="margin-top: 15px;">
                                    <input type="file" id="imageUpload" name="logo" accept=".png, .jpg, .jpeg" style="display: none;" />
                                    <label for="imageUpload" style="cursor: pointer;">Chọn Hình Ảnh</label>
                                </div>

                                <button type="submit" class="button button--primary" style="margin-top: 10px;">Cập Nhật</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Billing Address  -->
        @if (session('successs'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('successs') }}</strong>
        </div>
        @endif
        <div class="dashboard__content-card">
            <div class="dashboard__content-card-header">
                <h5 class="font-body--xxl-500">Địa Chỉ Thanh Toán</h5>
            </div>
            <div class="dashboard__content-card-body">
                <form action="{{ route('client.user.account-settingchangeAddress') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="form-group">
                            <label for="address">Street Address</label>
                            <input type="text" id="address" class="form-control" placeholder="Your address" value="{{ old('address', $website->address) }}" name="address" />
                            @error('address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" id="phone" class="form-control" placeholder="Phone number" name="phone" value="{{ old('phone', $website->phone) }}" />
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Lưu Thay Đổi</button>
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
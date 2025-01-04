@extends('layouts.client')

@section('content')
<section class="create-account section section--xl">
    <div class="container">
        <div class="form-wrapper">
            <h6 class="font-title--sm">Đăng Ký</h6>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-input">
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="name" placeholder="lastname" autofocus>

                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="name" placeholder="firstname" autofocus>

                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6663 5.5L7.49967 14.6667L3.33301 10.5" stroke="#00B307" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus>

                    @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="password" required autocomplete="new-password">
                </div>

                <div class="form-wrapper__content">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="remember" required />
                        <label class="form-check-label" for="remember">
                            Chấp nhận tất cả các điều khoản và điều kiện
                        </label>
                    </div>
                </div>
                <div class="form-button">
                    <button type="submit" class="button button--md w-100">Đăng Ký.</button>
                </div>
                <div class="form-register">
                    Đã có tài khoản ? <a href="#" onclick="openLoginPopup(event)">Đăng Nhập</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
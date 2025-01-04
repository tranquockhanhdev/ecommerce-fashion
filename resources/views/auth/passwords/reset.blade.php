@extends('layouts.client')

@section('content')
<section class="create-account section section--xl">
    <div class="container">
        <div class="form-wrapper">
            <h6 class="font-title--sm">Quên Mật Khẩu</h6>
            <p>Vui Lòng Nhập Email Để Tiếp Tục:</p>
            <form method="POST" action="{{ route('auth.checkInfo') }}">
                @csrf
                <div>
                    <div class="mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input id="text" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" placeholder="Mã Bí Mật" required autocomplete="content">
                        @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
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
                    <button type="submit" class="button button--md w-100">Tiếp Tục</button>
                </div>
            </form>

            <a class="justify-center" href="/">Quay Lại Trang Chủ</a>
        </div>
    </div>
</section>
@endsection
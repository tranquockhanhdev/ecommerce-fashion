@extends('layouts.app')

@section('content')
<section class="create-account section section--xl">
    <div class="container">
        <div class="form-wrapper">
            <h6 class="font-title--sm">Nhập Mật Khẩu Mới</h6>
            <p>Vui Lòng Nhập Mật khẩu mới</p>
            <br>
            <form method="POST" action="{{route('auth.updatePassword')}}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="secret_id" value="{{ $secret_id }}">
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
                    <button type="submit" class="button button--md w-100">Tiếp Tục</button>
                </div>
            </form>

            <a class="justify-center" href="/">Quay Lại Trang Chủ</a>
        </div>
    </div>
</section>
@endsection
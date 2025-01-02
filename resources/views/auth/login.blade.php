<div id="loginPopup" class="popup-overlay">
    <div class="popup-container">
        <button class="popup-close" onclick="closeLoginPopup()">&times;</button>

        <div class="popup-content">
            <h2 class="popup-title">Đăng nhập</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <input id="email" placeholder="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input id="password" placeholder="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" id="remember" required />
                        Nhớ mật khẩu
                    </label>
                    <a href="#">Quên mật khẩu?</a>
                </div>
                <div class="form-action">
                    <button type="submit" class="btn-login">Đăng nhập</button>
                </div>
            </form>
            <p class="register-info">Chưa có tài khoản? <a href="{{route('register')}}">Đăng ký</a></p>
        </div>
    </div>
</div>
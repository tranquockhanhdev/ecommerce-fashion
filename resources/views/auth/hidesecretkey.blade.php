@extends('layouts.client')

@section('content')
<section class="create-account section section--xl">
    <div class="container">
        <div class="form-wrapper">
            <h6 class="font-title--sm">Thông Báo</h6>
            <p>Mã bí mật:</p>
            <br>
            <h4><strong>{{ $secretContent }}</strong></h4>

            <br>
            <p style="color:red">Lưu ý: mã bí mật của bạn phải được ghi nhớ lại cẩn thận,chúng tôi không hoàn toàn chịu trách nhiệm khi bạn quên mất</p><br>
            <a class="justify-center" href="/">Quay Lại Trang Chủ</a>
        </div>
    </div>
</section>
@endsection
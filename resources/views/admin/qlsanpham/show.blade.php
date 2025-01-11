<!-- resources/views/admin/qlsanpham/show.blade.php -->

@extends('layouts.admin')

@section('content')
<h1 class=" mb-4 text-primary font-weight-bold">Chi tiết sản phẩm</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text"><strong>Danh mục:</strong> {{ $product->category->name }}</p>
        <p class="card-text"><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }} VND</p>
        <p class="card-text"><strong>Số lượng:</strong> {{ $product->quantity }}</p>
        <p class="card-text"><strong>Mô tả:</strong> {!! $product->description !!}</p>
        <h5>Hình ảnh:</h5>
        @foreach ($product->images as $image)
        <img src="{{ asset($image->link) }}" alt="Product Image" class="img-fluid" width="200">
        @endforeach

        <h5>Thông tin chi tiết:</h5>
        @foreach ($product->details as $detail)
        <p>
            <strong>Màu:</strong> {{ $detail->color->color_name ?? 'Không có' }} |
            <strong>Kích thước:</strong> {{ $detail->size->size_name ?? 'Không có' }}
        </p>
        @endforeach
    </div>
</div>

<a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
@endsection
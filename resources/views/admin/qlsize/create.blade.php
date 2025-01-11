@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>Thêm size mới</h1>
    <form action="{{ route('admin.sizes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="size_name">Tên size</label>
            <input type="text" name="size_name" id="size_name" class="form-control" placeholder="Nhập tên size">
            @error('size_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-success mt-3">Thêm</button>
        <a href="{{ route('admin.products.create') }}" class="btn btn-secondary mt-3">Quay lại</a>
    </form>
</div>
@endsection
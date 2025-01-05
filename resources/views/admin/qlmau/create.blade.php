@extends('layouts.admin')
@section('content')
    <div class="container">
        <h1>Thêm màu mới</h1>
        <form action="{{ route('colors.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="color_name">Tên màu</label>
                <input type="text" name="color_name" id="color_name" class="form-control" placeholder="Nhập tên màu">
                @error('color_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success mt-3">Thêm</button>
            <a href="{{ route('products.create') }}" class="btn btn-secondary mt-3">Quay lại</a>
        </form>
    </div>
@endsection

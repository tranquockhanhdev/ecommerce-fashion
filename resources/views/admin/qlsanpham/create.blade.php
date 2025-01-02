@extends('layouts.admin')
@section('content')
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Tên sản phẩm -->
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <!-- Chọn danh mục -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Chọn danh mục</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Thêm hình ảnh sản phẩm (cho phép chọn nhiều hình ảnh) -->
        <div class="mb-3">
            <label for="images" class="form-label">Hình ảnh sản phẩm</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <!-- Các trường khác như màu sắc, kích thước, ... -->

        <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
    </form>
@endsection

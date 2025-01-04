@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Thêm Sản Phẩm</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation"
            novalidate>
            @csrf

            <div class="row">
                <!-- Danh mục -->
                <div class="mb-3 col-md-6">
                    <label for="category_id" class="form-label">Danh mục:</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tên sản phẩm -->
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Tên sản phẩm:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên sản phẩm"
                        required>
                </div>
            </div>

            <div class="row">
                <!-- Giá -->
                <div class="mb-3 col-md-6">
                    <label for="price" class="form-label">Giá:</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="Nhập giá sản phẩm"
                        required>
                </div>

                <!-- Số lượng -->
                <div class="mb-3 col-md-6">
                    <label for="quantity" class="form-label">Số lượng:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Nhập số lượng"
                        required>
                </div>
            </div>

            <!-- Mô tả -->
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả:</label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Nhập mô tả sản phẩm"
                    required></textarea>
            </div>

            <div class="row">
                <!-- Trạng thái -->
                <div class="mb-3 col-md-6">
                    <label for="status" class="form-label">Trạng thái:</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="1">Còn hàng</option>
                        <option value="0">Hết hàng</option>
                    </select>
                </div>

                <!-- Hình ảnh -->
                <div class="mb-3 col-md-6">
                    <label for="images" class="form-label">Hình ảnh:</label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple required>
                    <small class="text-muted">Bạn có thể chọn nhiều ảnh</small>
                </div>
            </div>

            <div class="row">
                <!-- Chọn màu -->
                <div class="mb-3 col-md-6">
                    <label for="color_id" class="form-label">Màu sắc:</label>
                    <select name="color_id" id="color_id" class="form-select" required>
                        <option value="">-- Chọn màu sắc --</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                        @endforeach
                    </select>
                    <a href="" class="btn btn-link">Thêm mới màu sắc</a>
                </div>

                <!-- Chọn kích thước -->
                <div class="mb-3 col-md-6">
                    <label for="size_id" class="form-label">Kích thước:</label>
                    <select name="size_id" id="size_id" class="form-select" required>
                        <option value="">-- Chọn kích thước --</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                        @endforeach
                    </select>
                    <a href="" class="btn btn-link">Thêm mới kích thước</a>
                </div>
            </div>

            <!-- Nút thêm -->
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </form>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Chỉnh sửa sản phẩm</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Tên sản phẩm -->
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <!-- Danh mục -->
            <div class="form-group">
                <label for="category_id">Danh mục</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Giá -->
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}"
                    required>
            </div>

            <!-- Số lượng -->
            <div class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $product->quantity }}"
                    required>
            </div>

            <!-- Mô tả -->
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ $product->description }}</textarea>
            </div>

            <!-- Trạng thái -->
            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="1" {{ $product->status ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ !$product->status ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            <!-- Hình ảnh -->
            <div class="form-group">
                <label>Hình ảnh hiện tại</label>
                <div class="row">
                    @foreach ($product->images as $image)
                        <div class="col-md-3">
                            <img src="{{ asset($image->link) }}" class="img-fluid mb-3" alt="Product Image">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="images">Thay đổi hình ảnh</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>

            <!-- Màu sắc -->
            <div class="form-group">
                <label for="color_ids">Màu sắc</label>
                <select name="color_ids[]" id="color_ids" class="form-control" multiple>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}"
                            {{ in_array($color->id, $product->details->pluck('colorproduct_id')->toArray()) ? 'selected' : '' }}>
                            {{ $color->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Kích thước -->
            <div class="form-group">
                <label for="size_ids">Kích thước</label>
                <select name="size_ids[]" id="size_ids" class="form-control" multiple>
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}"
                            {{ in_array($size->id, $product->details->pluck('sizeproduct_id')->toArray()) ? 'selected' : '' }}>
                            {{ $size->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nút lưu -->
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
@endsection

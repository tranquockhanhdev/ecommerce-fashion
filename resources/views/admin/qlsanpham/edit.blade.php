@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">Chỉnh sửa sản phẩm</h2>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Tên sản phẩm -->
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold text-dark">Tên sản phẩm</label>
                    <input type="text" name="name" id="name" class="form-control form-control-lg shadow-sm"
                        value="{{ $product->name }}" required>
                </div>

                <!-- Danh mục -->
                <div class="mb-4">
                    <label for="category_id" class="form-label fw-bold text-dark">Danh mục</label>
                    <select name="category_id" id="category_id" class="form-select form-select-lg shadow-sm" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Giá và Số lượng -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="price" class="form-label fw-bold text-dark">Giá</label>
                        <input type="number" name="price" id="price" class="form-control form-control-lg shadow-sm"
                            value="{{ $product->price }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="quantity" class="form-label fw-bold text-dark">Số lượng</label>
                        <input type="number" name="quantity" id="quantity" class="form-control form-control-lg shadow-sm"
                            value="{{ $product->quantity }}" required>
                    </div>
                </div>

                <!-- Mô tả -->
                <div class="mb-4">
                    <label for="description" class="form-label fw-bold text-dark">Mô tả</label>
                    <textarea name="description" id="description" class="form-control form-control-lg shadow-sm" rows="5" required>{{ $product->description }}</textarea>
                </div>

                <!-- Trạng thái -->
                <div class="mb-4">
                    <label for="status" class="form-label fw-bold text-dark">Trạng thái</label>
                    <select name="status" id="status" class="form-select form-select-lg shadow-sm" required>
                        <option value="1" {{ $product->status ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ !$product->status ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                <!-- Hình ảnh -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Hình ảnh hiện tại</label>
                    <div class="row g-3">
                        @foreach ($product->images as $image)
                            <div class="col-md-3 position-relative">
                                <img src="{{ asset($image->link) }}" class="img-fluid rounded shadow-sm"
                                    alt="Product Image">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                    data-image-id="{{ $image->id }}" onclick="removeImage(this)">
                                    X
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Thêm hoặc thay đổi hình ảnh -->
                <div class="mb-4">
                    <label for="images" class="form-label fw-bold text-dark">Thêm mới hình ảnh</label>
                    <input type="file" name="images[]" id="images" class="form-control shadow-sm" multiple
                        onchange="previewImages()">
                    <div id="image-preview" class="row mt-3"></div> <!-- Preview images will be shown here -->
                </div>

                <div class="row">
                    <!-- Chọn màu -->
                    <div class="mb-3 col-md-6">
                        <label for="color_ids" class="form-label fw-bold">Màu sắc:</label>
                        <div>
                            @foreach ($colors as $color)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="color_ids[]"
                                        value="{{ $color->id }}" id="color_{{ $color->id }}"
                                        {{ in_array($color->id, $product->details->pluck('colorproduct_id')->toArray()) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="color_{{ $color->id }}">
                                        {{ $color->color_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <a href="" class="btn btn-link">Thêm mới màu sắc</a>
                    </div>

                    <!-- Chọn kích thước -->
                    <div class="mb-3 col-md-6">
                        <label for="size_ids" class="form-label fw-bold">Kích thước:</label>
                        <div>
                            @foreach ($sizes as $size)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="size_ids[]"
                                        value="{{ $size->id }}" id="size_{{ $size->id }}"
                                        {{ in_array($size->id, $product->details->pluck('sizeproduct_id')->toArray()) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="size_{{ $size->id }}">
                                        {{ $size->size_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <a href="" class="btn btn-link">Thêm mới kích thước</a>
                    </div>
                </div>

                <!-- Nút lưu -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg px-5 py-3 shadow-sm">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function removeImage(button) {
            const imageId = button.getAttribute('data-image-id'); // Get image ID (add it in the button)

            if (confirm('Are you sure you want to delete this image?')) {
                // Get the CSRF token from the page
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Use AJAX to delete the image
                $.ajax({
                    url: '/delete-image/' + imageId, // Define the route in your web.php
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Add the CSRF token to the request headers
                    },
                    success: function(response) {
                        // If successful, remove the image from the DOM
                        button.closest('.col-md-3').remove();
                        alert('Image deleted successfully.');
                    },
                    error: function() {
                        alert('Failed to delete the image.');
                    }
                });
            }
        }

        function previewImages() {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Clear previous previews

            const files = document.getElementById('images').files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(event) {
                    const imgElement = document.createElement('img');
                    imgElement.src = event.target.result;
                    imgElement.classList.add('img-fluid', 'rounded', 'shadow-sm');
                    imgElement.style.width = '100px';
                    imgElement.style.marginRight = '10px';
                    previewContainer.appendChild(imgElement);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

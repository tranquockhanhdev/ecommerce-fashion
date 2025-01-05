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
                    <input type="text" name="name" id="slug" onkeyup="ChangeToSlug()"
                        class="form-control form-control-lg shadow-sm" value="{{ $product->name }}" required>
                </div>
                <!-- Slug -->
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold text-dark">Slug</label>
                    <input type="text" name="slug" id="convert_slug" class="form-control form-control-lg shadow-sm"
                        value="{{ $product->slug }}" required>
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
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                    <small class="text-muted">Bạn có thể chọn nhiều ảnh</small>

                    <!-- Khu vực hiển thị ảnh preview -->
                    <div id="preview-images" class="mt-3"></div>
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

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg px-5 py-3 shadow-sm">Lưu thay đổi</button>
                    <a href="{{ route('products.index') }}"
                        class="btn btn-secondary btn-lg px-5 py-3 shadow-sm ml-3">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        // Khởi tạo CKEditor cho textarea
        CKEDITOR.replace('description', {
            language: 'vi', // Ngôn ngữ tiếng Việt
            filebrowserBrowseUrl: '/browser/browse.php',
            filebrowserUploadUrl: '/uploader/upload.php',
        });
    </script>
    <script>
        function removeImage(button) {
            const imageId = button.getAttribute('data-image-id'); // Get image ID (add it in the button)

            if (confirm('Bạn có chắc chắn muốn xóa hình ảnh này?')) {
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
                        alert('Xóa hình ảnh thành công!.');
                    },
                    error: function() {
                        alert('Xóa hình ảnh thất bại!.');
                    }
                });
            }
        }

        // Script preview hình ảnh
        document.getElementById('images').addEventListener('change', function(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('preview-images');
            previewContainer.innerHTML = ''; // Xóa nội dung cũ

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgWrapper = document.createElement('div');
                    imgWrapper.style.position = 'relative';
                    imgWrapper.style.display = 'inline-block';
                    imgWrapper.style.margin = '10px';
                    imgWrapper.style.border = '1px solid #ddd';
                    imgWrapper.style.borderRadius = '8px';
                    imgWrapper.style.width = '120px';
                    imgWrapper.style.height = '120px';
                    imgWrapper.style.overflow = 'hidden';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover'; // Giữ tỉ lệ ảnh đúng mà không bị méo
                    img.style.borderRadius = '4px';

                    const deleteBtn = document.createElement('button');
                    deleteBtn.innerText = 'X';
                    deleteBtn.style.position = 'absolute';
                    deleteBtn.style.top = '5px';
                    deleteBtn.style.right = '5px';
                    deleteBtn.style.backgroundColor = 'rgba(255, 0, 0, 0.7)';
                    deleteBtn.style.color = 'white';
                    deleteBtn.style.border = 'none';
                    deleteBtn.style.borderRadius = '50%';
                    deleteBtn.style.width = '20px';
                    deleteBtn.style.height = '20px';
                    deleteBtn.style.fontSize = '12px';
                    deleteBtn.style.cursor = 'pointer';
                    deleteBtn.style.display = 'flex';
                    deleteBtn.style.justifyContent = 'center';
                    deleteBtn.style.alignItems = 'center';

                    deleteBtn.addEventListener('click', function() {
                        imgWrapper.remove();
                    });

                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(deleteBtn);
                    previewContainer.appendChild(imgWrapper);
                };
                reader.readAsDataURL(file);
            });
        });
        document.querySelector('form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const category = document.getElementById('category_id').value;
            const price = document.getElementById('price').value.trim();
            const quantity = document.getElementById('quantity').value.trim();
            const description = document.getElementById('description').value.trim();
            const images = document.getElementById('images').files;

            if (!name || !category || !price || !quantity || !description) {
                alert('Vui lòng điền đầy đủ thông tin các trường bắt buộc!');
                e.preventDefault(); // Prevent form submission
                return;
            }

            if (price <= 0) {
                alert('Giá sản phẩm phải lớn hơn 0!');
                e.preventDefault();
                return;
            }

            if (quantity < 0) {
                alert('Số lượng không được nhỏ hơn 0!');
                e.preventDefault();
                return;
            }

            if (images.length > 0) {
                for (let i = 0; i < images.length; i++) {
                    if (!['image/jpeg', 'image/png', 'image/jpg', 'image/gif'].includes(images[i].type)) {
                        alert('Chỉ hỗ trợ các định dạng hình ảnh: jpeg, png, jpg, gif.');
                        e.preventDefault();
                        return;
                    }
                }
            }
        });
    </script>
@endsection

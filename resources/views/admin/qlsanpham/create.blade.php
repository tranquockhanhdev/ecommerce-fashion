@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-4 p-5 border-0">
        <h1 class="text-center mb-4 text-primary font-weight-bold">Thêm Sản Phẩm</h1>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation"
            novalidate>
            @csrf
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="row g-4">
                <!-- Danh mục -->
                <div class="col-md-6">
                    <label for="category_id" class="form-label fw-bold text-dark">Danh mục:</label>
                    <select name="category_id" id="category_id" class="form-select form-select-lg shadow-sm" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Tên sản phẩm -->
                <div class="col-md-6">
                    <label for="name" class="form-label fw-bold text-dark">Tên sản phẩm:</label>
                    <input type="text" name="name" id="slug" onkeyup="ChangeToSlug()"
                        class="form-control form-control-lg shadow-sm" placeholder="Nhập tên sản phẩm"
                        value="{{ old('name') }}" required>
                    @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>


            </div>

            <div class="row g-4">
                <!-- Giá -->
                <div class="col-md-6">
                    <label for="price" class="form-label fw-bold text-dark">Giá:</label>
                    <input type="number" name="price" id="price" class="form-control form-control-lg shadow-sm"
                        placeholder="Nhập giá sản phẩm" value="{{ old('price') }}" required>
                    @error('price')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="quantity" class="form-label fw-bold text-dark">Số lượng:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control form-control-lg shadow-sm"
                        placeholder="Nhập số lượng" value="{{ old('quantity') }}" required>
                    @error('quantity')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="row g-4">
                <!-- Slug -->
                <div class="col-md-6">
                    <label for="slug" class="form-label fw-bold text-dark">Slug:</label>
                    <input type="text" name="slug" id="convert_slug"
                        class="form-control form-control-lg shadow-sm" placeholder="Nhập slug cho sản phẩm"
                        value="{{ old('slug') }}" required>
                    @error('slug')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Mô tả -->
            <div class="mb-4">
                <label for="description" class="form-label fw-bold text-dark">Mô tả:</label>
                <textarea name="description" id="description" class="form-control form-control-lg shadow-sm" rows="4"
                    placeholder="Nhập mô tả sản phẩm" required>{{ old('description') }}</textarea>
                @error('description')
                <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>


            <div class="row g-4">
                <!-- Trạng thái -->
                <div class="mb-3 col-md-6">
                    <label for="status" class="form-label fw-bold text-dark">Trạng thái:</label>
                    <select name="status" id="status" class="form-select form-select-lg shadow-sm" required>
                        <option value="1">Hiển Thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>


                <!-- Hình ảnh -->
                <div class="mb-3 col-md-4">
                    <label for="images" class="form-label">Hình ảnh:</label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                    <small class="text-muted">Bạn có thể chọn nhiều ảnh</small>

                    <!-- Khu vực hiển thị ảnh preview -->
                    <div id="preview-images" class="mt-3"></div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Chọn màu -->
                <div class="col-md-6">
                    <label for="color_ids" class="form-label fw-bold text-dark">Màu sắc:</label>
                    <div class="d-flex flex-column">
                        @foreach ($colors as $color)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="color_ids[]"
                                value="{{ $color->id }}" id="color_{{ $color->id }}">
                            <label class="form-check-label"
                                for="color_{{ $color->id }}">{{ $color->color_name }}</label>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('admin.colors.create') }}" class="btn btn-link text-primary mt-2">Thêm mới màu
                        sắc</a>
                </div>

                <!-- Chọn kích thước -->
                <div class="col-md-6">
                    <label for="size_ids" class="form-label fw-bold text-dark">Kích thước:</label>
                    <div class="d-flex flex-column">
                        @foreach ($sizes as $size)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="size_ids[]"
                                value="{{ $size->id }}" id="size_{{ $size->id }}">
                            <label class="form-check-label"
                                for="size_{{ $size->id }}">{{ $size->size_name }}</label>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('admin.sizes.create') }}" class="btn btn-link text-primary mt-2">Thêm mới kích
                        thước</a>
                </div>
            </div>

            <!-- Nút thêm -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg shadow-lg">Thêm sản phẩm</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-lg  shadow-lg">Quay lại</a>
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
</script>
@endsection
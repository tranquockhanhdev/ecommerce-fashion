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
                <div class="mb-3">
                    <label for="images" class="form-label">Hình ảnh:</label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                    <small class="text-muted">Bạn có thể chọn nhiều ảnh</small>

                    <!-- Khu vực hiển thị ảnh preview -->
                    <div id="preview-images" class="mt-3"></div>
                </div>
            </div>

            <div class="row">
                <!-- Chọn màu -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">Màu sắc:</label>
                    <div class="row">
                        @foreach ($colors as $color)
                            <div class="col-md-4 col-sm-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="color_ids[]"
                                        value="{{ $color->id }}" id="color{{ $color->id }}">
                                    <label class="form-check-label"
                                        for="color{{ $color->id }}">{{ $color->color_name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Chọn kích thước -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">Kích thước:</label>
                    <div class="row">
                        @foreach ($sizes as $size)
                            <div class="col-md-4 col-sm-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="size_ids[]"
                                        value="{{ $size->id }}" id="size{{ $size->id }}">
                                    <label class="form-check-label"
                                        for="size{{ $size->id }}">{{ $size->size_name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="#" class="btn btn-link mt-2">Thêm mới kích thước</a>
                </div>
            </div>



            <!-- Nút thêm -->
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </form>
    </div>
@endsection
@section('script')
    <script>
        document.getElementById('images').addEventListener('change', function(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('preview-images');
            previewContainer.innerHTML = ''; // Xoá nội dung cũ

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Tạo container cho mỗi ảnh
                    const imgWrapper = document.createElement('div');
                    imgWrapper.style.position = 'relative';
                    imgWrapper.style.display = 'inline-block';
                    imgWrapper.style.marginRight = '10px';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.width = 100; // Set kích thước preview

                    // Tạo nút "X" để xóa ảnh
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

                    // Xử lý sự kiện xóa ảnh
                    deleteBtn.addEventListener('click', function() {
                        imgWrapper.remove();
                    });

                    // Gắn các phần tử vào nhau
                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(deleteBtn);
                    previewContainer.appendChild(imgWrapper);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection

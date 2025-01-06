<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="h3 mb-0 text-gray-800">Chỉnh Sửa Website</h6>
    </a>
    <!-- Card Content - Collapse -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
    </div>
    @endif

    <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
            <form id="websiteInfoForm" action="{{ route('admin.update', $website->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Site Name -->
                <label for="siteName" class="form-label">Tên Website</label>
                <input type="text" class="form-control @error('site_name') is-invalid @enderror" id="siteName" name="site_name" placeholder="Điền Tên Website" value="{{ old('site_name', $website->site_name) }}" required>
                @error('site_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{ old('email', $website->email) }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Số Điện Thoại</label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone', $website->phone) }}" required>
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label for="address" class="form-label">Địa Chỉ</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Enter address" required>{{ old('address', $website->address) }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Hiển thị logo hiện tại -->
                @if($website->logo)
                <div class="mb-3">
                    <label for="current-logo" class="form-label">Logo Hiện Tại</label><br>
                    <img src="{{ asset('storage/logos/' . $website->logo) }}" alt="Current Logo" width="150">
                </div>
                @endif

                <!-- Logo mới (tải lên) -->
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo Mới</label>
                    <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*" onchange="previewImage(event)">
                    @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="mt-2">
                        <img id="logoPreview" src="#" alt="Logo Preview" style="display:none;" width="150">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
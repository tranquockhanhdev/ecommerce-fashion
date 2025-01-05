@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-0 text-gray-800">Thêm Liên Hệ</h1>
    <hr>
    <form action="{{ route('admin.qllienhe.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_name">Tên Người Dùng</label>
            <input type="text" class="form-control" id="user_name" name="user_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="title">Tiêu Đề</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Nội Dung</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>
        <div class="form-group">
            <label for="status">Trạng Thái</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active">Chưa Xử Lý</option>
                <option value="inactive">Đã Xử Lý</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.qllienhe.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection

@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2>Sửa liên hệ</h2>

        <form action="{{ route('admin.qllienhe.update', $contact->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="user_name">Tên người dùng:</label>
                <input type="text" name="user_name" class="form-control" value="{{ old('user_name', $contact->user_name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $contact->email) }}" required>
            </div>

            <div class="form-group">
                <label for="title">Tiêu đề:</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $contact->title) }}" required>
            </div>

            <div class="form-group">
                <label for="content">Nội dung:</label>
                <textarea name="content" class="form-control" rows="4" required>{{ old('content', $contact->content) }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Trạng thái:</label>
                <select name="status" class="form-control" required>
                    <option value="chờ duyệt" {{ $contact->status == 0 ? 'selected' : '' }}>Chờ duyệt</option>
                    <option value="đã duyệt" {{ $contact->status == 1 ? 'selected' : '' }}>Đã duyệt</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection

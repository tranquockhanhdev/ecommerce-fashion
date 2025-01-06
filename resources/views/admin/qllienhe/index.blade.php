@extends('layouts.admin')
@section('content')
<h1 class="h3 mb-0 text-gray-800">Quản lí liên hệ</h1>
<hr>
<div class="d-flex justify-content-between">
    <a href="{{ route('admin.qllienhe.create') }}" class="btn btn-success btn-icon-split mb-3">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Thêm Liên Hệ</span>
    </a>
    <a href="#" class="btn btn-success btn-icon-split mb-3 ">
        <span class="icon text-white-50">
            <i class="fas fa-print"></i>
        </span>
        <span class="text">In Danh Sách</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Bảng Liên Hệ</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Tiêu Đề</th>
                        <th>Nội Dung</th>
                        <th>Trạng Thái</th>
                        <th>Thời Gian Tạo</th>
                        <th>Thời Gian Cập Nhật</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->user_name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->title }}</td>
                            <td>{{ $contact->content }}</td>
                            <td>{{ $contact->status }}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td>{{ $contact->updated_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.qllienhe.edit', $contact->id) }}"
                                        class="btn btn-primary btn-icon-split mr-2">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i> Sửa
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.qllienhe.destroy', $contact->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-icon-split mr-2"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i> Xóa
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('js/demo/datatables-demo.js')}}"></script>
@endsection

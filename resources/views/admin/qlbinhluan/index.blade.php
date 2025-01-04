@extends('layouts.admin')
@section('content')
<h1 class="h3 mb-0 text-gray-800">Quản lí bình luận</h1>
<hr>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Bảng bình luận</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID sản phẩm</th>
                        <th>ID người dùng</th>
                        <th>Nội dung</th>
                        <th>Đánh giá</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->product_id }}</td>
                            <td>{{ $comment->account_id }}</td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->rating }}</td>
                            <td>
                                <button class="btn btn-sm status-toggle {{ $comment->status == 1 ? 'btn-success' : 'btn-danger' }}" 
                                        onclick="toggleStatus({{ $comment->id }}, {{ $comment->status }})">
                                    {{ $comment->status == 1 ? 'Hiện' : 'Ẩn' }}
                                </button>
                            </td>
                            <td>{{ $comment->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <form action="{{ route('qlbinhluan.destroy', $comment->id) }}" method="POST"
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
<script>
    function toggleStatus(commentId, currentStatus) {
        let newStatus = currentStatus === 1 ? 0 : 1;

        $.ajax({
            url: `qlbinhluan/${commentId}`,  
            type: "PUT",
            data: {
                _token: "{{ csrf_token() }}",
                status: newStatus
            },
            success: function (response) {
                if (response.success) {
                    let button = $(`button[onclick="toggleStatus(${commentId}, ${currentStatus})"]`);
                    button.toggleClass('btn-success btn-danger');
                    button.text(newStatus === 1 ? 'Hiện' : 'Ẩn');
                    button.attr('onclick', `toggleStatus(${commentId}, ${newStatus})`);
                } else {
                    alert('Có lỗi xảy ra! Vui lòng thử lại.');
                }
            },
            error: function () {
                alert('Có lỗi xảy ra! Vui lòng thử lại.');
            }
        });
    }
</script>


@endsection
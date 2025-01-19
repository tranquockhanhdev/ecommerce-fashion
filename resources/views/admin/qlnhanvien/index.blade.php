@extends('layouts.admin')
@section('content')
<h1 class="h3 mb-0 text-gray-800">Quản lí nhân viên</h1>
<hr>
<div class="d-flex justify-content-between">
    <a href="#" class="btn btn-success btn-icon-split mb-3">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Thêm Nhân Viên</span>
    </a>
    <a href="#" class="btn btn-success btn-icon-split mb-3 ">
        <span class="icon text-white-50">
            <i class="fas fa-print"></i>
        </span>
        <span class="text">In Danh Sách</span>
    </a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Bảng Nhân Viên</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ</th>
                        <th>Tên</th>
                        <th>Ngày Sinh</th>
                        <th>Email</th>
                        <th>Mật Khẩu</th>
                        <th>Trạng Thái</th>
                        <th>Thời gian tạo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Họ</th>
                        <th>Tên</th>
                        <th>Ngày Sinh</th>
                        <th>Email</th>
                        <th>Mật Khẩu</th>
                        <th>Trạng Thái</th>
                        <th>Thời gian tạo</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Trần Quốc</td>
                        <td>Khánh</td>
                        <td>19/10/2004</td>
                        <td>khanhdev@gmail.com</td>
                        <td>ok13213@aA</td>
                        <td>Đang hoạt động</td>
                        <td>25/12/2024</td>
                        <td>
                            <div class="d-flex">
                                <a href=" #" class="btn btn-primary btn-icon-split mr-2 ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i> Sửa
                                    </span>
                                </a>
                                <a href="#" class="btn btn-danger btn-icon-split ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i> Xoá
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Trần Quốc</td>
                        <td>Khánh</td>
                        <td>19/10/2004</td>
                        <td>khanhdev@gmail.com</td>
                        <td>ok13213@aA</td>
                        <td>Đang hoạt động</td>
                        <td>25/12/2024</td>
                        <td>
                            <div class="d-flex">
                                <a href=" #" class="btn btn-primary btn-icon-split mr-2 ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i> Sửa
                                    </span>
                                </a>
                                <a href="#" class="btn btn-danger btn-icon-split ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i> Xoá
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Trần Quốc</td>
                        <td>Khánh</td>
                        <td>19/10/2004</td>
                        <td>khanhdev@gmail.com</td>
                        <td>ok13213@aA</td>
                        <td>Đang hoạt động</td>
                        <td>25/12/2024</td>
                        <td>
                            <div class="d-flex">
                                <a href=" #" class="btn btn-primary btn-icon-split mr-2 ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i> Sửa
                                    </span>
                                </a>
                                <a href="#" class="btn btn-danger btn-icon-split ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i> Xoá
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Trần Quốc</td>
                        <td>Khánh</td>
                        <td>19/10/2004</td>
                        <td>khanhdev@gmail.com</td>
                        <td>ok13213@aA</td>
                        <td>Đang hoạt động</td>
                        <td>25/12/2024</td>
                        <td>
                            <div class="d-flex">
                                <a href=" #" class="btn btn-primary btn-icon-split mr-2 ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i> Sửa
                                    </span>
                                </a>
                                <a href="#" class="btn btn-danger btn-icon-split ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i> Xoá
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Trần Quốc</td>
                        <td>Khánh</td>
                        <td>19/10/2004</td>
                        <td>khanhdev@gmail.com</td>
                        <td>ok13213@aA</td>
                        <td>Đang hoạt động</td>
                        <td>25/12/2024</td>
                        <td>
                            <div class="d-flex">
                                <a href=" #" class="btn btn-primary btn-icon-split mr-2 ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i> Sửa
                                    </span>
                                </a>
                                <a href="#" class="btn btn-danger btn-icon-split ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i> Xoá
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Trần Quốc</td>
                        <td>Khánh</td>
                        <td>19/10/2004</td>
                        <td>khanhdev@gmail.com</td>
                        <td>ok13213@aA</td>
                        <td>Đang hoạt động</td>
                        <td>25/12/2024</td>
                        <td>
                            <div class="d-flex">
                                <a href=" #" class="btn btn-primary btn-icon-split mr-2 ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i> Sửa
                                    </span>
                                </a>
                                <a href="#" class="btn btn-danger btn-icon-split ">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i> Xoá
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js')}}"></script>


@endsection
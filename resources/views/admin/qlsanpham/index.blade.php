@extends('layouts.admin')
@section('content')
    <h1 class="h3 mb-0 text-gray-800">Quản lí sản phẩm</h1>
    <hr>
    <div class="d-flex justify-content-between">
        <a href="#" class="btn btn-success btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Thêm sản phẩm</span>
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
            <h6 class="m-0 font-weight-bold text-primary">Bảng sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Ảnh</th>
                            <th>Màu sắc</th>
                            <th>Kích thước</th>
                            <th>Số lượng</th>
                            <th>Trạng Thái </th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Ảnh</th>
                            <th>Màu sắc</th>
                            <th>Kích thước</th>
                            <th>Số lượng</th>
                            <th>Trạng Thái </th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'Không có danh mục' }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    @foreach ($product->images as $image)
                                        <img src="{{ $image->link }}" alt="Ảnh sản phẩm"
                                            style="width: 50px; height: 50px;">
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->details as $detail)
                                        {{ $detail->color->color_name ?? 'Không có màu' }},
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->details as $detail)
                                        {{ $detail->size->sizename ?? 'Không có kích thước' }},
                                    @endforeach
                                </td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->status }}</td>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection

@extends('layouts.admin')
@section('content')
<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
<hr>
<!-- Content Row -->
<div class="row">

    <!-- Số lượng đơn hàng đã bán  -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                            Đơn Hàng Đã Bán</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">13229</div><!-- Số lượng đơn hàng đã bán -->
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
                <hr>
                <a class="text-center text-xl font-weight-bold text-primary text-uppercase mb-1" href="{{ route('admin.qldonhang.index') }}" target="_blank">
                    Xem Thêm</a>
            </div>
        </div>
    </div>

    <!--  Tổng số liên hệ -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl font-weight-bold text-success text-uppercase mb-1">
                            Tổng số liên hệ</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div><!-- Tổng số liên hệ -->
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-address-book fa-2x text-gray-300"></i>
                    </div>
                </div>
                <hr>
                <a class="text-center text-xl font-weight-bold text-primary text-uppercase mb-1" href="{{ route('admin.qllienhe.index') }}" target="_blank">
                    Xem Thêm</a>
            </div>
        </div>
    </div>

    <!-- Tổng Khách Hàng -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl font-weight-bold text-info text-uppercase mb-1">Tổng Khách Hàng
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">622</div><!-- Tổng số Khách Hàng -->
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
                <hr>
                <a class="text-center text-xl font-weight-bold text-primary text-uppercase mb-1" href="{{ route('admin.qlkhachhang.index') }}" target="_blank">
                    Xem Thêm</a>
            </div>
        </div>
    </div>

    <!-- Tổng Doanh Thu -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">
                            Tổng Doanh Thu</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">6,220,000</div><!-- Tổng doanh thu -->
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
                <hr>
                <a class="text-center text-xl font-weight-bold text-primary text-uppercase mb-1" href="{{ route('admin.qldonhang.index') }}" target="_blank">
                    Xem Thêm</a>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Referral
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Thống Kê Tháng  -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl text-center font-weight-bold text-primary text-uppercase mb-1">
                            Thống Kê Tháng</div>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Doanh Thu Đơn</div>
                            <div>1,300,300đ</div><!-- doanh thu tháng -->
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Sản Phẩm Đã Bán</div>
                            <div>120</div><!-- sản phẩm tháng -->
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Khách Hàng Mới</div>
                            <div>1000</div><!-- khách hàng tháng -->
                        </div>
                        <hr>
                    </div>
                </div>

                <a class="text-center text-xl font-weight-bold text-primary text-uppercase mb-1" href="{{ route('admin.qldonhang.index') }}" target="_blank">
                    Xem Thêm</a>
            </div>
        </div>
    </div>

    <!--  Thống Kế Tuần -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl text-center font-weight-bold text-primary text-uppercase mb-1">
                            Thống Kê Tuần</div>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Doanh Thu Đơn</div>
                            <div>800,000đ</div><!-- doanh thu Tuần -->
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Sản Phẩm Đã Bán</div>
                            <div>100</div><!-- sản phẩm Tuần -->
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Khách Hàng Mới</div>
                            <div>50</div><!-- khách hàng Tuần -->
                        </div>
                    </div>
                </div>
                <hr>
                <a class="text-center text-xl font-weight-bold text-primary text-uppercase mb-1" href="{{ route('admin.qldonhang.index') }}" target="_blank">
                    Xem Thêm</a>
            </div>
        </div>
    </div>

    <!-- Thống Kê Ngày -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl text-center font-weight-bold text-primary text-uppercase mb-1">
                            Thống Kê Ngày</div>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Doanh Thu Đơn</div>
                            <div>300,000đ</div><!-- doanh thu Ngày -->
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Sản Phẩm Đã Bán</div>
                            <div>10</div><!-- sản phẩm Ngày -->
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Khách Hàng Mới</div>
                            <div>1</div><!-- khách hàng Ngày -->
                        </div>
                    </div>
                </div>
                <hr>
                <a class="text-center text-xl font-weight-bold text-primary text-uppercase mb-1" href="{{ route('admin.qldonhang.index') }}" target="_blank">
                    Xem Thêm</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- Page level plugins -->
<script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js')}}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js')}}"></script>
@endsection
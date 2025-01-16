@extends('layouts.admin')
@section('content')
@include('admin.home.WebsiteInfo')

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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ordered->count()}}</div><!-- Số lượng đơn hàng đã bán -->
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $contacted}}</div><!-- Tổng số liên hệ -->
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customer}}</div><!-- Tổng số Khách Hàng -->
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ number_format($ordered->sum('total'), 0, ',', '.') . ' VND' }}</div><!-- Tổng doanh thu -->
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
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thống Kê Doanh Thu Năm</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>

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
</div>
<div class="col-xl-12 col-md- mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xl text-center font-weight-bold text-primary text-uppercase mb-1">
                        Thống Kê Lượt Mua Sản Phẩm Trong Tuần</div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng Bán</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->total_quantity_sold }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Thống Kê Tháng -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl text-center font-weight-bold text-primary text-uppercase mb-1">
                            Thống Kê Tháng</div>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Doanh Thu Đơn</div>
                            <div>{{ number_format($orderedMonth) }}đ</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Sản Phẩm Đã Bán</div>
                            <div>{{ $productsSoldMonth }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Khách Hàng Mới</div>
                            <div>{{ $newCustomersMonth }}</div>
                        </div>
                        <hr>
                    </div>
                </div>

                <a class="text-center text-xl font-weight-bold text-primary text-uppercase mb-1" href="{{ route('admin.qldonhang.index') }}" target="_blank">
                    Xem Thêm</a>
            </div>
        </div>
    </div>

    <!-- Thống Kê Tuần -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl text-center font-weight-bold text-primary text-uppercase mb-1">
                            Thống Kê Tuần</div>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Doanh Thu Đơn</div>
                            <div>{{ number_format($orderedWeek) }}đ</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Sản Phẩm Đã Bán</div>
                            <div>{{ $productsSoldWeek }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Khách Hàng Mới</div>
                            <div>{{ $newCustomersWeek }}</div>
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
                            <div>{{ number_format($orderedDay) }}đ</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Sản Phẩm Đã Bán</div>
                            <div>{{ $productsSoldDay }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Khách Hàng Mới</div>
                            <div>{{ $newCustomersDay }}</div>
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
<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        }
    }, 2000); // 5 giây
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const image = document.getElementById('logoPreview');
            image.src = e.target.result;
            image.style.display = 'block'; // Hiển thị ảnh preview
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
<script>
    // Nhận dữ liệu từ backend (biến Laravel Blade)
    var months = @json($months); // Mảng tháng
    var revenues = @json($revenues); // Mảng doanh thu

    // Cấu hình biểu đồ
    var data = {
        labels: months.map(month => {
            const date = new Date(0);
            date.setMonth(month - 1); // Sửa tháng để lấy đúng tên tháng
            // Chuyển đổi tháng sang tên tiếng Việt
            const vietnameseMonths = [
                "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6",
                "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
            ];
            return vietnameseMonths[month - 1];
        }), // Tháng
        datasets: [{
            label: "Doanh Thu",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)", // Màu nền của đường
            borderColor: "rgba(78, 115, 223, 1)", // Màu đường biểu đồ
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)", // Màu nền các điểm trên đường
            pointBorderColor: "rgba(78, 115, 223, 1)", // Màu viền các điểm
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)", // Màu nền khi hover
            pointHoverBorderColor: "rgba(78, 115, 223, 1)", // Màu viền khi hover
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: revenues, // Doanh thu
        }],
    };

    var config = {
        type: 'line', // Biểu đồ đường
        data: data,
        options: {
            maintainAspectRatio: false, // Đảm bảo tỷ lệ khung hình
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date' // Cấu hình trục X để hiển thị theo ngày
                    },
                    gridLines: {
                        display: false, // Không hiển thị đường lưới
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7 // Giới hạn số lượng dấu hiệu trục X
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5, // Giới hạn số lượng dấu hiệu trục Y
                        padding: 10,
                        callback: function(value) {
                            return value.toLocaleString() + ' VND'; // Định dạng số tiền với đơn vị VND
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)", // Màu lưới trục Y
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false // Ẩn legend
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)", // Màu nền của tooltip
                bodyFontColor: "#858796", // Màu font của tooltip
                titleMarginBottom: 10,
                titleFontColor: '#6e707e', // Màu tiêu đề tooltip
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false, // Ẩn màu sắc của các điểm trong tooltip
                intersect: false, // Tooltip không hiển thị khi hover trực tiếp vào điểm
                mode: 'index', // Hiển thị giá trị tại điểm giao nhau
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + tooltipItem.yLabel.toLocaleString() + ' VND';
                    }
                }
            }
        }
    };

    // Vẽ biểu đồ
    var ctx = document.getElementById('myAreaChart').getContext('2d');
    var myLineChart = new Chart(ctx, config);
</script>


@endsection
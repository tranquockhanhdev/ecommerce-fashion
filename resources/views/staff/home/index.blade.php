@extends('layouts.admin')
@section('content')
<h1 class="h3 mb-0 text-gray-800">Trang Quản trị nhân viên</h1>

@endsection
@section('script')
<!-- Page level plugins -->
<script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js')}}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js')}}"></script>
@endsection
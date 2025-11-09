@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tổng quan</h1>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Đơn hàng mới</h5>
                    <p class="card-text display-6">0</p> </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.orders.index') }}" class="text-white text-decoration-none small stretched-link">Xem chi tiết</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Sản phẩm</h5>
                    <p class="card-text display-6">0</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.products.index') }}" class="text-white text-decoration-none small stretched-link">Xem chi tiết</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
         <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                     <h5 class="card-title">Khách hàng</h5>
                    <p class="card-text display-6">0</p>
                </div>
                 <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="#" class="text-white text-decoration-none small stretched-link">Xem chi tiết</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h5 class="card-title">Doanh thu</h5>
                    <p class="card-text display-6">0đ</p>
                </div>
                 <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="#" class="text-white text-decoration-none small stretched-link">Xem chi tiết</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <h2>Đơn hàng mới nhất</h2>
    <div class="table-responsive">
        <p class="text-muted">Chưa có dữ liệu.</p>
    </div>
@endsection
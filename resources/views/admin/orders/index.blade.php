@extends('admin.layout')
@section('title', 'Quản lý Đơn hàng')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Danh sách Đơn hàng</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ngày đặt</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        {{ $order->customer_name }}<br>
                        <small class="text-muted">{{ $order->customer_phone }}</small>
                    </td>
                    <td>{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                    <td>
                        @if($order->status == 0)
                            <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                        @elseif($order->status == 1)
                            <span class="badge bg-info text-dark">Đang giao</span>
                        @elseif($order->status == 2)
                            <span class="badge bg-success">Đã hoàn thành</span>
                        @else
                            <span class="badge bg-danger">Đã hủy</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">Xem chi tiết</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
@endsection
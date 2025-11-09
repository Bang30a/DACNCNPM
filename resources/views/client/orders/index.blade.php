@extends('client.layout')
@section('title', 'Đơn hàng của tôi')

@section('content')
    <h2 class="fw-bold mb-4">Lịch sử đơn hàng</h2>

    @if($orders->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                        <td>
                            @if($order->status == 0)
                                <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                            @elseif($order->status == 1)
                                <span class="badge bg-info text-dark">Đang giao hàng</span>
                            @elseif($order->status == 2)
                                <span class="badge bg-success">Hoàn thành</span>
                            @else
                                <span class="badge bg-danger">Đã hủy</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('client.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $orders->links() }}
    @else
        <div class="text-center py-5">
            <p class="text-muted mb-4">Bạn chưa có đơn hàng nào.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Mua sắm ngay</a>
        </div>
    @endif
@endsection
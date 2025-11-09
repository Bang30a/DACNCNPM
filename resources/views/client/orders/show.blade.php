@extends('client.layout')
@section('title', 'Chi tiết Đơn hàng #' . $order->id)

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Chi tiết Đơn hàng #{{ $order->id }}</h1>
        <a href="{{ route('client.orders.index') }}" class="btn btn-sm btn-outline-secondary">Quay lại Lịch sử</a>
    </div>

    <div class="row">
        <!-- Cột trái: Thông tin giao hàng -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white py-3 fw-bold">Thông tin nhận hàng</div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> {{ $order->customer_name }}</p>
                    <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Email:</strong> {{ $order->customer_email ?? 'Không có' }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                    <p><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</p>
                    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                     <p><strong>Trạng thái:</strong>
                        @if($order->status == 0)
                            <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                        @elseif($order->status == 1)
                            <span class="badge bg-info text-dark">Đang giao hàng</span>
                        @elseif($order->status == 2)
                            <span class="badge bg-success">Hoàn thành</span>
                        @else
                            <span class="badge bg-danger">Đã hủy</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Cột phải: Danh sách sản phẩm -->
        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 fw-bold">Chi tiết sản phẩm</div>
                <div class="card-body">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>SL</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->details as $detail)
                            <tr>
                                <td>{{ $detail->product_name }}</td>
                                <td>{{ number_format($detail->price, 0, ',', '.') }}đ</td>
                                <td>x {{ $detail->quantity }}</td>
                                <td class="text-end">{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold">
                                <td colspan="3" class="text-end">Tổng tiền:</td>
                                <td class="text-end text-danger fs-5">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
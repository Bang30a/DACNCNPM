@extends('admin.layout')
@section('title', 'Chi tiết Đơn hàng #' . $order->id)

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Đơn hàng #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary">Quay lại</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header fw-bold">Thông tin khách hàng</div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> {{ $order->customer_name }}</p>
                    <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Email:</strong> {{ $order->customer_email ?? 'Không có' }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                    <p><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</p>
                    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header fw-bold">Cập nhật trạng thái</div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <select name="status" class="form-select">
                                <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Chờ xác nhận</option>
                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đang giao hàng</option>
                                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đã hoàn thành</option>
                                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header fw-bold">Chi tiết sản phẩm</div>
                <div class="card-body">
                    <table class="table">
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
                                <td>
                                    {{ $detail->product_name }}
                                    </td>
                                <td>{{ number_format($detail->price, 0, ',', '.') }}đ</td>
                                <td>{{ $detail->quantity }}</td>
                                <td class="text-end">{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Tổng tiền:</td>
                                <td class="text-end fw-bold text-danger fs-5">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
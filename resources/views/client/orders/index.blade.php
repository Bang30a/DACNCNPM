@extends('client.layout')
@section('title', 'Lịch sử đơn hàng')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary"><i class="bi bi-clock-history me-2"></i>Lịch sử đơn hàng</h2>
                <a href="{{ route('client.shop') }}" class="btn btn-outline-primary">
                    <i class="bi bi-cart-plus me-1"></i> Tiếp tục mua sắm
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th class="py-3">Mã đơn</th>
                                    <th class="py-3">Ngày đặt</th>
                                    <th class="py-3 text-end">Tổng tiền</th>
                                    <th class="py-3">Thanh toán</th> {{-- CỘT MỚI --}}
                                    <th class="py-3">Trạng thái</th>
                                    <th class="py-3">Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="text-center fw-bold text-secondary">#{{ $order->id }}</td>
                                        <td class="text-center">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-end fw-bold text-danger fs-5">
                                            {{ number_format($order->total_amount) }}đ
                                        </td>
                                        
                                        {{-- Cột Thanh toán (Mới) --}}
                                        <td class="text-center">
                                            <div class="d-flex flex-column align-items-center">
                                                @if($order->payment_status == 'Paid')
                                                    <span class="badge bg-success mb-1"><i class="bi bi-check-circle-fill me-1"></i>Đã thanh toán</span>
                                                @else
                                                    <span class="badge bg-secondary mb-1"><i class="bi bi-hourglass-split me-1"></i>Chưa thanh toán</span>
                                                @endif
                                                <small class="text-muted" style="font-size: 0.8rem;">{{ $order->payment_method }}</small>
                                            </div>
                                        </td>

                                        {{-- Cột Trạng thái (Đồng bộ màu sắc với Admin) --}}
                                        <td class="text-center">
                                            @switch($order->status)
                                                @case(0)
                                                    <span class="badge bg-warning text-dark border border-warning">Chờ xác nhận</span>
                                                    @break
                                                @case(1)
                                                    <span class="badge bg-primary border border-primary">Đang xử lý</span>
                                                    @break
                                                @case(2)
                                                    <span class="badge bg-info text-dark border border-info">Đang giao hàng</span>
                                                    @break
                                                @case(3)
                                                    <span class="badge bg-success border border-success">Hoàn thành</span>
                                                    @break
                                                @case(4)
                                                    <span class="badge bg-danger border border-danger">Đã hủy</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary">Không xác định</span>
                                            @endswitch
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('client.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                Xem <i class="bi bi-arrow-right ms-1"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty" width="80" class="mb-3 opacity-50">
                                            <p class="text-muted fs-5">Bạn chưa có đơn hàng nào.</p>
                                            <a href="{{ route('client.shop') }}" class="btn btn-primary mt-2">Mua sắm ngay</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($orders->hasPages())
                    <div class="card-footer bg-white py-3">
                        <div class="d-flex justify-content-end">
                            {{ $orders->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
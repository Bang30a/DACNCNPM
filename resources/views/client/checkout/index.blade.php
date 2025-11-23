@extends('client.layout')
@section('title', 'Thanh toán')

@section('content')
<div class="py-5">
    <h2 class="mb-4 fw-bold text-center">Thanh toán</h2>
    
    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row">
            {{-- CỘT TRÁI: THÔNG TIN GIAO HÀNG --}}
            <div class="col-md-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary fw-bold"><i class="bi bi-person-lines-fill me-2"></i>Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <!-- Họ tên -->
                        <div class="mb-3">
                            <label class="form-label">Họ tên người nhận <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="customer_name" value="{{ auth()->user()->name ?? '' }}" required placeholder="Nhập họ tên người nhận">
                        </div>
                        
                        <div class="row">
                            <!-- SĐT -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="customer_phone" value="{{ auth()->user()->phone ?? '' }}" required placeholder="Nhập số điện thoại">
                            </div>
                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email (Để nhận thông báo đơn hàng)</label>
                                <input type="email" class="form-control" name="customer_email" value="{{ auth()->user()->email ?? '' }}" placeholder="example@gmail.com">
                            </div>
                        </div>

                        <!-- Địa chỉ -->
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="shipping_address" rows="2" required placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố">{{ auth()->user()->address ?? '' }}</textarea>
                        </div>

                        <!-- Ghi chú -->
                        <div class="mb-3">
                            <label class="form-label">Ghi chú đơn hàng (Tùy chọn)</label>
                            <textarea class="form-control" name="note" rows="2" placeholder="Ví dụ: Giao hàng giờ hành chính, gọi trước khi giao..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CỘT PHẢI: TÓM TẮT ĐƠN HÀNG & THANH TOÁN --}}
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary fw-bold"><i class="bi bi-cart-check-fill me-2"></i>Đơn hàng của bạn</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($cart as $item)
                                <li class="list-group-item d-flex justify-content-between lh-sm align-items-center">
                                    <div>
                                        <h6 class="my-0 text-dark">{{ $item['name'] }}</h6>
                                        <small class="text-muted">Đơn giá: {{ number_format($item['price']) }}đ x {{ $item['quantity'] }}</small>
                                    </div>
                                    <span class="text-dark fw-semibold">{{ number_format($item['price'] * $item['quantity']) }}đ</span>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between bg-light mt-2 rounded">
                                <span class="fw-bold">Tổng cộng (VND)</span>
                                <strong class="text-danger fs-4">{{ number_format($total) }}đ</strong>
                            </li>
                        </ul>

                        <hr>

                        {{-- PHẦN CHỌN PHƯƠNG THỨC THANH TOÁN --}}
                        <h6 class="mb-3 fw-bold text-uppercase">Phương thức thanh toán</h6>
                        
                        <div class="form-check mb-2 p-3 border rounded">
                            <input id="payment_cod" name="payment_method" type="radio" class="form-check-input" value="COD" checked>
                            <label class="form-check-label fw-semibold" for="payment_cod">
                                <i class="bi bi-cash-coin me-2 text-success"></i> Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>

                        <div class="form-check mb-4 p-3 border rounded bg-light">
                            {{-- Đã mở khóa input này --}}
                            <input id="payment_bank" name="payment_method" type="radio" class="form-check-input" value="BANK">
                            <label class="form-check-label fw-semibold" for="payment_bank">
                                <i class="bi bi-qr-code-scan me-2 text-primary"></i> Chuyển khoản ngân hàng (VietQR)
                            </label>
                            <div class="small text-muted ms-4 mt-1">
                                Quét mã QR tự động, xác nhận nhanh chóng.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-3 fw-bold fs-5 text-uppercase shadow">
                            ĐẶT HÀNG NGAY <i class="bi bi-arrow-right-circle ms-2"></i>
                        </button>
                        
                        <div class="text-center mt-3">
                            <a href="{{ route('cart.index') }}" class="text-decoration-none text-secondary"><i class="bi bi-arrow-left"></i> Quay lại giỏ hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
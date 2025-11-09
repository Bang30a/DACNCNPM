@extends('client.layout')
@section('title', 'Thanh toán')

@section('content')
    <h1 class="fw-bold mb-4">Thanh toán</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title fw-bold mb-0">Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Họ tên người nhận <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="customer_name" required placeholder="VD: Nguyễn Văn A">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="customer_phone" required placeholder="VD: 0987654321">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email (Tùy chọn)</label>
                                <input type="email" class="form-control" name="customer_email" placeholder="Để nhận thông báo đơn hàng">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="shipping_address" rows="3" required placeholder="VD: Số 123, Đường ABC, Quận XYZ, TP.HCM"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ghi chú đơn hàng (Tùy chọn)</label>
                            <textarea class="form-control" name="note" rows="2" placeholder="VD: Giao giờ hành chính, gọi trước khi giao..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title fw-bold mb-0">Đơn hàng của bạn</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($cart as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <h6 class="my-0">{{ $item['name'] }}</h6>
                                        <small class="text-muted">SL: {{ $item['quantity'] }} x {{ number_format($item['price'], 0, ',', '.') }}đ</small>
                                    </div>
                                    <span class="text-muted">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</span>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between px-0 fw-bold">
                                <span>Tổng cộng (VND)</span>
                                <span class="text-danger fs-5">{{ number_format($total, 0, ',', '.') }}đ</span>
                            </li>
                        </ul>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Phương thức thanh toán</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="COD" checked>
                                <label class="form-check-label" for="cod">
                                    Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="banking" value="BANKING" disabled>
                                <label class="form-check-label text-muted" for="banking">
                                    Chuyển khoản ngân hàng (Đang bảo trì)
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 btn-lg py-3 fw-bold">ĐẶT HÀNG NGAY</button>
                        <a href="{{ route('cart.index') }}" class="btn btn-link w-100 text-decoration-none mt-2">Quay lại giỏ hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
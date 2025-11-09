@extends('client.layout')
@section('title', 'Giỏ hàng của bạn')

@section('content')
    <h1 class="fw-bold mb-4">Giỏ hàng</h1>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" width="50%">Sản phẩm</th>
                                    <th scope="col" width="20%">Giá</th>
                                    <th scope="col" width="20%">Số lượng</th>
                                    <th scope="col" width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session('cart') as $id => $details)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($details['thumbnail'])
                                                    <img src="{{ asset('storage/' . $details['thumbnail']) }}" width="70" class="img-thumbnail me-3" alt="{{ $details['name'] }}">
                                                @else
                                                    <img src="https://via.placeholder.com/70x70" width="70" class="img-thumbnail me-3" alt="No Image">
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $details['name'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($details['price'], 0, ',', '.') }}đ</td>
                                        <td>
                                            <input type="number" value="{{ $details['quantity'] }}" class="form-control form-control-sm w-75" min="1">
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-link text-danger p-0" onclick="return confirm('Xóa sản phẩm này?');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Tổng cộng giỏ hàng</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tạm tính:</span>
                            <span class="fw-bold">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="h5 fw-bold">Tổng tiền:</span>
                            <span class="h5 fw-bold text-danger">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 btn-lg">TIẾN HÀNH ĐẶT HÀNG</a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <img src="https://www.shidori.com/assets/images/cart_empty.png" alt="Empty Cart" width="200" class="mb-4" style="opacity: 0.5;">
            <h4 class="text-muted">Giỏ hàng của bạn đang trống!</h4>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Quay lại trang chủ</a>
        </div>
    @endif
@endsection
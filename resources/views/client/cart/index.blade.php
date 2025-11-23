@extends('client.layout')
@section('title', 'Giỏ hàng')

@section('content')
<div class="py-5">
    <h2 class="fw-bold mb-4">Giỏ hàng của bạn</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="p-3">Sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th style="width: 120px;">Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(session('cart') as $id => $details)
                                        <tr data-id="{{ $id }}">
                                            <td class="p-3">
                                                <div class="d-flex align-items-center">
                                                    @if($details['thumbnail'])
                                                        <img src="{{ asset('storage/' . $details['thumbnail']) }}" alt="{{ $details['name'] }}" style="width: 70px; height: 70px; object-fit: contain;" class="me-3 border rounded">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0 text-truncate" style="max-width: 250px;">{{ $details['name'] }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="fw-semibold">{{ number_format($details['price']) }}đ</td>
                                            <td>
                                                <!-- Ô NHẬP SỐ LƯỢNG -->
                                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity-input text-center" min="1">
                                            </td>
                                            <!-- ID này để JS cập nhật giá tiền -->
                                            <td class="fw-bold text-primary item-total">{{ number_format($details['price'] * $details['quantity']) }}đ</td>
                                            <td>
                                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa sản phẩm này?')">
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
                <a href="{{ route('client.shop') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Tiếp tục mua sắm</a>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">Tổng đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tạm tính:</span>
                            <span class="fw-bold cart-total">{{ number_format($total) }}đ</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fs-5 fw-bold">Tổng cộng:</span>
                            <span class="fs-5 fw-bold text-danger cart-total">{{ number_format($total) }}đ</span>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary py-2 fw-bold text-uppercase">Tiến hành thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" alt="Empty Cart" width="120" class="mb-4 opacity-50">
            <h4>Giỏ hàng trống</h4>
            <p class="text-muted">Bạn chưa thêm sản phẩm nào vào giỏ hàng.</p>
            <a href="{{ route('client.shop') }}" class="btn btn-primary mt-3">Mua sắm ngay</a>
        </div>
    @endif
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Bắt sự kiện khi thay đổi ô số lượng
        $(".quantity-input").change(function (e) {
            e.preventDefault();

            var ele = $(this);
            var tr = ele.parents("tr");
            var quantity = ele.val();
            var id = tr.attr("data-id");

            if(quantity < 1) {
                alert("Số lượng phải lớn hơn 0");
                ele.val(1);
                return;
            }

            $.ajax({
                url: '{{ route('cart.update') }}', // Gọi route update
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: id, 
                    quantity: quantity
                },
                success: function (response) {
                    if(response.success) {
                        // Cập nhật giao diện mà không cần load lại trang
                        tr.find(".item-total").text(response.itemTotal + "đ"); // Cập nhật tiền từng món
                        $(".cart-total").text(response.cartTotal + "đ");       // Cập nhật tổng tiền
                        
                        // Hiệu ứng nháy nhẹ để báo đã cập nhật
                        tr.find(".item-total").fadeOut(100).fadeIn(100);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert("Có lỗi xảy ra, vui lòng thử lại");
                }
            });
        });
    });
</script>
@endsection
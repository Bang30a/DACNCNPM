@extends('client.layout')
@section('title', 'Hướng dẫn mua hàng online')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hướng dẫn mua hàng</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <h2 class="fw-bold text-primary mb-4 text-center">QUY TRÌNH MUA HÀNG TẠI COMPUTER SHOP</h2>
                    <p class="text-muted text-center mb-5">Mua sắm dễ dàng, tiện lợi chỉ với 4 bước đơn giản.</p>

                    <div class="row g-4">
                        {{-- Bước 1 --}}
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle fs-4 fw-bold shadow" style="width: 50px; height: 50px;">1</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fw-bold">Tìm kiếm sản phẩm</h5>
                                    <p class="text-muted">Bạn có thể tìm sản phẩm theo danh mục hoặc nhập tên sản phẩm vào thanh tìm kiếm ở đầu trang. Sử dụng bộ lọc để tìm kiếm nhanh hơn.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Bước 2 --}}
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle fs-4 fw-bold shadow" style="width: 50px; height: 50px;">2</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fw-bold">Thêm vào giỏ hàng</h5>
                                    <p class="text-muted">Tại trang chi tiết sản phẩm, bạn kiểm tra thông số kỹ thuật, giá bán và khuyến mãi. Sau đó nhấn nút <span class="fw-bold text-danger">"Thêm vào giỏ"</span> hoặc <span class="fw-bold text-danger">"Mua ngay"</span>.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Bước 3 --}}
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle fs-4 fw-bold shadow" style="width: 50px; height: 50px;">3</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fw-bold">Kiểm tra giỏ hàng & Đặt hàng</h5>
                                    <p class="text-muted">Vào giỏ hàng để kiểm tra lại số lượng sản phẩm. Nhấn nút <strong>"Thanh toán"</strong> để chuyển sang bước nhập thông tin giao hàng.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Bước 4 --}}
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle fs-4 fw-bold shadow" style="width: 50px; height: 50px;">4</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fw-bold">Hoàn tất đơn hàng</h5>
                                    <p class="text-muted">Điền đầy đủ thông tin giao hàng, chọn phương thức thanh toán (COD hoặc Chuyển khoản). Sau khi đặt hàng thành công, hệ thống sẽ gửi email xác nhận cho bạn.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-5 d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                        <div>
                            <strong>Cần hỗ trợ?</strong> Liên hệ ngay Hotline <strong>1900 1234</strong> để được nhân viên tư vấn trực tiếp.
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary px-4 py-2 fw-bold">Bắt đầu mua sắm ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
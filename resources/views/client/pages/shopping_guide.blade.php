@extends('client.layout')
@section('title', 'Hướng dẫn mua hàng online')

@section('css')
<style>
    /* === CSS RIÊNG CHO TRANG HƯỚNG DẪN === */

    /* Tiêu đề trang */
    .page-title {
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Card chứa từng bước */
    .guide-step-card {
        background: #fff;
        border: 1px solid #f0f0f0;
        border-radius: 16px;
        padding: 25px;
        height: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .guide-step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.1);
        border-color: rgba(13, 110, 253, 0.2);
    }

    /* Số thứ tự lớn làm nền mờ */
    .step-number-bg {
        position: absolute;
        right: -10px;
        bottom: -20px;
        font-size: 8rem;
        font-weight: 900;
        color: rgba(0, 0, 0, 0.03);
        z-index: -1;
        transition: all 0.3s;
    }
    
    .guide-step-card:hover .step-number-bg {
        color: rgba(13, 110, 253, 0.08);
        transform: scale(1.1);
    }

    /* Icon số tròn nhỏ */
    .step-badge {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        margin-right: 20px;
        flex-shrink: 0; /* Không bị co lại */
    }

    .step-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
    }

    /* Box hỗ trợ cuối trang */
    .support-box {
        background-color: #e7f1ff;
        border: 1px dashed #0d6efd;
        border-radius: 12px;
        padding: 20px;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Trang chủ</a></li>
            <li class="breadcrumb-item active fw-bold text-primary" aria-current="page">Hướng dẫn mua hàng</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    
                    {{-- Header --}}
                    <div class="text-center mb-5">
                        <div class="d-inline-block bg-light rounded-circle p-3 mb-3">
                            <i class="bi bi-cart-check text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h2 class="page-title mb-3">QUY TRÌNH MUA HÀNG</h2>
                        <p class="text-muted fs-5">Mua sắm tại GrabCatPC dễ dàng, tiện lợi chỉ với 4 bước đơn giản.</p>
                    </div>

                    <div class="row g-4">
                        {{-- Bước 1 --}}
                        <div class="col-md-6">
                            <div class="guide-step-card">
                                <span class="step-number-bg">1</span>
                                <div class="d-flex align-items-start">
                                    <div class="step-badge">1</div>
                                    <div>
                                        <h5 class="step-title">Tìm kiếm sản phẩm</h5>
                                        <p class="text-muted mb-0">
                                            Nhập tên sản phẩm vào ô <strong>"Tìm kiếm"</strong> hoặc duyệt qua các <strong>Danh mục</strong> (Laptop, PC, Linh kiện...) để chọn món đồ ưng ý.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bước 2 --}}
                        <div class="col-md-6">
                            <div class="guide-step-card">
                                <span class="step-number-bg">2</span>
                                <div class="d-flex align-items-start">
                                    <div class="step-badge">2</div>
                                    <div>
                                        <h5 class="step-title">Thêm vào giỏ hàng</h5>
                                        <p class="text-muted mb-0">
                                            Tại trang chi tiết, kiểm tra kỹ thông số và giá. Nhấn <span class="text-primary fw-bold"><i class="bi bi-cart-plus"></i> Thêm vào giỏ</span> nếu muốn mua nhiều món hoặc <span class="text-danger fw-bold">Mua ngay</span> để thanh toán luôn.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bước 3 --}}
                        <div class="col-md-6">
                            <div class="guide-step-card">
                                <span class="step-number-bg">3</span>
                                <div class="d-flex align-items-start">
                                    <div class="step-badge">3</div>
                                    <div>
                                        <h5 class="step-title">Kiểm tra & Đặt hàng</h5>
                                        <p class="text-muted mb-0">
                                            Vào <strong>Giỏ hàng</strong> để chốt số lượng. Nhấn nút <strong>"Thanh toán"</strong> để chuyển sang bước nhập địa chỉ nhận hàng.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bước 4 --}}
                        <div class="col-md-6">
                            <div class="guide-step-card">
                                <span class="step-number-bg">4</span>
                                <div class="d-flex align-items-start">
                                    <div class="step-badge">4</div>
                                    <div>
                                        <h5 class="step-title">Hoàn tất & Nhận hàng</h5>
                                        <p class="text-muted mb-0">
                                            Điền thông tin giao hàng, chọn phương thức thanh toán (COD/Chuyển khoản). Sau khi đặt hàng thành công, nhân viên sẽ gọi xác nhận.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Box Hỗ trợ --}}
                    <div class="support-box mt-5 d-flex align-items-center">
                        <i class="bi bi-headset fs-1 text-primary me-3"></i>
                        <div>
                            <h5 class="fw-bold mb-1">Bạn cần hỗ trợ thêm?</h5>
                            <p class="mb-0 text-muted">
                                Nếu gặp khó khăn trong quá trình đặt hàng, vui lòng liên hệ Hotline 
                                <strong class="text-danger fs-5">1900 1234</strong> (8h00 - 21h00) để được nhân viên tư vấn trực tiếp.
                            </p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-5">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm">
                            <i class="bi bi-cart4 me-2"></i> Bắt đầu mua sắm ngay
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
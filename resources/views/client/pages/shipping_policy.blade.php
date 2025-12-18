@extends('client.layout')
@section('title', 'Chính sách Vận chuyển & Giao nhận')

@section('css')
<style>
    /* === CSS RIÊNG CHO TRANG CHÍNH SÁCH VẬN CHUYỂN === */
    
    /* Card chính */
    .policy-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.05);
        overflow: hidden;
        background: #fff;
    }

    /* Tiêu đề trang */
    .page-title {
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Khung Ưu đãi */
    .promo-box {
        background: linear-gradient(135deg, #d1e7dd, #f8f9fa);
        border: 2px dashed #198754;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: transform 0.3s;
    }
    .promo-box:hover {
        transform: scale(1.02);
    }
    .promo-icon {
        width: 60px;
        height: 60px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #198754;
        box-shadow: 0 4px 10px rgba(25, 135, 84, 0.15);
    }

    /* Tiêu đề mục (H4) */
    .section-title {
        font-weight: 700;
        color: #212529;
        position: relative;
        padding-left: 15px;
        margin-bottom: 20px;
        text-transform: uppercase;
        font-size: 1.1rem;
    }
    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 4px;
        bottom: 4px;
        width: 4px;
        background: #0d6efd;
        border-radius: 2px;
    }

    /* Bảng giá vận chuyển */
    .shipping-table thead th {
        background-color: #0d6efd;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        border: none;
        padding: 15px;
    }
    .shipping-table tbody td {
        padding: 15px;
        vertical-align: middle;
        font-size: 0.95rem;
    }
    .shipping-table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    /* Mục Quy định */
    .rule-item {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 15px;
        display: flex;
        align-items: flex-start;
        transition: all 0.3s;
    }
    .rule-item:hover {
        border-color: #0d6efd;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .rule-icon {
        font-size: 1.5rem;
        margin-right: 15px;
        margin-top: -2px; /* Căn chỉnh với dòng đầu tiên */
    }

    /* Logo đối tác */
    .partner-logo {
        height: 40px;
        object-fit: contain;
        filter: grayscale(100%);
        opacity: 0.6;
        transition: all 0.3s;
    }
    .partner-logo:hover {
        filter: grayscale(0%);
        opacity: 1;
        transform: scale(1.1);
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Trang chủ</a></li>
            <li class="breadcrumb-item active fw-bold text-primary" aria-current="page">Vận chuyển & Giao nhận</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card policy-card">
                <div class="card-body p-4 p-md-5">
                    
                    {{-- Header trang --}}
                    <div class="text-center mb-5">
                        <div class="d-inline-block bg-light rounded-circle p-3 mb-3">
                            <i class="bi bi-truck text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h2 class="page-title mb-3">CHÍNH SÁCH VẬN CHUYỂN</h2>
                        <p class="text-muted">Cam kết giao hàng nhanh chóng, an toàn đến tận tay quý khách trên toàn quốc.</p>
                    </div>
                    
                    {{-- Box Ưu đãi --}}
                    <div class="promo-box mb-5">
                        <div class="promo-icon flex-shrink-0">
                            <i class="bi bi-gift-fill"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-success mb-1">ƯU ĐÃI ĐẶC BIỆT</h5>
                            <p class="mb-0 text-dark">
                                Miễn phí vận chuyển 100% cho đơn hàng có giá trị từ <strong>5.000.000đ</strong> trở lên.
                            </p>
                        </div>
                    </div>

                    {{-- 1. Phạm vi & Thời gian --}}
                    <div class="mb-5">
                        <h4 class="section-title">1. PHẠM VI & THỜI GIAN GIAO HÀNG</h4>
                        <div class="table-responsive rounded-3 overflow-hidden border">
                            <table class="table shipping-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;">Khu vực</th>
                                        <th style="width: 35%;">Thời gian dự kiến</th>
                                        <th style="width: 35%;">Phí vận chuyển (Đơn < 5tr)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong><i class="bi bi-geo-alt-fill text-danger me-2"></i>Nội thành Hà Nội</strong></td>
                                        <td>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success px-2 py-1">Siêu tốc</span> 
                                            Trong ngày hoặc 24h
                                        </td>
                                        <td class="fw-bold text-dark">30.000đ - 50.000đ <small class="fw-normal text-muted">(Grab/Ahamove)</small></td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-geo-alt-fill text-primary me-2"></i>Các tỉnh miền Bắc</strong></td>
                                        <td>2 - 3 ngày làm việc</td>
                                        <td class="fw-bold text-dark">35.000đ <small class="fw-normal text-muted">(Đồng giá)</small></td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-geo-alt-fill text-warning me-2"></i>Miền Trung & Miền Nam</strong></td>
                                        <td>3 - 5 ngày làm việc</td>
                                        <td class="fw-bold text-dark">40.000đ <small class="fw-normal text-muted">(Đồng giá)</small></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="text-muted small mt-2 fst-italic text-end">* Thời gian giao hàng không tính Chủ Nhật và ngày Lễ/Tết.</p>
                    </div>

                    {{-- 2. Quy định kiểm tra hàng --}}
                    <div class="mb-5">
                        <h4 class="section-title">2. QUY ĐỊNH KIỂM TRA HÀNG (ĐỒNG KIỂM)</h4>
                        
                        <div class="rule-item">
                            <i class="bi bi-box-seam text-success rule-icon"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Được phép xem hàng</h6>
                                <p class="mb-0 text-muted small">Quý khách được quyền mở hộp kiểm tra ngoại quan (trầy xước, bể vỡ, móp méo) và đối chiếu đúng model sản phẩm trước khi thanh toán cho nhân viên giao hàng.</p>
                            </div>
                        </div>

                        <div class="rule-item">
                            <i class="bi bi-slash-circle text-danger rule-icon"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Không hỗ trợ thử hàng</h6>
                                <p class="mb-0 text-muted small">Không hỗ trợ cắm điện, bật nguồn, dùng thử sản phẩm, lắp đặt hoặc xé seal (đối với hàng Apple, linh kiện nguyên seal) khi chưa thanh toán.</p>
                            </div>
                        </div>

                        <div class="rule-item" style="border-color: #ffc107; background-color: #fff9e6;">
                            <i class="bi bi-camera-video-fill text-warning rule-icon"></i>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Lưu ý quan trọng</h6>
                                <p class="mb-0 text-dark small">Quý khách vui lòng <strong>quay video clip</strong> toàn bộ quá trình mở hộp sản phẩm để làm bằng chứng đối chiếu bảo vệ quyền lợi nếu có khiếu nại về sau.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Đối tác vận chuyển --}}
                    <div class="bg-light p-4 rounded-3 text-center">
                        <h6 class="fw-bold text-uppercase text-muted mb-4 ls-1">Đối tác vận chuyển tin cậy</h6>
                        <div class="d-flex justify-content-center gap-4 gap-md-5 flex-wrap">
                            <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/05/Logo-GHTK-H.png" class="partner-logo" alt="GHTK">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/80/Viettel_Post_logo.svg/2560px-Viettel_Post_logo.svg.png" class="partner-logo" alt="Viettel Post">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/Grab_Logo.svg/1024px-Grab_Logo.svg.png" class="partner-logo" style="height: 30px; margin-top: 5px;" alt="Grab">
                            {{-- Bạn có thể thêm logo Ahamove, VNPost nếu muốn --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
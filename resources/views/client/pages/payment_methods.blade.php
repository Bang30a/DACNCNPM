@extends('client.layout')
@section('title', 'Phương thức thanh toán - GrabCatPC')

@section('css')
<style>
    /* === CSS RIÊNG CHO TRANG THANH TOÁN === */
    
    /* Tiêu đề gradient */
    .page-title {
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 800;
        letter-spacing: -1px;
    }

    /* Card phương thức thanh toán */
    .payment-card {
        border: 1px solid #f0f0f0;
        border-radius: 16px;
        transition: all 0.3s ease;
        background: #fff;
        height: 100%;
        overflow: hidden;
    }

    .payment-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(13, 110, 253, 0.1) !important;
        border-color: rgba(13, 110, 253, 0.3);
    }

    /* Icon tròn to (Chuẩn hóa kích thước) */
    .icon-box-lg {
        width: 80px;  /* Giảm xuống 80px cho vừa vặn */
        height: 80px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2.5rem; /* Giảm size icon */
        color: #0d6efd;
        transition: all 0.3s ease;
        border: 1px solid #eee;
    }

    /* Màu riêng cho icon QR */
    .icon-box-qr {
        background-color: #e8f5e9;
        color: #198754;
        border-color: #c3e6cb;
    }

    .payment-card:hover .icon-box-lg {
        background: #0d6efd;
        color: #fff;
        transform: scale(1.1) rotate(-5deg);
        box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3);
        border-color: transparent;
    }
    
    /* Hover riêng cho icon QR */
    .payment-card:hover .icon-box-qr {
        background: #198754;
        color: #fff;
        box-shadow: 0 10px 20px rgba(25, 135, 84, 0.3);
    }

    /* Card ngân hàng nhỏ */
    .bank-item {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 15px;
        transition: all 0.2s;
        background: #fff;
        margin-bottom: 15px;
    }
    .bank-item:last-child { margin-bottom: 0; }

    .bank-item:hover {
        border-color: #0d6efd;
        background-color: #f8f9fa;
    }

    .bank-logo {
        width: 50px;
        height: 50px;
        object-fit: contain;
        background: #fff;
        border-radius: 8px;
        padding: 2px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    /* Số tài khoản */
    .account-number {
        font-family: 'Consolas', 'Monaco', monospace;
        font-size: 1rem;
        letter-spacing: 0.5px;
        background: #eef2ff;
        padding: 4px 8px;
        border-radius: 4px;
        color: #0d6efd;
        font-weight: 700;
    }

    /* Nút copy */
    .btn-copy {
        cursor: pointer;
        color: #adb5bd;
        transition: 0.2s;
    }
    .btn-copy:hover {
        color: #0d6efd;
        transform: scale(1.1);
    }

    /* Badge phương thức (Ví điện tử) */
    .method-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        background: #fff;
        font-weight: 600;
        font-size: 0.9rem;
        color: #495057;
        transition: all 0.2s;
    }
    .method-badge:hover {
        border-color: #198754;
        color: #198754;
        background: #f0fff4;
        transform: translateY(-2px);
    }
    .method-badge img {
        height: 20px;
        width: auto;
    }

    /* Alert lưu ý */
    .alert-custom {
        border-left: 5px solid #ffc107;
        background-color: #fff3cd;
        color: #856404;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Trang chủ</a></li>
            <li class="breadcrumb-item active fw-bold text-primary" aria-current="page">Phương thức thanh toán</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            {{-- Header trang --}}
            <div class="text-center mb-5">
                <h1 class="page-title mb-3">HÌNH THỨC THANH TOÁN</h1>
                <p class="text-muted fs-5">GrabCatPC mang đến trải nghiệm thanh toán linh hoạt, an toàn và bảo mật tuyệt đối.</p>
            </div>

            <div class="row g-4">
                
                {{-- 1. Thanh toán tiền mặt (COD) --}}
                <div class="col-md-6">
                    <div class="card payment-card shadow-sm h-100">
                        <div class="card-body p-4 text-center d-flex flex-column">
                            <div class="icon-box-lg">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Thanh toán khi nhận hàng (COD)</h4>
                            <p class="text-muted mb-4 flex-grow-1 small">
                                Bạn chỉ phải thanh toán khi đã nhận được hàng và kiểm tra kỹ lưỡng. Áp dụng cho đơn hàng <strong>dưới 20 triệu đồng</strong>.
                            </p>
                            
                            <div class="alert alert-secondary border-0 bg-light small text-start rounded-3 m-0">
                                <i class="bi bi-shield-check text-success me-2"></i>
                                <strong>Lưu ý:</strong> Vui lòng giữ lại biên lai vận chuyển để đối chiếu.
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. Chuyển khoản ngân hàng --}}
                <div class="col-md-6">
                    <div class="card payment-card shadow-sm border-primary h-100" style="border-width: 2px;">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="icon-box-lg">
                                    <i class="bi bi-bank2"></i>
                                </div>
                                <h4 class="fw-bold">Chuyển khoản ngân hàng</h4>
                                <p class="text-muted small m-0">Khuyên dùng để xử lý nhanh nhất (24/7)</p>
                            </div>

                            {{-- Ngân hàng 1 --}}
                            <div class="bank-item">
                                <div class="d-flex align-items-center">
                                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-Vietcombank.png" alt="VCB" class="bank-logo me-3">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fw-bold mb-1 text-truncate">Vietcombank</h6>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="account-number">0011 2233 4455</span>
                                            <i class="bi bi-copy btn-copy" onclick="copyToClipboard('001122334455')" title="Sao chép"></i>
                                        </div>
                                        <small class="text-muted d-block text-truncate">Chủ TK: PHAN TU TRUONG</small>
                                    </div>
                                </div>
                            </div>

                            {{-- Ngân hàng 2 --}}
                            <div class="bank-item">
                                <div class="d-flex align-items-center">
                                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-MB-Bank-MBB.png" alt="MB" class="bank-logo me-3">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fw-bold mb-1 text-truncate">MB Bank</h6>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="account-number">9999 8888 7777</span>
                                            <i class="bi bi-copy btn-copy" onclick="copyToClipboard('999988887777')" title="Sao chép"></i>
                                        </div>
                                        <small class="text-muted d-block text-truncate">Chủ TK: PHAN TU TRUONG</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 3. Quét mã QR / Ví điện tử (ĐÃ SỬA LẠI ĐẸP HƠN) --}}
                <div class="col-12">
                    <div class="card payment-card shadow-sm">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center mb-3 mb-md-0">
                                    {{-- Icon QR đã được thu nhỏ và chỉnh lại màu --}}
                                    <div class="icon-box-lg icon-box-qr m-auto">
                                        <i class="bi bi-qr-code-scan"></i>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h4 class="fw-bold mb-2">Thanh toán qua Ví điện tử / QR Code</h4>
                                    <p class="text-muted small mb-4">
                                        Quét mã QR để thanh toán siêu tốc, không cần nhập tay số tài khoản, tránh sai sót. Hỗ trợ hầu hết các ứng dụng ngân hàng.
                                    </p>
                                    
                                    {{-- Các badge ví điện tử --}}
                                    <div class="d-flex gap-3 flex-wrap">
                                        <span class="method-badge">
                                            <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-VNPAY-QR-1.png" alt="VNPAY"> 
                                            VNPAY-QR
                                        </span>
                                        <span class="method-badge">
                                            <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-MoMo-Circle.png" alt="Momo"> 
                                            Momo
                                        </span>
                                        <span class="method-badge">
                                            <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-ZaloPay-Square.png" alt="ZaloPay"> 
                                            ZaloPay
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Phần Lưu ý --}}
            <div class="alert alert-custom mt-5 rounded-4 shadow-sm" role="alert">
                <div class="d-flex align-items-start">
                    <div class="me-3 mt-1">
                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">Lưu ý quan trọng khi chuyển khoản:</h5>
                        <ul class="mb-0 ps-3 small">
                            <li class="mb-1">Nội dung chuyển khoản vui lòng ghi rõ: <span class="badge bg-warning text-dark font-monospace">TÊN + SĐT</span> (Ví dụ: NguyenVanA 0912345678).</li>
                            <li>Sau khi chuyển khoản, hệ thống sẽ xác nhận trong vòng <strong>5-15 phút</strong>. Nếu quá thời gian, vui lòng gọi Hotline: <strong class="text-danger">1900 1234</strong>.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function copyToClipboard(text) {
        if (!navigator.clipboard) {
            var textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("Copy");
            textArea.remove();
            alert('Đã sao chép: ' + text);
            return;
        }
        navigator.clipboard.writeText(text).then(function() {
            alert('Đã sao chép số tài khoản: ' + text);
        }, function(err) {
            console.error('Lỗi sao chép: ', err);
        });
    }
</script>
@endsection
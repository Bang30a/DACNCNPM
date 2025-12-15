@extends('client.layout')
@section('title', 'Phương thức thanh toán')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Phương thức thanh toán</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">CÁC HÌNH THỨC THANH TOÁN</h2>
                <p class="text-muted">Computer Shop hỗ trợ đa dạng các phương thức thanh toán để thuận tiện nhất cho quý khách.</p>
            </div>

            <div class="row g-4">
                {{-- 1. Thanh toán tiền mặt (COD) --}}
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <div class="mb-3 text-primary">
                                <i class="bi bi-cash-coin" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="fw-bold mb-3">1. Thanh toán tiền mặt (COD)</h5>
                            <p class="text-muted mb-4">
                                Áp dụng cho đơn hàng dưới 20 triệu đồng. Quý khách thanh toán trực tiếp cho nhân viên giao hàng ngay khi nhận và kiểm tra sản phẩm.
                            </p>
                            <div class="alert alert-light border small text-start">
                                <i class="bi bi-info-circle me-1"></i> Quý khách vui lòng kiểm tra kỹ hàng hóa trước khi thanh toán.
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. Chuyển khoản ngân hàng --}}
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm border-top border-4 border-primary">
                        <div class="card-body p-4">
                            <div class="text-center mb-3 text-primary">
                                <i class="bi bi-bank" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="fw-bold text-center mb-3">2. Chuyển khoản ngân hàng</h5>
                            <p class="text-muted text-center mb-4">Khuyên dùng để giao dịch nhanh chóng và an toàn hơn.</p>

                            <div class="bg-light p-3 rounded mb-3">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-Vietcombank.png" alt="VCB" width="50" class="me-3">
                                    <div>
                                        <h6 class="fw-bold m-0">Ngân hàng Vietcombank</h6>
                                        <span class="small text-muted">Chi nhánh Hà Nội</span>
                                    </div>
                                </div>
                                <ul class="list-unstyled mb-0 small">
                                    <li class="mb-1"><strong>Số tài khoản:</strong> <span class="text-primary fs-6">0011 2233 4455</span> <button class="btn btn-sm btn-link p-0 ms-2" onclick="copyToClipboard('001122334455')"><i class="bi bi-clipboard"></i></button></li>
                                    <li><strong>Chủ tài khoản:</strong> PHAN TU TRUONG</li>
                                </ul>
                            </div>

                            <div class="bg-light p-3 rounded">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-MB-Bank-MBB.png" alt="MB" width="50" class="me-3">
                                    <div>
                                        <h6 class="fw-bold m-0">Ngân hàng MB Bank</h6>
                                        <span class="small text-muted">Chi nhánh Cầu Giấy</span>
                                    </div>
                                </div>
                                <ul class="list-unstyled mb-0 small">
                                    <li class="mb-1"><strong>Số tài khoản:</strong> <span class="text-primary fs-6">0386248487</span> <button class="btn btn-sm btn-link p-0 ms-2" onclick="copyToClipboard('999988887777')"><i class="bi bi-clipboard"></i></button></li>
                                    <li><strong>Chủ tài khoản:</strong> PHAN TU TRUONG</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 3. Quét mã QR / Ví điện tử --}}
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 d-flex flex-column flex-md-row align-items-center">
                            <div class="flex-shrink-0 text-center mb-3 mb-md-0 me-md-4">
                                <i class="bi bi-qr-code-scan text-success" style="font-size: 4rem;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">3. Quét mã QR VNPAY / Momo</h5>
                                <p class="text-muted mb-2">Hỗ trợ thanh toán qua mã QR Code từ ứng dụng ngân hàng hoặc ví điện tử. Nhanh chóng, tiện lợi, không cần nhập số tài khoản thủ công.</p>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-light text-dark border"><img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-VNPAY-QR.png" height="15" class="me-1"> VNPAY-QR</span>
                                    <span class="badge bg-light text-dark border"><img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" height="15" class="me-1"> Momo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning mt-5" role="alert">
                <h6 class="fw-bold"><i class="bi bi-exclamation-triangle-fill me-2"></i>Lưu ý khi chuyển khoản:</h6>
                <ul class="mb-0 ps-3">
                    <li>Nội dung chuyển khoản vui lòng ghi rõ: <strong>[Tên Khách Hàng] + [Số Điện Thoại]</strong> (hoặc Mã Đơn Hàng nếu có).</li>
                    <li>Sau khi chuyển khoản, vui lòng chụp lại biên lai và gửi cho nhân viên tư vấn hoặc chờ xác nhận từ hệ thống (trong vòng 5-15 phút).</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Đã sao chép số tài khoản: ' + text);
        }, function(err) {
            console.error('Không thể sao chép: ', err);
        });
    }
</script>
@endsection
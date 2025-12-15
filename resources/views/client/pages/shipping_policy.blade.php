@extends('client.layout')
@section('title', 'Chính sách Vận chuyển & Giao nhận')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vận chuyển & Giao nhận</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <h2 class="fw-bold text-primary mb-4 text-center"><i class="bi bi-truck me-2"></i>CHÍNH SÁCH VẬN CHUYỂN</h2>
                    
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-gift-fill fs-4 me-3"></i>
                        <div>
                            <strong>ƯU ĐÃI ĐẶC BIỆT:</strong> Miễn phí vận chuyển toàn quốc cho đơn hàng từ <strong>5.000.000đ</strong> trở lên.
                        </div>
                    </div>

                    <div class="mt-5">
                        <h4 class="fw-bold text-dark border-bottom pb-2 mb-3">1. PHẠM VI & THỜI GIAN GIAO HÀNG</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover border">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Khu vực</th>
                                        <th>Thời gian dự kiến</th>
                                        <th>Phí vận chuyển (Đơn < 5tr)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Nội thành Hà Nội</strong></td>
                                        <td>Giao trong ngày hoặc 24h</td>
                                        <td>30.000đ - 50.000đ (Grab/Ahamove)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Các tỉnh miền Bắc</strong></td>
                                        <td>2 - 3 ngày làm việc</td>
                                        <td>35.000đ (Đồng giá)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Miền Trung & Miền Nam</strong></td>
                                        <td>3 - 5 ngày làm việc</td>
                                        <td>40.000đ (Đồng giá)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="text-muted small fst-italic">* Thời gian giao hàng không tính Chủ Nhật và ngày Lễ/Tết.</p>
                    </div>

                    <div class="mt-5">
                        <h4 class="fw-bold text-dark border-bottom pb-2 mb-3">2. QUY ĐỊNH KIỂM TRA HÀNG (ĐỒNG KIỂM)</h4>
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-check-circle-fill text-success fs-5 me-3 mt-1"></i>
                            <p><strong>Cho phép xem hàng:</strong> Khách hàng được quyền mở hộp kiểm tra ngoại quan (trầy xước, bể vỡ) và đúng model sản phẩm trước khi thanh toán cho Shipper.</p>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-x-circle-fill text-danger fs-5 me-3 mt-1"></i>
                            <p><strong>Không thử hàng:</strong> Không hỗ trợ cắm điện, bật nguồn, dùng thử sản phẩm hoặc xé seal (đối với hàng Apple, linh kiện nguyên seal) khi chưa thanh toán.</p>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="bi bi-camera-video-fill text-primary fs-5 me-3 mt-1"></i>
                            <p><strong>Lưu ý quan trọng:</strong> Quý khách vui lòng quay video clip khi mở hộp sản phẩm để làm bằng chứng đối chiếu nếu có khiếu nại về sau.</p>
                        </div>
                    </div>

                    <div class="mt-5 bg-light p-4 rounded">
                        <h5 class="fw-bold mb-3">ĐỐI TÁC VẬN CHUYỂN</h5>
                        <div class="d-flex gap-4 flex-wrap align-items-center opacity-75">
                            <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/05/Logo-GHTK-H.png" height="40" alt="GHTK">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/80/Viettel_Post_logo.svg/2560px-Viettel_Post_logo.svg.png" height="40" alt="Viettel Post">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/Grab_Logo.svg/1024px-Grab_Logo.svg.png" height="30" alt="Grab">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
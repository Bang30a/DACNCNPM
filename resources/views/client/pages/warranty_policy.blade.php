@extends('client.layout')
@section('title', 'Chính sách bảo hành & Đổi trả')

@section('css')
<style>
    /* === CSS RIÊNG CHO TRANG BẢO HÀNH === */

    /* Tiêu đề trang */
    .page-title {
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Menu bên trái */
    .policy-menu .list-group-item {
        border: none;
        border-left: 4px solid transparent;
        color: #495057;
        font-weight: 600;
        transition: all 0.2s;
        padding: 15px 20px;
    }

    .policy-menu .list-group-item:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }

    .policy-menu .list-group-item.active {
        background-color: #e7f1ff;
        color: #0d6efd;
        border-color: #0d6efd;
        border-left-width: 4px;
    }

    /* Card nội dung */
    .policy-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        background: #fff;
        margin-bottom: 30px;
        scroll-margin-top: 100px; /* Để khi scroll không bị header che */
    }

    .card-header-custom {
        background-color: #fff;
        border-bottom: 1px solid #f0f0f0;
        padding: 20px 25px;
    }

    .card-title-custom {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0d6efd;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .icon-wrapper {
        width: 40px;
        height: 40px;
        background-color: #e7f1ff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: #0d6efd;
        font-size: 1.2rem;
    }

    /* Danh sách điều kiện */
    .condition-list li {
        position: relative;
        padding-left: 30px;
        margin-bottom: 12px;
        color: #495057;
    }

    .condition-list li i {
        position: absolute;
        left: 0;
        top: 2px;
        color: #198754; /* Màu xanh lá */
    }

    /* Bảng đổi trả */
    .table-policy thead th {
        background-color: #0d6efd;
        color: #fff;
        text-transform: uppercase;
        font-size: 0.9rem;
        padding: 15px;
        border: none;
    }

    .table-policy tbody td {
        padding: 15px;
        vertical-align: middle;
        color: #495057;
    }

    /* Card địa chỉ */
    .address-card {
        background: linear-gradient(135deg, #f8f9fa, #fff);
        border: 2px dashed #0d6efd;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Trang chủ</a></li>
            <li class="breadcrumb-item active fw-bold text-primary" aria-current="page">Chính sách bảo hành</li>
        </ol>
    </nav>

    <div class="row">
        {{-- Menu bên trái --}}
        <div class="col-lg-3 d-none d-lg-block">
            <div class="list-group policy-menu shadow-sm sticky-top rounded-3 overflow-hidden" style="top: 100px; z-index: 1;">
                <div class="bg-primary text-white p-3 fw-bold text-center text-uppercase">
                    Danh mục chính sách
                </div>
                <a href="#bao-hanh" class="list-group-item list-group-item-action active">
                    <i class="bi bi-shield-check me-2"></i> Chính sách bảo hành
                </a>
                <a href="#doi-tra" class="list-group-item list-group-item-action">
                    <i class="bi bi-arrow-repeat me-2"></i> Chính sách đổi trả
                </a>
                <a href="#trung-tam" class="list-group-item list-group-item-action">
                    <i class="bi bi-geo-alt-fill me-2"></i> Địa chỉ gửi hàng
                </a>
            </div>
        </div>

        {{-- Nội dung chính --}}
        <div class="col-lg-9">
            
            {{-- Header Mobile (Chỉ hiện khi ẩn menu trái) --}}
            <div class="text-center mb-4 d-lg-none">
                <h2 class="page-title">CHÍNH SÁCH BẢO HÀNH</h2>
            </div>

            {{-- 1. CHÍNH SÁCH BẢO HÀNH --}}
            <div class="card policy-card" id="bao-hanh">
                <div class="card-header-custom">
                    <h3 class="card-title-custom">
                        <div class="icon-wrapper"><i class="bi bi-shield-check"></i></div>
                        1. CHÍNH SÁCH BẢO HÀNH
                    </h3>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        GrabCatPC cam kết mang đến dịch vụ bảo hành tốt nhất. Tất cả sản phẩm chính hãng bán ra đều được hưởng chế độ bảo hành miễn phí theo quy định của nhà sản xuất.
                    </p>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded-3 h-100 border">
                                <h6 class="fw-bold text-dark mb-3">Điều kiện nhận bảo hành:</h6>
                                <ul class="list-unstyled condition-list mb-0">
                                    <li><i class="bi bi-check-circle-fill"></i> Sản phẩm còn trong thời hạn bảo hành.</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Tem bảo hành/Tem niêm phong còn nguyên vẹn.</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Số Serial/IMEI trên sản phẩm rõ nét, trùng khớp.</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Không có dấu hiệu cạy mở, sửa chữa bên ngoài.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded-3 h-100 border">
                                <h6 class="fw-bold text-dark mb-3">Trường hợp TỪ CHỐI bảo hành:</h6>
                                <ul class="list-unstyled condition-list mb-0">
                                    <li><i class="bi bi-x-circle-fill text-danger"></i> Sản phẩm bị tác động vật lý (rơi vỡ, móp méo).</li>
                                    <li><i class="bi bi-x-circle-fill text-danger"></i> Hư hỏng do chất lỏng, côn trùng xâm nhập.</li>
                                    <li><i class="bi bi-x-circle-fill text-danger"></i> Sử dụng sai điện áp quy định, cháy nổ.</li>
                                    <li><i class="bi bi-x-circle-fill text-danger"></i> Hết thời hạn bảo hành ghi trên tem/phiếu.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4 d-flex align-items-center mb-0" role="alert">
                        <i class="bi bi-clock-history fs-4 me-3"></i>
                        <div>
                            <strong>Thời gian xử lý:</strong> Từ <strong>3 - 7 ngày làm việc</strong> (không tính Chủ Nhật và ngày lễ) tùy thuộc vào mức độ hư hỏng của sản phẩm.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. CHÍNH SÁCH ĐỔI TRẢ --}}
            <div class="card policy-card" id="doi-tra">
                <div class="card-header-custom">
                    <h3 class="card-title-custom">
                        <div class="icon-wrapper"><i class="bi bi-arrow-repeat"></i></div>
                        2. CHÍNH SÁCH ĐỔI TRẢ (1 ĐỔI 1)
                    </h3>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-3">Áp dụng cho tất cả các sản phẩm Laptop, PC, Linh kiện máy tính mua tại GrabCatPC.</p>

                    <div class="table-responsive rounded-3 overflow-hidden border mb-3">
                        <table class="table table-policy mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 25%;">Thời gian</th>
                                    <th style="width: 40%;">Điều kiện</th>
                                    <th style="width: 35%;">Chính sách</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-center bg-light text-primary">30 Ngày đầu</td>
                                    <td>Sản phẩm bị lỗi phần cứng do nhà sản xuất (Màn hình, Main, RAM...)</td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success p-2">
                                            <i class="bi bi-check-lg me-1"></i> Đổi mới 100%
                                        </span>
                                        <div class="small text-muted mt-1">(Đổi sản phẩm cùng model)</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-center bg-light">Sau 30 ngày</td>
                                    <td>Sản phẩm bị lỗi kỹ thuật trong quá trình sử dụng.</td>
                                    <td>Bảo hành sửa chữa hoặc thay thế linh kiện chính hãng miễn phí.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="small text-danger fst-italic mb-0">
                        * Lưu ý: Sản phẩm đổi trả phải còn nguyên hộp, đầy đủ phụ kiện, quà tặng đi kèm và không bị trầy xước.
                    </p>
                </div>
            </div>

            {{-- 3. ĐỊA CHỈ TRUNG TÂM --}}
            <div class="card policy-card address-card" id="trung-tam">
                <div class="card-body p-4 p-lg-5 text-center">
                    <h4 class="fw-bold text-primary mb-4 text-uppercase">Địa chỉ Trung tâm Bảo hành</h4>
                    
                    <div class="row justify-content-center g-4">
                        <div class="col-md-4">
                            <div class="mb-2 text-primary"><i class="bi bi-geo-alt-fill fs-2"></i></div>
                            <h6 class="fw-bold">Địa chỉ nhận hàng</h6>
                            <p class="text-muted small">123 Đường ABC, Quận Cầu Giấy, Hà Nội</p>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2 text-danger"><i class="bi bi-telephone-fill fs-2"></i></div>
                            <h6 class="fw-bold">Hotline Kỹ thuật</h6>
                            <p class="text-muted small">1900 1234 (Nhánh 2)<br>Hỗ trợ 24/7</p>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2 text-success"><i class="bi bi-clock-fill fs-2"></i></div>
                            <h6 class="fw-bold">Giờ làm việc</h6>
                            <p class="text-muted small">8:00 - 17:30<br>(Thứ 2 - Thứ 7)</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Script để scroll mượt khi bấm menu bên trái --}}
<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            // Xóa active cũ
            document.querySelectorAll('.policy-menu .list-group-item').forEach(item => {
                item.classList.remove('active');
            });
            // Thêm active mới
            this.classList.add('active');

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
@endsection
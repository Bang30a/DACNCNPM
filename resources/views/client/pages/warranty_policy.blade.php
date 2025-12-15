@extends('client.layout')
@section('title', 'Chính sách bảo hành & Đổi trả')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chính sách bảo hành & Đổi trả</li>
        </ol>
    </nav>

    <div class="row">
        {{-- Menu bên trái (Tùy chọn, để điều hướng nhanh) --}}
        <div class="col-lg-3 d-none d-lg-block">
            <div class="list-group shadow-sm sticky-top" style="top: 100px; z-index: 1;">
                <a href="#bao-hanh" class="list-group-item list-group-item-action active fw-bold">Chính sách bảo hành</a>
                <a href="#doi-tra" class="list-group-item list-group-item-action fw-bold">Chính sách đổi trả</a>
                <a href="#trung-tam" class="list-group-item list-group-item-action fw-bold">Địa chỉ gửi hàng</a>
            </div>
        </div>

        {{-- Nội dung chính --}}
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm mb-4" id="bao-hanh">
                <div class="card-body p-4">
                    <h3 class="text-primary fw-bold mb-3"><i class="bi bi-shield-check me-2"></i>1. CHÍNH SÁCH BẢO HÀNH</h3>
                    <p>Computer Shop cam kết bảo hành miễn phí cho tất cả các sản phẩm gặp lỗi kỹ thuật từ nhà sản xuất trong thời gian quy định.</p>
                    
                    <h5 class="fw-bold mt-4">Điều kiện nhận bảo hành:</h5>
                    <ul class="list-unstyled ps-3">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Sản phẩm còn trong thời hạn bảo hành.</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Tem bảo hành còn nguyên vẹn, không bị rách hay tẩy xóa.</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Sản phẩm không bị tác động vật lý (rơi vỡ, móp méo) hoặc do chất lỏng xâm nhập.</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Có hóa đơn mua hàng hoặc thông tin đơn hàng trên hệ thống.</li>
                    </ul>

                    <h5 class="fw-bold mt-4">Thời gian xử lý:</h5>
                    <p>Từ <strong>3 - 7 ngày làm việc</strong> (không tính Chủ Nhật và ngày lễ) tùy thuộc vào lỗi của sản phẩm.</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4" id="doi-tra">
                <div class="card-body p-4">
                    <h3 class="text-primary fw-bold mb-3"><i class="bi bi-arrow-repeat me-2"></i>2. CHÍNH SÁCH ĐỔI TRẢ (1 ĐỔI 1)</h3>
                    <p>Áp dụng cho tất cả các sản phẩm Laptop, PC, Linh kiện máy tính.</p>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Điều kiện</th>
                                    <th scope="col">Chính sách</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-center align-middle">30 Ngày đầu</td>
                                    <td>Sản phẩm bị lỗi phần cứng do nhà sản xuất.</td>
                                    <td class="text-success fw-bold">Đổi mới 100% (cùng model)</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-center align-middle">Sau 30 ngày</td>
                                    <td>Sản phẩm bị lỗi kỹ thuật.</td>
                                    <td>Nhận bảo hành sửa chữa/thay thế linh kiện theo hãng.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="fst-italic text-muted mt-2">* Lưu ý: Sản phẩm đổi trả phải còn nguyên hộp, đầy đủ phụ kiện đi kèm.</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm bg-light" id="trung-tam">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-3">ĐỊA CHỈ TRUNG TÂM BẢO HÀNH</h4>
                    <p class="mb-2"><i class="bi bi-geo-alt-fill text-danger me-2"></i><strong>Địa chỉ:</strong> 123 Đường ABC, Quận Cầu Giấy, Hà Nội</p>
                    <p class="mb-2"><i class="bi bi-telephone-fill text-danger me-2"></i><strong>Hotline Kỹ Thuật:</strong> 1900 1234 (Nhánh 2)</p>
                    <p class="mb-0"><i class="bi bi-clock-fill text-danger me-2"></i><strong>Giờ làm việc:</strong> 8:00 - 17:30 (Thứ 2 - Thứ 7)</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
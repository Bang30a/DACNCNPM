<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Computer Shop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    {{-- === (THÊM MỚI) LINK FONT AWESOME ĐỂ HIỂN THỊ ICON === --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @yield('css')
</head>
<body>
<!-- ... (Phần Navbar giữ nguyên) ... -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">COMPUTER SHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('client.shop') ? 'active' : '' }}" href="{{ route('client.shop') }}">Cửa hàng</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Danh mục</a>

                        {{-- === (ĐÃ SỬA LẠI TOÀN BỘ ID BỊ "LỆCH" THEO 'image_31acc4.png') === --}}
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.shop', ['category' => 2]) }}">
                                    <i class="fas fa-laptop me-2"></i> Latop Văn Phòng
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.shop', ['category' => 3]) }}">
                                    <i class="fas fa-gamepad me-2"></i> Latop Game & Đồ họa
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.shop', ['category' => 5]) }}">
                                    <i class="fab fa-apple me-2"></i> Sản phẩm Apple
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.shop', ['category' => 6]) }}">
                                    <i class="fas fa-tablet-alt me-2"></i> Máy tính bảng
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.shop', ['category' => 7]) }}">
                                    <i class="fas fa-desktop me-2"></i> PC Đồng bộ
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.shop', ['category' => 8]) }}">
                                    <i class="fas fa-microchip me-2"></i> Linh kiện máy tính
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.shop', ['category' => 9]) }}">
                                    <i class="fas fa-tv me-2"></i> Màn hình máy tính
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.shop', ['category' => 10]) }}">
                                    <i class="fas fa-headset me-2"></i> Gaming Gear
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.shop', ['category' => 11]) }}">
                                    <i class="fas fa-print me-2"></i> Thiết bị văn phòng
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.shop', ['category' => 12]) }}">
                                    <i class="fas fa-hdd me-2"></i> Thiết bị lưu trữ
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.shop', ['category' => 13]) }}">
                                    <i class="fas fa-network-wired me-2"></i> Thiết bị mạng
                                </a>
                            </li>
                        </ul>

                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-primary me-2 position-relative">
                        <i class="bi bi-cart-fill"></i> Giỏ hàng
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count((array) session('cart')) }}
                        </span>
                    </a>
                    <div class="d-flex align-items-center ms-3">
    @auth
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="mdo" width="32" height="32" class="rounded-circle me-2">
                <strong>{{ Auth::user()->name }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser1">
                @if(Auth::user()->role == 1)
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Trang quản trị</a></li>
                    <li><hr class="dropdown-divider"></li>
                @endif
                <li>
                    <a class="dropdown-item" href="{{ route('client.orders.index') }}">Đơn hàng của tôi</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('client.account.index') }}">Tài khoản</a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                    </form>
                </li>
            </ul>
        </div>
    @else
        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Đăng nhập</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Đăng ký</a>
    @endauth
</div>
                </div>
            </div>
        </div>
    </nav>

    <main class="container" style="margin-top: 80px; min-height: 600px;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- === (FOOTER MỚI ĐÃ "BIẾN TẤU") === --}}
    <footer class="footer-custom py-5 mt-5">
        <div class="container">
            <!-- (BIẾN TẤU) Thêm Brand/Tagline -->
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="fw-bold text-primary">COMPUTER SHOP</h4>
                    <p class="text-muted" style="color: #adb5bd !important;">Giải pháp công nghệ toàn diện cho bạn.</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Cột 1: Cơ sở 1 (VD: Đống Đa) -->
                <div class="col-lg-3 col-md-6">
                    <h5>CƠ SỞ 1 - ĐỐNG ĐA, HÀ NỘI</h5>
                    <ul class="footer-links">
                        <li><i class="bi bi-geo-alt-fill me-2"></i> Số 117 Thái Hà - P. Trung Liệt</li>
                        <li><i class="bi bi-person-fill me-2"></i> Kinh doanh: Mr. A (09...1)</li>
                        <li><i class="bi bi-person-fill me-2"></i> Kinh doanh: Mr. B (09...2)</li>
                        <li><i class="bi bi-headset me-2"></i> Bảo hành: Mr. C (09...3)</li>
                        <li><i class="bi bi-envelope-fill me-2"></i> Email: email1@shop.com</li>
                        <li><i class="bi bi-clock-fill me-2"></i> Giờ mở cửa: 08:30 - 20:30</li>
                    </ul>
                </div>

                <!-- Cột 2: Cơ sở 2 (VD: Cầu Giấy) -->
                <div class="col-lg-3 col-md-6">
                    <h5>CƠ SỞ 2 - CẦU GIẤY, HÀ NỘI</h5>
                    <ul class="footer-links">
                        <li><i class="bi bi-geo-alt-fill me-2"></i> Số 24 Trần Thái Tông - P. Dịch Vọng</li>
                        <li><i class="bi bi-person-fill me-2"></i> Kinh doanh: Mr. D (09...4)</li>
                        <li><i class="bi bi-person-fill me-2"></i> Kinh doanh: Mr. E (09...5)</li>
                        <li><i class="bi bi-headset me-2"></i> Bảo hành: Mr. F (09...6)</li>
                        <li><i class="bi bi-envelope-fill me-2"></i> Email: email2@shop.com</li>
                        <li><i class="bi bi-clock-fill me-2"></i> Giờ mở cửa: 08:30 - 20:30</li>
                    </ul>
                </div>

                <!-- Cột 3: Cơ sở 3 (VD: HCM) -->
                <div class="col-lg-3 col-md-6">
                    <h5>CƠ SỞ 3 - P. BẾN CÓ, HCM</h5>
                    <ul class="footer-links">
                        <li><i class="bi bi-geo-alt-fill me-2"></i> 26/9 Đường số 3, Khu Cư Xá</li>
                        <li><i class="bi bi-person-fill me-2"></i> Kinh doanh: Mr. G (09...7)</li>
                        <li><i class="bi bi-person-fill me-2"></i> Kinh doanh: Mr. H (09...8)</li>
                        <li><i class="bi bi-headset me-2"></i> Bảo hành: Mr. I (09...9)</li>
                        <li><i class="bi bi-envelope-fill me-2"></i> Email: email3@shop.com</li>
                        <li><i class="bi bi-clock-fill me-2"></i> Giờ mở cửa: 08:30 - 20:30</li>
                    </ul>
                </div>

                <!-- Cột 4: Kinh doanh & Liên kết -->
                <div class="col-lg-3 col-md-6">
                    <h5>KINH DOANH DỰ ÁN</h5>
                    <ul class="footer-links">
                        <li><i class="bi bi-person-workspace me-2"></i> Mr. Project (09...0)</li>
                        <li><i class="bi bi-envelope-fill me-2"></i> duan@shop.com</li>
                    </ul>
                    <h5 class="mt-4">LIÊN KẾT MẠNG XÃ HỘI</h5>
                    <div class="d-flex fs-2">
                        <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>

            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center">
                <p class="mb-1">Bản quyền thuộc về Công ty TNHH Computer Shop. GPKD số 010... do Sở Kế hoạch và Đầu tư TP Hà Nội cấp.</p>
                <p class="mb-0">&copy; {{ date('Y') }} Computer Shop. Đồ án môn học.</p>
            </div>
        </div>
    </footer>
    <div class="footer-bottom text-light">
        <div class="container text-center">
            <div class="hot-tags">
                <strong>Hot tags: </strong>
                <a href="#">Laptop top mỏng nhẹ</a>
                <a href="#">Laptop 2 trong 1</a>
                <a href="#">Laptop xoay gập</a>
                <a href="#">Laptop Cảm ứng</a>
                <a href="#">Linh kiện máy tính</a>
                <a href="#">Apple Watch</a>
                <a href="#">MacBook</a>
                <a href="#">iPhone</a>
                <a href="#">Thiết kế đồ họa</a>
                <a href="#">Phụ kiện</a>
                <a href="#">Cấu hình khủng</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>
</html>
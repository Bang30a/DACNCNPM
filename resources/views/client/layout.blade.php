<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>@yield('title', 'GrabCatPC')</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    {{-- Thư viện bên ngoài --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @yield('css')
    @vite(['resources/css/index.css', 'resources/js/app.js'])
</head>
<body>

    {{-- === BANNER QUẢNG CÁO TRÁI === --}}
    <div class="banner-ad-float banner-left">
        <a href="{{ route('client.sale') }}" title="Săn Sale">
            <img src="https://i.pinimg.com/736x/20/e1/5f/20e15fd1fd85c4fb8656e56162a0f748.jpg" 
                 alt="Banner Trái"
                 onerror="this.src='https://via.placeholder.com/160x450/dc3545/FFFFFF?text=SALE+SOC';">
        </a>
    </div>

    {{-- === BANNER QUẢNG CÁO PHẢI === --}}
    <div class="banner-ad-float banner-right">
        <a href="{{ route('client.shop', ['category' => 3]) }}" title="Laptop Gaming">
            <img src="https://i.pinimg.com/736x/7a/cb/1e/7acb1e5a3b0d6e0d7cc6d07840cc5c05.jpg" 
                 alt="Banner Phải"
                 onerror="this.src='https://via.placeholder.com/160x450/000000/FFFFFF?text=GAMING+PC';">
        </a>
    </div>

    {{-- === HEADER MỚI (2 TẦNG - GIAO DIỆN HIỆN ĐẠI) === --}}
    <header class="header-wrapper fixed-top shadow-sm">
        
        {{-- TẦNG 1: TOP BAR --}}
        <div class="top-header bg-white py-2 border-bottom">
            <div class="container d-flex align-items-center justify-content-between gap-3">
                
                {{-- Logo --}}
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                    {{-- Cách 1: Chỉ dùng ảnh logo --}}
                    <img src="{{ asset('images/logo.png') }}" alt="GrabCatPC Logo" style="height: 50px; width: auto; object-fit: contain;">            
                <span class="fw-bold text-primary ms-2 fs-3">GrabCatPC</span>
                </a>

                {{-- Ô Tìm Kiếm (Bo tròn hiện đại) --}}
                <div class="search-bar-container flex-grow-1 mx-lg-5 mx-3 d-none d-lg-block">
                    <form action="{{ route('client.shop') }}" method="GET">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden">
                            <input type="text" class="form-control border-0 bg-light px-4 py-2" placeholder="Bạn cần tìm gì hôm nay?" name="search">
                            <button class="btn btn-primary px-4 fw-bold border-0" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Khu vực chức năng --}}
                <div class="header-actions d-flex align-items-center gap-3 gap-xl-4">
                    {{-- Hotline --}}
                    <div class="d-none d-xl-flex align-items-center gap-2 text-dark text-decoration-none">
                        <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-2 text-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-headset fs-5"></i>
                        </div>
                        <div class="d-flex flex-column lh-1">
                            <span class="small text-muted" style="font-size: 0.8rem;">Hotline 24/7</span>
                            <span class="fw-bold">1900.1234</span>
                        </div>
                    </div>

                    {{-- Giỏ hàng --}}
                    <a href="{{ route('cart.index') }}" class="text-dark text-decoration-none border-0 p-0">
                        <div class="d-flex align-items-center gap-2">
                            <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-2 text-primary position-relative d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-cart3 fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light shadow-sm">
                                    {{ count((array) session('cart')) }}
                                </span>
                            </div>
                            <div class="d-none d-md-block d-flex flex-column lh-1 text-start">
                                <span class="small text-muted" style="font-size: 0.8rem;">Giỏ hàng</span>
                                <span class="fw-bold">Của bạn</span>
                            </div>
                        </div>
                    </a>

                    {{-- Tài khoản --}}
                    @auth
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none text-dark gap-2" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="User" width="40" height="40" class="rounded-circle border shadow-sm">
                                <div class="d-none d-md-flex flex-column lh-1">
                                    <span class="small text-muted" style="font-size: 0.8rem;">Xin chào,</span>
                                    <span class="fw-bold text-truncate" style="max-width: 100px;">{{ Auth::user()->name }}</span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 rounded-3 overflow-hidden">
                                @if(Auth::user()->role == 1)
                                    <li><a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Trang quản trị</a></li>
                                    <li><hr class="dropdown-divider my-0"></li>
                                @endif
                                <li><a class="dropdown-item py-2" href="{{ route('client.orders.index') }}"><i class="bi bi-bag-check me-2"></i> Đơn hàng</a></li>
                                <li><a class="dropdown-item py-2" href="{{ route('client.account.index') }}"><i class="bi bi-person-gear me-2"></i> Tài khoản</a></li>
                                <li><hr class="dropdown-divider my-0"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i> Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                             <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-2 text-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-person fs-5"></i>
                            </div>
                            <div class="d-none d-md-flex flex-column lh-1">
                                <span class="small text-muted" style="font-size: 0.8rem;">Đăng nhập</span>
                                <span class="fw-bold">Tài khoản</span>
                            </div>
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- TẦNG 2: MENU NAVIGATION --}}
        <div class="main-menu bg-primary shadow-sm">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark p-0">
                    <button class="navbar-toggler my-2 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    {{-- Search Mobile --}}
                    <div class="d-lg-none w-100 px-2 pb-2">
                        <form action="{{ route('client.shop') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control rounded-start-pill" placeholder="Tìm kiếm..." name="search">
                                <button class="btn btn-light rounded-end-pill" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="collapse navbar-collapse" id="mainNav">
                        <ul class="navbar-nav me-auto align-items-center">
                            
                            {{-- Dropdown Danh mục (Nổi bật hơn) --}}
                            <li class="nav-item dropdown me-2">
                                <a class="nav-link dropdown-toggle fw-bold text-white bg-black bg-opacity-25 px-4 py-3" href="#" data-bs-toggle="dropdown" style="min-width: 250px;">
                                    <i class="bi bi-list me-2 fs-5 vertical-align-middle"></i> DANH MỤC SẢN PHẨM
                                </a>
                                <ul class="dropdown-menu shadow-lg border-0 mt-0 rounded-0 rounded-bottom-3 p-2 w-100">
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.shop', ['category' => 2]) }}"><i class="fas fa-laptop me-3 text-secondary" style="width: 20px;"></i> Laptop Văn Phòng</a></li>
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.shop', ['category' => 3]) }}"><i class="fas fa-gamepad me-3 text-secondary" style="width: 20px;"></i> Laptop Gaming</a></li>
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.shop', ['category' => 7]) }}"><i class="fas fa-desktop me-3 text-secondary" style="width: 20px;"></i> PC Đồng bộ</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.shop', ['category' => 5]) }}"><i class="fab fa-apple me-3 text-secondary" style="width: 20px;"></i> Apple</a></li>
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.shop', ['category' => 6]) }}"><i class="fas fa-tablet-alt me-3 text-secondary" style="width: 20px;"></i> Máy tính bảng</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.shop', ['category' => 9]) }}"><i class="fas fa-tv me-3 text-secondary" style="width: 20px;"></i> Màn hình</a></li>
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.shop', ['category' => 8]) }}"><i class="fas fa-microchip me-3 text-secondary" style="width: 20px;"></i> Linh kiện</a></li>
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.shop', ['category' => 10]) }}"><i class="fas fa-headset me-3 text-secondary" style="width: 20px;"></i> Gear</a></li>
                                </ul>
                            </li>

                            {{-- Menu Cố định (Thêm hiệu ứng hover ở CSS layout) --}}
                            <li class="nav-item">
                                <a class="nav-link px-3 py-3 text-white fw-semibold text-uppercase" href="{{ route('home') }}">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3 py-3 text-white fw-semibold text-uppercase" href="{{ route('client.shop') }}">Cửa hàng</a>
                            </li>
                            
                            {{-- KHUYẾN MÃI --}}
                            <li class="nav-item">
                                <a class="nav-link px-3 py-3 text-white fw-semibold text-uppercase" href="{{ route('client.sale') }}">Khuyến mãi</a>
                            </li>

                            {{-- HỖ TRỢ KHÁCH HÀNG --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle px-3 py-3 text-white fw-semibold text-uppercase" href="#" data-bs-toggle="dropdown">Hỗ trợ</a>
                                <ul class="dropdown-menu shadow border-0 mt-0 rounded-3 p-2">
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.shopping_guide') }}">Hướng dẫn mua hàng</a></li>
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.warranty_policy') }}">Chính sách bảo hành</a></li>
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.payment_methods') }}">Phương thức thanh toán</a></li>
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.shipping_policy') }}">Vận chuyển & Giao nhận</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('client.orders.index') }}">Tra cứu đơn hàng</a></li>
                                </ul>
                            </li>

                            {{-- LIÊN HỆ --}}
                            <li class="nav-item">
                                <a class="nav-link px-3 py-3 text-white fw-semibold text-uppercase" href="#footer-contact">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main style="margin-top: 155px; min-height: 600px;">
        <div class="container pb-5"> 
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </main>

    {{-- CHATBOX HTML --}}
    <div class="chat-widget">
        <button class="chat-button" onclick="toggleChat()" title="Chat với AI Tư vấn"><i class="bi bi-chat-dots-fill"></i></button>
        <div class="chat-window" id="chatWindow">
            <div class="chat-header">
                <span><i class="bi bi-robot me-2"></i> Trợ lý AI GrabCatPC</span>
                <button type="button" class="btn-close btn-close-white" onclick="toggleChat()"></button>
            </div>
            <div class="chat-body" id="chatBody">
                <div class="message bot">Xin chào! Em là trợ lý ảo AI. Em có thể giúp gì cho anh/chị hôm nay ạ?</div>
            </div>
            <div class="typing-indicator ps-3" id="typingIndicator">
                <div class="spinner-grow spinner-grow-sm text-secondary" role="status"></div>
                <small class="ms-1">AI đang nhập...</small>
            </div>
            <div class="chat-footer">
                <input type="text" id="chatInput" class="form-control rounded-pill" placeholder="Nhập câu hỏi...">
                <button class="btn btn-primary rounded-circle" id="btnChatSend" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="bi bi-send-fill"></i></button>
            </div>
        </div>
    </div>

    {{-- FOOTER (Đã thêm id="footer-contact") --}}
    <footer class="footer-custom py-5" id="footer-contact">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white fw-bold mb-3">GrabCatPC</h4>
                    <p class="mb-3">Hệ thống bán lẻ máy tính và thiết bị công nghệ uy tín hàng đầu.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="fs-4"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="fs-4"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="fs-4"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>THÔNG TIN LIÊN HỆ</h5>
                    <ul class="list-unstyled footer-links">
                        <li><i class="bi bi-geo-alt-fill"></i> 123 Đường ABC, Q. Cầu Giấy, Hà Nội</li>
                        <li><i class="bi bi-telephone-fill"></i> Hotline: 1900 1234 (24/7)</li>
                        <li><i class="bi bi-envelope-fill"></i> Email: support@computershop.vn</li>
                        <li><i class="bi bi-clock-fill"></i> Giờ làm việc: 8:00 - 21:00</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>HỖ TRỢ KHÁCH HÀNG</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('client.shopping_guide') }}">Hướng dẫn mua hàng online</a></li>
                        <li><a href="{{ route('client.warranty_policy') }}">Chính sách bảo hành & Đổi trả</a></li>
                        <li><a href="{{ route('client.payment_methods') }}">Phương thức thanh toán</a></li>
                        <li><a href="{{ route('client.shipping_policy') }}">Vận chuyển & Giao nhận</a></li>
                        <li><a href="{{ route('client.orders.index') }}">Tra cứu đơn hàng</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>ĐĂNG KÝ NHẬN TIN</h5>
                    <div class="input-group mb-3">
                        <input type="email" id="newsletterEmail" class="form-control" placeholder="Email của bạn">
                        <button class="btn btn-primary" type="button" onclick="subscribeNewsletter()"><i class="bi bi-send-fill"></i></button>
                    </div>
                    <small id="newsletterMessage" class="d-block mt-2"></small>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer-bottom text-center text-secondary py-3">
        <p class="mb-0">&copy; {{ date('Y') }} GrabCatPC. Đồ án tốt nghiệp.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- CẤU HÌNH BIẾN TOÀN CỤC CHO JS --}}
    <script>
        window.appConfig = {
            routes: {
                chat: '{{ route("chat.send") }}',
                newsletter: '{{ route("newsletter.subscribe") }}'
            }
        };
    </script>

    {{-- JS RIÊNG CỦA DỰ ÁN --}}
    <script src="{{ asset('js/client-newsletter.js') }}"></script>
    <script src="{{ asset('js/client-chat.js') }}"></script>
    <script src="{{ asset('js/client-banner.js') }}"></script>

    @yield('js')
</body>
</html>
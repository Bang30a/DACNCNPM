<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Token cho AJAX Chatbot --}}
    <title>@yield('title', 'Computer Shop')</title>
    
    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    {{-- Font Awesome (Cho menu icon) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        /* === CSS TÙY CHỈNH CƠ BẢN === */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .card-product:hover { 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
            transform: translateY(-2px);
            transition: all 0.3s ease; 
        }
        .card-product img { 
            height: 200px; 
            object-fit: contain; 
            padding: 15px; 
            transition: transform 0.3s;
        }
        .card-product:hover img {
            transform: scale(1.05);
        }

        /* === CSS CHO CHATBOX AI === */
        .chat-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        .chat-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #0d6efd;
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .chat-button:hover {
            transform: scale(1.1);
        }
        .chat-window {
            position: absolute;
            bottom: 80px;
            right: 0;
            width: 350px;
            height: 450px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            display: none; /* Mặc định ẩn */
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #dee2e6;
        }
        .chat-header {
            background: #0d6efd;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
        }
        .chat-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background-color: #f1f3f5;
        }
        .chat-footer {
            padding: 10px;
            border-top: 1px solid #dee2e6;
            background: white;
            display: flex;
            gap: 10px;
        }
        .message {
            margin-bottom: 10px;
            max-width: 80%;
            padding: 8px 12px;
            border-radius: 15px;
            font-size: 0.9rem;
            line-height: 1.4;
        }
        .message.user {
            background-color: #0d6efd;
            color: white;
            align-self: flex-end;
            margin-left: auto;
            border-bottom-right-radius: 2px;
        }
        .message.bot {
            background-color: #e9ecef;
            color: #212529;
            align-self: flex-start;
            border-bottom-left-radius: 2px;
        }
        .typing-indicator {
            font-size: 0.8rem;
            color: #868e96;
            margin-bottom: 10px;
            display: none;
        }

        /* === CSS CHO FOOTER "BIẾN TẤU" === */
        .footer-custom {
            background-color: #212529; /* Màu tối chuyên nghiệp */
            color: #adb5bd; /* Màu chữ xám nhẹ */
            font-size: 0.9rem;
        }
        .footer-custom h5 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 1.2rem;
            font-size: 1.1rem;
            border-left: 3px solid #0d6efd; /* Điểm nhấn xanh */
            padding-left: 10px;
        }
        .footer-custom a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-custom a:hover {
            color: #0d6efd; /* Hover màu xanh */
        }
        .footer-links li {
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
        }
        .footer-links i {
            margin-right: 10px;
            color: #0d6efd;
            margin-top: 3px;
        }
        .footer-bottom {
            background-color: #1a1d20;
            padding: 15px 0;
            font-size: 0.85rem;
            border-top: 1px solid #343a40;
        }
    </style>
    @yield('css')
</head>
<body>

    {{-- === NAVBAR === --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ route('home') }}">
                <i class="bi bi-pc-display me-2 fs-4"></i> COMPUTER SHOP
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('client.shop') ? 'active fw-semibold' : '' }}" href="{{ route('client.shop') }}">Cửa hàng</a>
                    </li>
                    
                    {{-- MENU DANH MỤC (Đã sửa ID chính xác) --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" data-bs-toggle="dropdown">Danh mục</a>
                        <ul class="dropdown-menu shadow border-0">
                            <li><a class="dropdown-item" href="{{ route('client.shop', ['category' => 2]) }}"><i class="fas fa-laptop me-2 text-secondary"></i> Laptop Văn Phòng</a></li>
                            <li><a class="dropdown-item" href="{{ route('client.shop', ['category' => 3]) }}"><i class="fas fa-gamepad me-2 text-secondary"></i> Laptop Gaming</a></li>
                            <li><a class="dropdown-item" href="{{ route('client.shop', ['category' => 7]) }}"><i class="fas fa-desktop me-2 text-secondary"></i> PC Đồng bộ</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('client.shop', ['category' => 5]) }}"><i class="fab fa-apple me-2 text-secondary"></i> Apple</a></li>
                            <li><a class="dropdown-item" href="{{ route('client.shop', ['category' => 6]) }}"><i class="fas fa-tablet-alt me-2 text-secondary"></i> Máy tính bảng</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('client.shop', ['category' => 9]) }}"><i class="fas fa-tv me-2 text-secondary"></i> Màn hình</a></li>
                            <li><a class="dropdown-item" href="{{ route('client.shop', ['category' => 8]) }}"><i class="fas fa-microchip me-2 text-secondary"></i> Linh kiện</a></li>
                            <li><a class="dropdown-item" href="{{ route('client.shop', ['category' => 10]) }}"><i class="fas fa-headset me-2 text-secondary"></i> Gear</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#">Liên hệ</a></li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('cart.index') }}" class="btn btn-light position-relative border">
                        <i class="bi bi-cart-fill text-primary"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count((array) session('cart')) }}
                        </span>
                    </a>

                    @auth
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="User" width="32" height="32" class="rounded-circle me-2">
                                <span class="fw-semibold">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                @if(Auth::user()->role == 1)
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Trang quản trị</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('client.orders.index') }}"><i class="bi bi-bag-check me-2"></i> Đơn hàng</a></li>
                                <li><a class="dropdown-item" href="{{ route('client.account.index') }}"><i class="bi bi-person-gear me-2"></i> Tài khoản</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="d-flex gap-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Đăng nhập</a>
                            <a href="{{ route('register') }}" class="btn btn-primary">Đăng ký</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- === MAIN CONTENT === --}}
    <main style="margin-top: 80px; min-height: 600px;">
        <div class="container">
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

    {{-- === CHATBOX AI === --}}
    <div class="chat-widget">
        <button class="chat-button" onclick="toggleChat()" title="Chat với AI Tư vấn">
            <i class="bi bi-chat-dots-fill"></i>
        </button>
        
        <div class="chat-window" id="chatWindow">
            <div class="chat-header">
                <span><i class="bi bi-robot me-2"></i> Trợ lý AI Computer Shop</span>
                <button type="button" class="btn-close btn-close-white" onclick="toggleChat()"></button>
            </div>
            <div class="chat-body" id="chatBody">
                <div class="message bot">
                    Xin chào! Em là trợ lý ảo AI. Em có thể giúp gì cho anh/chị hôm nay ạ? (Tư vấn laptop, so sánh cấu hình, tìm sản phẩm...)
                </div>
            </div>
            <div class="typing-indicator ps-3" id="typingIndicator">AI đang soạn tin...</div>
            <div class="chat-footer">
                <input type="text" id="chatInput" class="form-control" placeholder="Nhập câu hỏi..." onkeypress="handleEnter(event)">
                <button class="btn btn-primary" onclick="sendMessage()"><i class="bi bi-send-fill"></i></button>
            </div>
        </div>
    </div>

    {{-- === FOOTER MỚI (Biến tấu) === --}}
    <footer class="footer-custom py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                {{-- Cột 1: Brand --}}
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white fw-bold mb-3">COMPUTER SHOP</h4>
                    <p class="mb-3">Hệ thống bán lẻ máy tính và thiết bị công nghệ uy tín hàng đầu. Cam kết sản phẩm chính hãng, giá tốt nhất thị trường.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="fs-4"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="fs-4"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="fs-4"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

                {{-- Cột 2: Liên hệ --}}
                <div class="col-lg-3 col-md-6">
                    <h5>THÔNG TIN LIÊN HỆ</h5>
                    <ul class="list-unstyled footer-links">
                        <li><i class="bi bi-geo-alt-fill"></i> 123 Đường ABC, Q. Cầu Giấy, Hà Nội</li>
                        <li><i class="bi bi-telephone-fill"></i> Hotline: 1900 1234 (24/7)</li>
                        <li><i class="bi bi-envelope-fill"></i> Email: support@computershop.vn</li>
                        <li><i class="bi bi-clock-fill"></i> Giờ làm việc: 8:00 - 21:00</li>
                    </ul>
                </div>

                {{-- Cột 3: Hỗ trợ --}}
                <div class="col-lg-3 col-md-6">
                    <h5>HỖ TRỢ KHÁCH HÀNG</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">Hướng dẫn mua hàng online</a></li>
                        <li><a href="#">Chính sách bảo hành & Đổi trả</a></li>
                        <li><a href="#">Phương thức thanh toán</a></li>
                        <li><a href="#">Vận chuyển & Giao nhận</a></li>
                        <li><a href="#">Tra cứu đơn hàng</a></li>
                    </ul>
                </div>

                {{-- Cột 4: Bản đồ / Đăng ký --}}
                <div class="col-lg-3 col-md-6">
                    <h5>ĐĂNG KÝ NHẬN TIN</h5>
                    <p class="small">Nhận thông tin khuyến mãi mới nhất từ chúng tôi.</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email của bạn">
                        <button class="btn btn-primary" type="button">Gửi</button>
                    </div>
                    <p class="small text-muted fst-italic">Chúng tôi cam kết bảo mật thông tin của bạn.</p>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer-bottom text-center text-secondary py-3">
        <p class="mb-0">&copy; {{ date('Y') }} Computer Shop. Đồ án tốt nghiệp.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- === SCRIPT CHATBOX === --}}
    <script>
        function toggleChat() {
            const chatWindow = document.getElementById('chatWindow');
            if (chatWindow.style.display === 'none' || chatWindow.style.display === '') {
                chatWindow.style.display = 'flex';
                // Focus vào ô nhập liệu khi mở
                setTimeout(() => document.getElementById('chatInput').focus(), 100);
            } else {
                chatWindow.style.display = 'none';
            }
        }

        function handleEnter(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        }

        async function sendMessage() {
            const input = document.getElementById('chatInput');
            const message = input.value.trim();
            const chatBody = document.getElementById('chatBody');
            const typingIndicator = document.getElementById('typingIndicator');

            if (!message) return;

            // 1. Hiển thị tin nhắn của người dùng
            appendMessage(message, 'user');
            input.value = '';

            // 2. Hiển thị "AI đang soạn tin..."
            typingIndicator.style.display = 'block';
            chatBody.scrollTop = chatBody.scrollHeight; // Cuộn xuống

            try {
                // 3. Gửi API đến Laravel
                const response = await fetch('{{ route("chat.send") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ message: message })
                });

                const data = await response.json();

                // 4. Ẩn indicator và hiển thị tin nhắn AI
                typingIndicator.style.display = 'none';
                appendMessage(data.reply, 'bot');

            } catch (error) {
                console.error('Lỗi chat:', error);
                typingIndicator.style.display = 'none';
                appendMessage('Xin lỗi, hệ thống đang gặp sự cố kết nối.', 'bot');
            }
        }

        function appendMessage(text, sender) {
            const chatBody = document.getElementById('chatBody');
            const div = document.createElement('div');
            div.classList.add('message', sender);
            
            // Chuyển đổi ký tự xuống dòng \n thành thẻ <br> cho đẹp
            div.innerHTML = text.replace(/\n/g, '<br>');
            
            chatBody.appendChild(div);
            chatBody.scrollTop = chatBody.scrollHeight; // Tự động cuộn xuống
        }
    </script>

    @yield('js')
</body>
</html>
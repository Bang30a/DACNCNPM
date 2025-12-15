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
            word-wrap: break-word; /* Tránh tràn chữ */
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
        /* Style cho link trong tin nhắn bot */
        .message.bot a {
            color: #0d6efd;
            text-decoration: underline;
        }
        .typing-indicator {
            font-size: 0.8rem;
            color: #868e96;
            margin-bottom: 10px;
            display: none;
        }

        /* === CSS CHO THẺ SẢN PHẨM TRONG CHAT === */
        .chat-product-list {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 5px;
            margin-bottom: 10px;
            width: 100%;
        }
        .chat-product-card {
            min-width: 150px;
            max-width: 150px;
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 8px;
            font-size: 0.85rem;
            display: flex;
            flex-direction: column;
        }
        .chat-product-img {
            width: 100%;
            height: 80px;
            object-fit: contain;
            margin-bottom: 5px;
        }
        .chat-product-name {
            font-weight: 600;
            margin-bottom: 3px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 30px;
        }
        .chat-product-price {
            color: #dc3545;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .chat-product-original-price {
            font-size: 0.75rem;
            color: #6c757d;
            text-decoration: line-through;
            margin-left: 3px;
        }
        .chat-product-btn {
            margin-top: auto;
            display: block;
            text-align: center;
            background: #e7f1ff;
            color: #0d6efd;
            text-decoration: none;
            padding: 4px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .chat-product-btn:hover {
            background: #0d6efd;
            color: white;
        }

        /* === CSS CHO FOOTER === */
        .footer-custom {
            background-color: #212529;
            color: #adb5bd;
            font-size: 0.9rem;
        }
        .footer-custom h5 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 1.2rem;
            font-size: 1.1rem;
            border-left: 3px solid #0d6efd;
            padding-left: 10px;
        }
        .footer-custom a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-custom a:hover {
            color: #0d6efd;
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
                    
                    {{-- MENU DANH MỤC --}}
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
                <input type="text" id="chatInput" class="form-control" placeholder="Nhập câu hỏi...">
                <button class="btn btn-primary" id="btnChatSend"><i class="bi bi-send-fill"></i></button>
            </div>
        </div>
    </div>

    {{-- === FOOTER === --}}
    <footer class="footer-custom py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white fw-bold mb-3">COMPUTER SHOP</h4>
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
                        <button class="btn btn-primary" type="button" onclick="subscribeNewsletter()">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                    <small id="newsletterMessage" class="d-block mt-2"></small>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer-bottom text-center text-secondary py-3">
        <p class="mb-0">&copy; {{ date('Y') }} Computer Shop. Đồ án tốt nghiệp.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- === SCRIPT ĐĂNG KÝ NHẬN TIN === --}}
    <script>
        function subscribeNewsletter() {
            const emailInput = document.getElementById('newsletterEmail');
            const messageBox = document.getElementById('newsletterMessage');
            const email = emailInput.value.trim();
            const btn = event.currentTarget;

            if (!email) {
                alert('Vui lòng nhập email!');
                return;
            }

            const originalIcon = btn.innerHTML;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
            btn.disabled = true;
            messageBox.innerHTML = '';

            fetch('{{ route("newsletter.subscribe") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ email: email })
            })
            .then(res => res.json())
            .then(data => {
                btn.innerHTML = originalIcon;
                btn.disabled = false;
                if (data.success) {
                    messageBox.className = 'd-block mt-2 text-success fw-bold';
                    messageBox.innerText = data.message;
                    emailInput.value = '';
                } else {
                    messageBox.className = 'd-block mt-2 text-danger';
                    messageBox.innerText = data.message;
                }
            })
            .catch(err => {
                btn.innerHTML = originalIcon;
                btn.disabled = false;
                messageBox.className = 'd-block mt-2 text-danger';
                messageBox.innerText = 'Lỗi hệ thống. Vui lòng thử lại sau.';
            });
        }
    </script>
    
    {{-- === SCRIPT CHATBOX === --}}
    <script>
        function formatAiMessage(message) {
            if (!message) return '';
            let formattedText = message.replace(
                /\[([^\]]+)\]\(([^)]+)\)/g, 
                '<a href="$2" target="_blank" style="color: #0d6efd; text-decoration: underline; font-weight: 600;">$1</a>'
            );
            formattedText = formattedText.replace(/\n/g, '<br>');
            formattedText = formattedText.replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>');
            return formattedText;
        }

        function toggleChat() {
            const chatWindow = document.getElementById('chatWindow');
            if (chatWindow.style.display === 'none' || chatWindow.style.display === '') {
                chatWindow.style.display = 'flex';
                setTimeout(() => document.getElementById('chatInput').focus(), 100);
            } else {
                chatWindow.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const chatInput = document.getElementById('chatInput');
            const sendButton = document.getElementById('btnChatSend');

            if (sendButton) {
                sendButton.addEventListener('click', sendMessage);
            }
            if (chatInput) {
                chatInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        sendMessage();
                    }
                });
            }
        });

        async function sendMessage() {
            const input = document.getElementById('chatInput');
            const message = input.value.trim();
            const typingIndicator = document.getElementById('typingIndicator');

            if (!message) return;

            appendMessage(message, 'user');
            input.value = '';
            typingIndicator.style.display = 'block';
            scrollToBottom();

            try {
                const response = await fetch('{{ route("chat.send") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ message: message })
                });

                const data = await response.json();
                typingIndicator.style.display = 'none';

                if (data.reply) {
                    const formattedReply = formatAiMessage(data.reply);
                    appendMessage(formattedReply, 'bot');
                }
                if (data.products && data.products.length > 0) {
                    renderProductCards(data.products);
                }

            } catch (error) {
                console.error('Lỗi chat:', error);
                typingIndicator.style.display = 'none';
                appendMessage('Xin lỗi, hệ thống đang gặp sự cố kết nối.', 'bot');
            }
        }

        function appendMessage(htmlContent, sender) {
            const chatBody = document.getElementById('chatBody');
            const div = document.createElement('div');
            div.classList.add('message', sender);
            if (sender === 'user') {
                div.textContent = htmlContent;
            } else {
                div.innerHTML = htmlContent;
            }
            chatBody.appendChild(div);
            scrollToBottom();
        }

        function renderProductCards(products) {
            const chatBody = document.getElementById('chatBody');
            const listDiv = document.createElement('div');
            listDiv.className = 'chat-product-list';

            products.forEach(product => {
                const originalPriceHtml = product.originalPrice 
                    ? `<span class="chat-product-original-price">${product.originalPrice}</span>` 
                    : '';
                const imageUrl = product.image ? product.image : 'https://via.placeholder.com/150';

                const cardHtml = `
                    <div class="chat-product-card">
                        <img src="${imageUrl}" class="chat-product-img" alt="${product.name}">
                        <div class="chat-product-name" title="${product.name}">${product.name}</div>
                        <div class="chat-product-price">
                            ${product.price}
                            ${originalPriceHtml}
                        </div>
                        <a href="${product.link}" target="_blank" class="chat-product-btn">Xem chi tiết</a>
                    </div>
                `;
                listDiv.innerHTML += cardHtml;
            });

            chatBody.appendChild(listDiv);
            scrollToBottom();
        }

        function scrollToBottom() {
            const chatBody = document.getElementById('chatBody');
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    </script>

    @yield('js')
</body>
</html>
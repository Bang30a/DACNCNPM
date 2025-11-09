<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Computer Shop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        /* CSS tùy chỉnh cơ bản */
        .card-product:hover { box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: 0.3s; }
        .card-product img { height: 200px; object-fit: contain; padding: 10px; }
    </style>
    @yield('css')
</head>
<body>
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
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('client.shop', ['category' => 1]) }}">Laptop</a></li>
                            <li><a class="dropdown-item" href="{{ route('client.shop', ['category' => 2]) }}">PC Gaming</a></li>
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
                <li><a class="dropdown-item" href="#">Đơn hàng của tôi</a></li>
                <li><a class="dropdown-item" href="#">Tài khoản</a></li>
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

    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Computer Shop. Đồ án môn học.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>
</html>
@extends('client.layout')
@section('title', 'Trang chủ')

@section('content')
    {{-- 1. BANNER CHÀO MỪNG --}}
    <div class="bg-primary text-white py-5 mb-5 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);">
        <div class="container px-4 py-3">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-5 fw-bold mb-3">Chào mừng đến Computer Shop</h1>
                    <p class="lead mb-4 opacity-75">Nơi cung cấp các sản phẩm công nghệ chất lượng cao, cấu hình mạnh mẽ với mức giá tốt nhất dành cho sinh viên.</p>
                    <a href="{{ route('client.shop') }}" class="btn btn-light btn-lg fw-bold text-primary px-4 shadow-sm">
                        <i class="bi bi-bag-fill me-2"></i> Khám phá ngay
                    </a>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2933/2933245.png" alt="Banner" style="max-width: 280px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2)); animation: float 3s ease-in-out infinite;">
                </div>
            </div>
        </div>
    </div>

    {{-- 2. SECTION: GIẢM GIÁ SỐC (Luôn hiển thị đầu tiên nếu có) --}}
    @if($saleProducts->count() > 0)
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <h3 class="fw-bold text-danger m-0"><i class="bi bi-lightning-charge-fill me-2"></i>Đang Giảm Giá Sốc</h3>
                {{-- Link này dẫn đến trang shop và lọc sp có giá sale (nếu bạn làm chức năng lọc đó), hoặc cứ để về shop chung --}}
                <a href="{{ route('client.shop') }}" class="text-decoration-none text-danger fw-semibold">Xem tất cả <i class="bi bi-arrow-right"></i></a>
            </div>
            
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach($saleProducts as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm card-product position-relative">
                            @php
                                $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                            @endphp
                            <span class="position-absolute top-0 start-0 bg-danger text-white badge rounded-pill m-3 shadow-sm">
                                -{{ $discount }}%
                            </span>

                            <a href="{{ route('client.product.detail', $product->slug) }}" class="text-center bg-light rounded-top p-3">
                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid" alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/300" class="img-fluid" alt="No Image">
                                @endif
                            </a>
                            
                            <div class="card-body d-flex flex-column">
                                <div class="mb-2 text-muted small text-uppercase fw-bold">{{ $product->category->name ?? 'Sản phẩm' }}</div>
                                <h6 class="card-title text-truncate mb-3">
                                    <a href="{{ route('client.product.detail', $product->slug) }}" class="text-dark text-decoration-none" title="{{ $product->name }}">
                                        {{ $product->name }}
                                    </a>
                                </h6>
                                <div class="mt-auto">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <span class="fw-bold text-danger fs-5">{{ number_format($product->sale_price) }}đ</span>
                                        <small class="text-decoration-line-through text-muted">{{ number_format($product->price) }}đ</small>
                                    </div>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger w-100 fw-bold">
                                            <i class="bi bi-cart-plus-fill"></i> Mua Ngay
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- 3. VÒNG LẶP CÁC DANH MỤC (Mỗi danh mục 4 sản phẩm) --}}
    @foreach($categories as $category)
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <h3 class="fw-bold text-dark m-0">
                    <i class="bi bi-tag-fill me-2 text-primary"></i>{{ $category->name }}
                </h3>
                <a href="{{ route('client.shop', ['category' => $category->id]) }}" class="text-decoration-none fw-semibold">
                    Xem tất cả {{ $category->name }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach($category->products as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm card-product">
                            <a href="{{ route('client.product.detail', $product->slug) }}" class="text-center bg-light rounded-top p-3">
                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid" alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/300" class="img-fluid" alt="No Image">
                                @endif
                            </a>
                            <div class="card-body d-flex flex-column">
                                {{-- Tên danh mục nhỏ --}}
                                <div class="mb-2 text-muted small text-uppercase fw-bold">{{ $category->name }}</div>
                                
                                <h6 class="card-title text-truncate mb-3">
                                    <a href="{{ route('client.product.detail', $product->slug) }}" class="text-dark text-decoration-none" title="{{ $product->name }}">
                                        {{ $product->name }}
                                    </a>
                                </h6>
                                <div class="mt-auto">
                                    <div class="mb-3">
                                        @if($product->sale_price && $product->sale_price < $product->price)
                                            <span class="fw-bold text-danger fs-5">{{ number_format($product->sale_price) }}đ</span>
                                            <small class="text-decoration-line-through text-muted ms-2">{{ number_format($product->price) }}đ</small>
                                        @else
                                            <span class="fw-bold text-dark fs-5">{{ number_format($product->price) }}đ</span>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary w-100 fw-bold">
                                            <i class="bi bi-cart-plus"></i> Thêm vào giỏ
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    {{-- CSS Animation nhẹ cho ảnh Banner --}}
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
@endsection
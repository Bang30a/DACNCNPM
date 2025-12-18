@extends('client.layout')
@section('title', 'Trang chủ - GrabCatPC')

@section('css')
    {{-- Nhúng file CSS riêng của trang chủ --}}
    @vite(['resources/css/index.css', 'resources/js/app.js'])
@endsection

@section('content')
    {{-- 1. SLIDESHOW (CAROUSEL) --}}
    <div id="heroCarousel" class="carousel slide carousel-fade mb-5 shadow-lg rounded-4 overflow-hidden position-relative" data-bs-ride="carousel" data-bs-interval="4000">
        {{-- Nút chỉ dẫn --}}
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        {{-- Nội dung các Slide --}}
        <div class="carousel-inner">
            {{-- Slide 1 --}}
            <div class="carousel-item active">
                <div class="overlay-gradient"></div>
                <img src="https://images.unsplash.com/photo-1603302576837-37561b2e2302?q=80&w=1600&auto=format&fit=crop" class="d-block w-100 object-fit-cover hero-img" style="height: 500px;" alt="Laptop Văn Phòng">
                <div class="carousel-caption d-none d-md-flex flex-column align-items-start justify-content-center h-100 text-start ps-5" style="top: 0; bottom: 0; left: 0; right: 0;">
                    <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill animate-up delay-0">Khuyến mãi mùa tựu trường</span>
                    <h1 class="display-3 fw-bold text-white mb-3 drop-shadow animate-up delay-1">Laptop Văn Phòng <br> & Học Tập</h1>
                    <p class="fs-5 text-white-50 mb-4 drop-shadow animate-up delay-2" style="max-width: 600px;">Thiết kế mỏng nhẹ, pin trâu, hiệu năng ổn định. Đồng hành cùng bạn trên mọi giảng đường.</p>
                    <a href="{{ route('client.shop', ['category' => 2]) }}" class="btn btn-light btn-lg rounded-pill fw-bold text-primary shadow-lg px-5 py-3 animate-up delay-3 hover-scale">
                        <i class="bi bi-cart-plus me-2"></i>Xem Ngay
                    </a>
                </div>
            </div>

            {{-- Slide 2 --}}
            <div class="carousel-item">
                <div class="overlay-gradient"></div>
                <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=1600&auto=format&fit=crop" class="d-block w-100 object-fit-cover hero-img" style="height: 500px;" alt="Gaming Gear">
                <div class="carousel-caption d-none d-md-flex flex-column align-items-start justify-content-center h-100 text-start ps-5" style="top: 0; bottom: 0; left: 0; right: 0;">
                    <span class="badge bg-danger mb-3 px-3 py-2 rounded-pill animate-up delay-0">Gaming Gear</span>
                    <h1 class="display-3 fw-bold text-white mb-3 drop-shadow animate-up delay-1">PC Gaming <br> Đỉnh Cao</h1>
                    <p class="fs-5 text-white-50 mb-4 drop-shadow animate-up delay-2" style="max-width: 600px;">Chiến mọi tựa game AAA với cấu hình khủng nhất. Trải nghiệm mượt mà, không giật lag.</p>
                    <a href="{{ route('client.shop', ['category' => 3]) }}" class="btn btn-danger btn-lg rounded-pill fw-bold shadow-lg px-5 py-3 animate-up delay-3 hover-scale">
                        <i class="bi bi-controller me-2"></i>Sắm Ngay
                    </a>
                </div>
            </div>

            {{-- Slide 3 --}}
            <div class="carousel-item">
                <div class="overlay-gradient"></div>
                <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?q=80&w=1600&auto=format&fit=crop" class="d-block w-100 object-fit-cover hero-img" style="height: 500px;" alt="Linh Kiện">
                <div class="carousel-caption d-none d-md-flex flex-column align-items-start justify-content-center h-100 text-start ps-5" style="top: 0; bottom: 0; left: 0; right: 0;">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill animate-up delay-0">Nâng cấp PC</span>
                    <h1 class="display-3 fw-bold text-white mb-3 drop-shadow animate-up delay-1">Linh Kiện <br> Chính Hãng</h1>
                    <p class="fs-5 text-white-50 mb-4 drop-shadow animate-up delay-2" style="max-width: 600px;">Card màn hình, RAM, SSD giá tốt nhất thị trường. Bảo hành chính hãng 36 tháng.</p>
                    <a href="{{ route('client.shop', ['category' => 8]) }}" class="btn btn-warning btn-lg rounded-pill fw-bold text-dark shadow-lg px-5 py-3 animate-up delay-3 hover-scale">
                        <i class="bi bi-cpu me-2"></i>Nâng Cấp
                    </a>
                </div>
            </div>
        </div>

        {{-- Nút điều hướng Trái/Phải --}}
        <button class="carousel-control-prev opacity-0 hover-opacity-100 transition-opacity" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon p-4 bg-white bg-opacity-10 rounded-circle backdrop-blur" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next opacity-0 hover-opacity-100 transition-opacity" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon p-4 bg-white bg-opacity-10 rounded-circle backdrop-blur" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- 2. SECTION: GIẢM GIÁ SỐC --}}
    @if(isset($saleProducts) && $saleProducts->count() > 0)
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <h3 class="fw-bold text-danger m-0 d-flex align-items-center">
                    <span class="me-2 fs-2">⚡</span> ĐANG GIẢM GIÁ SỐC
                </h3>
                <a href="{{ route('client.sale') }}" class="btn btn-outline-danger rounded-pill px-4 fw-bold hover-scale">
                    Xem tất cả <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach($saleProducts as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm card-product position-relative overflow-hidden rounded-4">
                            @php
                                $discount = 0;
                                if($product->price > 0) {
                                    $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                                }
                            @endphp
                            <span class="position-absolute top-0 start-0 bg-danger text-white badge rounded-end-pill m-3 shadow py-2 px-3 fw-bold" style="z-index: 10;">
                                -{{ $discount }}%
                            </span>

                            <a href="{{ route('client.product.detail', $product->slug) }}" class="text-center bg-light p-4 position-relative overflow-hidden group-hover-img">
                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid transition-transform duration-300" alt="{{ $product->name }}">
                                @elseif($product->image_url)
                                     <img src="{{ $product->image_url }}" class="img-fluid transition-transform duration-300" alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/300" class="img-fluid transition-transform duration-300" alt="No Image">
                                @endif
                            </a>
                            
                            <div class="card-body d-flex flex-column p-3">
                                <div class="mb-2 text-muted small text-uppercase fw-bold ls-1">{{ $product->category->name ?? 'Sản phẩm' }}</div>
                                <h6 class="card-title mb-3">
                                    <a href="{{ route('client.product.detail', $product->slug) }}" class="text-dark text-decoration-none fw-bold text-truncate-2" title="{{ $product->name }}">
                                        {{ $product->name }}
                                    </a>
                                </h6>
                                <div class="mt-auto">
                                    <div class="d-flex align-items-end gap-2 mb-3">
                                        <span class="fw-bold text-danger fs-5">{{ number_format($product->sale_price) }}đ</span>
                                        <small class="text-decoration-line-through text-muted mb-1">{{ number_format($product->price) }}đ</small>
                                    </div>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold shadow-sm hover-scale">
                                            <i class="bi bi-cart-plus-fill me-1"></i> Mua Ngay
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

    {{-- 3. VÒNG LẶP CÁC DANH MỤC --}}
    @if(isset($categories))
        @foreach($categories as $category)
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h3 class="fw-bold text-dark m-0 d-flex align-items-center">
                        <i class="bi bi-collection-play me-2 text-primary"></i> {{ $category->name }}
                    </h3>
                    <a href="{{ route('client.shop', ['category' => $category->id]) }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold hover-scale">
                        Xem thêm <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    @foreach($category->products as $product)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm card-product rounded-4 overflow-hidden">
                                <a href="{{ route('client.product.detail', $product->slug) }}" class="text-center bg-light p-4 position-relative overflow-hidden">
                                    @if($product->thumbnail)
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid transition-transform duration-300" alt="{{ $product->name }}">
                                    @elseif($product->image_url)
                                         <img src="{{ $product->image_url }}" class="img-fluid transition-transform duration-300" alt="{{ $product->name }}">
                                    @else
                                        <img src="https://via.placeholder.com/300" class="img-fluid transition-transform duration-300" alt="No Image">
                                    @endif
                                </a>
                                <div class="card-body d-flex flex-column p-3">
                                    <div class="mb-2 text-muted small text-uppercase fw-bold ls-1">{{ $category->name }}</div>
                                    
                                    <h6 class="card-title mb-3">
                                        <a href="{{ route('client.product.detail', $product->slug) }}" class="text-dark text-decoration-none fw-bold text-truncate-2" title="{{ $product->name }}">
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
                                            <button type="submit" class="btn btn-outline-primary w-100 rounded-pill fw-bold hover-scale">
                                                <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ
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
    @endif
@endsection
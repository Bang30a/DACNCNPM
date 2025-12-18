@extends('client.layout') 
@section('title', 'Săn Sale Giá Sốc - GrabCatPC')

{{-- Gọi file CSS riêng --}}
@section('css')
    {{-- Nhúng file CSS riêng của trang chủ --}}
    @vite(['resources/css/index.css', 'resources/js/app.js'])
@endsection

@section('content')
<div class="py-4">
    
    {{-- Banner tiêu đề --}}
    <div class="sale-banner">
        <h1 class="sale-title"><i class="bi bi-lightning-fill text-warning"></i> SALE SỐC</h1>
        <p class="sale-desc">Săn ngay những deal công nghệ "ngon - bổ - rẻ" nhất trong tháng. Số lượng có hạn, nhanh tay kẻo lỡ!</p>
    </div>

    {{-- Danh sách sản phẩm --}}
    <div class="container">
        @if($products->count() > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($products as $product)
                    <div class="col">
                        <div class="card card-sale">
                            {{-- Tính % giảm giá --}}
                            @php
                                $discount = 0;
                                if($product->price > 0) {
                                    $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                                }
                            @endphp
                            
                            {{-- Badge Giảm giá --}}
                            <span class="discount-badge">-{{ $discount }}%</span>

                            {{-- Hình ảnh --}}
                            <a href="{{ route('client.product.detail', $product->slug) }}" class="card-sale-img">
                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                                @elseif($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/300" alt="No Image">
                                @endif
                            </a>

                            {{-- Nội dung --}}
                            <div class="card-sale-body">
                                <a href="{{ route('client.product.detail', $product->slug) }}" class="product-name" title="{{ $product->name }}">
                                    {{ $product->name }}
                                </a>

                                <div class="price-wrap">
                                    <span class="sale-price">{{ number_format($product->sale_price) }}đ</span>
                                    <span class="original-price">{{ number_format($product->price) }}đ</span>
                                </div>
                                
                                {{-- Nút Mua --}}
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    {{-- Thêm redirect để ở lại trang này --}}
                                    <input type="hidden" name="redirect" value="back">
                                    <button type="submit" class="btn btn-primary btn-buy-now text-white">
                                        <i class="bi bi-cart-plus-fill me-1"></i> Thêm vào giỏ
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Phân trang --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-emoji-frown"></i>
                <h4>Hiện chưa có chương trình khuyến mãi nào.</h4>
                <p>Vui lòng quay lại sau nhé!</p>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-3 rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại trang chủ
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
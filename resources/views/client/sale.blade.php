@extends('client.layout') {{-- SỬA LẠI THÀNH client.layout --}}

@section('title', 'Săn Sale Giá Sốc - Computer Shop')

@section('content')
<div class="py-4">
    {{-- Banner tiêu đề --}}
    <div class="p-5 mb-4 bg-danger rounded-3 text-white shadow" 
         style="background: linear-gradient(45deg, #dc3545, #ff6b6b);">
        <div class="container-fluid py-3 text-center">
            <h1 class="display-5 fw-bold"><i class="bi bi-lightning-charge-fill text-warning"></i> KHUYẾN MÃI CỰC SỐC</h1>
            <p class="col-md-8 fs-5 mx-auto">Săn ngay những deal công nghệ "ngon - bổ - rẻ" nhất trong tháng. Số lượng có hạn!</p>
        </div>
    </div>

    {{-- Danh sách sản phẩm --}}
    <div class="row g-4">
        @if($products->count() > 0)
            @foreach($products as $product)
                <div class="col-6 col-md-3">
                    <div class="card card-product h-100 border-0 shadow-sm position-relative">
                        {{-- Nhãn giảm giá --}}
                        @php
                            $discount = 0;
                            if($product->price > 0) {
                                $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                            }
                        @endphp
                        <span class="position-absolute top-0 start-0 badge bg-danger m-3 fs-6">
                            -{{ $discount }}%
                        </span>

                        {{-- Hình ảnh --}}
                        <a href="{{ route('client.product.detail', $product->slug) }}">
                            @if($product->thumbnail)
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="card-img-top" alt="{{ $product->name }}">
                            @elseif($product->image_url)
                                <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/300" class="card-img-top" alt="No Image">
                            @endif
                        </a>

                        <div class="card-body d-flex flex-column">
                            {{-- Tên sản phẩm --}}
                            <h6 class="card-title">
                                <a href="{{ route('client.product.detail', $product->slug) }}" class="text-decoration-none text-dark fw-bold">
                                    {{ Str::limit($product->name, 40) }}
                                </a>
                            </h6>

                            {{-- Giá cả --}}
                            <div class="mt-auto">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="text-danger fw-bold fs-5">{{ number_format($product->sale_price) }}đ</span>
                                    <span class="text-muted text-decoration-line-through small">{{ number_format($product->price) }}đ</span>
                                </div>
                            </div>
                            
                            {{-- Nút mua --}}
                            <div class="d-grid mt-3">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        <i class="bi bi-cart-plus"></i> Thêm vào giỏ
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" width="100" class="mb-3 opacity-50">
                <h4 class="text-muted">Hiện chưa có chương trình khuyến mãi nào.</h4>
                <a href="{{ route('home') }}" class="btn btn-primary mt-2">Quay lại trang chủ</a>
            </div>
        @endif
    </div>

    {{-- Phân trang --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
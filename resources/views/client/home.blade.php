@extends('client.layout')
@section('title', 'Trang chủ - Computer Shop')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3" style="background: linear-gradient(45deg, #0d6efd, #6610f2); color: white;">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Chào mừng đến Computer Shop</h1>
            <p class="col-md-8 fs-4">Nơi cung cấp các sản phẩm công nghệ chất lượng cao với giá tốt nhất cho sinh viên.</p>
            <button class="btn btn-light btn-lg fw-bold" type="button">Khám phá ngay</button>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="m-0">Sản phẩm mới nhất</h2>
        <a href="#" class="text-decoration-none">Xem tất cả <i class="bi bi-chevron-right"></i></a>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($newProducts as $product)
        <div class="col">
            <div class="card h-100 card-product border-0 shadow-sm">
                <div class="position-relative text-center p-3" style="height: 220px; background: #f8f9fa;">
                     @if($product->sale_price)
                        <span class="position-absolute top-0 start-0 badge bg-danger m-2">-{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%</span>
                    @endif

                    @if($product->thumbnail)
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid h-100" style="object-fit: contain;" alt="{{ $product->name }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 text-muted bg-light">
                            No Image
                        </div>
                    @endif
                </div>

                <div class="card-body d-flex flex-column">
                    <small class="text-muted mb-1">{{ $product->category->name ?? 'Laptop' }}</small>
                    <h5 class="card-title text-truncate" title="{{ $product->name }}">
                        <a href="{{ route('client.product.detail', $product->slug) }}" class="text-decoration-none text-dark stretched-link">{{ $product->name }}</a>
                    </h5>

                    <div class="mt-auto pt-2">
                        @if($product->sale_price)
                            <div class="d-flex align-items-center">
                                <span class="text-danger fw-bold fs-5 me-2">{{ number_format($product->sale_price, 0, ',', '.') }}đ</span>
                                <small class="text-muted text-decoration-line-through">{{ number_format($product->price, 0, ',', '.') }}đ</small>
                            </div>
                        @else
                            <span class="fw-bold fs-5">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Chưa có sản phẩm nào.</p>
            </div>
        @endforelse
    </div>
@endsection
@extends('client.layout')
@section('title', $product->name . ' - Computer Shop')

@section('content')
    <nav aria-label="breadcrumb" class="my-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm p-3">
                @if($product->thumbnail)
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/600x600?text=No+Image" class="img-fluid" alt="No Image">
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="fw-bold h2">{{ $product->name }}</h1>
            <div class="mb-3">
                <span class="badge bg-primary me-2">{{ $product->brand->name }}</span>
                <span class="text-muted">Mã SP: {{ $product->sku }}</span>
                <span class="mx-2">|</span>
                <span class="{{ $product->quantity > 0 ? 'text-success' : 'text-danger' }}">
                    <i class="bi bi-check-circle-fill"></i> {{ $product->quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}
                </span>
            </div>

            <div class="mb-4 p-3 bg-light rounded-3">
                @if($product->sale_price)
                    <span class="text-danger fw-bold display-6 me-3">{{ number_format($product->sale_price, 0, ',', '.') }}đ</span>
                    <span class="text-muted text-decoration-line-through fs-5">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                @else
                    <span class="fw-bold display-6">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                @endif
            </div>

            <ul class="list-unstyled mb-4">
                @if($product->cpu) <li><i class="bi bi-cpu me-2"></i> <strong>CPU:</strong> {{ $product->cpu }}</li> @endif
                @if($product->ram) <li><i class="bi bi-memory me-2"></i> <strong>RAM:</strong> {{ $product->ram }}</li> @endif
                @if($product->storage) <li><i class="bi bi-hdd me-2"></i> <strong>Ổ cứng:</strong> {{ $product->storage }}</li> @endif
                @if($product->vga) <li><i class="bi bi-gpu-card me-2"></i> <strong>VGA:</strong> {{ $product->vga }}</li> @endif
                @if($product->screen) <li><i class="bi bi-display me-2"></i> <strong>Màn hình:</strong> {{ $product->screen }}</li> @endif
            </ul>

            <div class="d-grid gap-2 d-md-flex">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline flex-grow-1">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg w-100" {{ $product->quantity > 0 ? '' : 'disabled' }}>
                            <i class="bi bi-cart-plus-fill me-2"></i> THÊM VÀO GIỎ HÀNG
                        </button>
                    </form>
                <button class="btn btn-danger btn-lg flex-grow-1" {{ $product->quantity > 0 ? '' : 'disabled' }}>
                    MUA NGAY
                </button>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <h3 class="border-bottom pb-2 mb-3">Mô tả sản phẩm</h3>
            <div class="bg-white p-4 shadow-sm rounded">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    </div>
@endsection
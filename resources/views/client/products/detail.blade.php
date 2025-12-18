@extends('client.layout')
@section('title', $product->name . ' - GrabCatPC')


@section('content')
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="my-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('client.shop', ['category' => $product->category_id]) }}" class="text-decoration-none text-muted">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    {{-- KHU VỰC CHÍNH: ẢNH VÀ THÔNG TIN --}}
    <div class="row mb-5">
        {{-- CỘT TRÁI: ẢNH SẢN PHẨM --}}
        <div class="col-lg-5 mb-4">
            <div class="product-image-box">
                @if($product->thumbnail)
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/600x600?text=No+Image" alt="No Image">
                @endif
                
                {{-- Badge Sale --}}
                @if($product->sale_price && $product->sale_price < $product->price)
                    @php
                        $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                    @endphp
                    <span class="position-absolute top-0 start-0 m-3 badge bg-danger fs-5 px-3 py-2 rounded-pill shadow">
                        -{{ $discount }}%
                    </span>
                @endif
            </div>
        </div>

        {{-- CỘT PHẢI: THÔNG TIN CHI TIẾT --}}
        <div class="col-lg-7">
            <h1 class="product-title fw-bold">{{ $product->name }}</h1>
            
            <div class="d-flex align-items-center flex-wrap gap-3 mb-4 text-muted small">
                <span><i class="bi bi-tag-fill text-primary"></i> Thương hiệu: <strong>{{ $product->brand->name }}</strong></span>
                <span class="border-start ps-3">Mã SP: <strong>{{ $product->sku }}</strong></span>
                <span class="border-start ps-3">
                    Tình trạng: 
                    <span class="{{ $product->quantity > 0 ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                        {{ $product->quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}
                    </span>
                </span>
            </div>

            {{-- GIÁ TIỀN --}}
            <div class="price-box">
                @if($product->sale_price && $product->sale_price < $product->price)
                    <span class="current-price">{{ number_format($product->sale_price, 0, ',', '.') }}đ</span>
                    <span class="old-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                @else
                    <span class="current-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                @endif
            </div>

            {{-- THÔNG SỐ KỸ THUẬT (GRID) --}}
            <div class="specs-container mb-4">
                <h6 class="fw-bold mb-3 text-uppercase text-secondary"><i class="bi bi-gear-wide-connected me-2"></i>Thông số nổi bật</h6>
                <div class="specs-grid">
                    @if($product->cpu) <div class="spec-item"><i class="bi bi-cpu"></i> <div><span class="spec-label">CPU:</span> {{ $product->cpu }}</div></div> @endif
                    @if($product->ram) <div class="spec-item"><i class="bi bi-memory"></i> <div><span class="spec-label">RAM:</span> {{ $product->ram }}</div></div> @endif
                    @if($product->storage) <div class="spec-item"><i class="bi bi-hdd"></i> <div><span class="spec-label">Ổ cứng:</span> {{ $product->storage }}</div></div> @endif
                    @if($product->vga) <div class="spec-item"><i class="bi bi-gpu-card"></i> <div><span class="spec-label">VGA:</span> {{ $product->vga }}</div></div> @endif
                    @if($product->screen) <div class="spec-item"><i class="bi bi-display"></i> <div><span class="spec-label">Màn hình:</span> {{ $product->screen }}</div></div> @endif
                    
                    {{-- Các thông số khác (Render động nếu có) --}}
                    @if($product->spec_refresh_rate) <div class="spec-item"><i class="bi bi-speedometer2"></i> <div><span class="spec-label">Tần số:</span> {{ $product->spec_refresh_rate }}</div></div> @endif
                    @if($product->spec_panel_type) <div class="spec-item"><i class="bi bi-grid"></i> <div><span class="spec-label">Tấm nền:</span> {{ $product->spec_panel_type }}</div></div> @endif
                    @if($product->spec_keyboard) <div class="spec-item"><i class="bi bi-keyboard"></i> <div><span class="spec-label">Phím:</span> {{ $product->spec_keyboard }}</div></div> @endif
                    @if($product->spec_battery) <div class="spec-item"><i class="bi bi-battery-charging"></i> <div><span class="spec-label">Pin:</span> {{ $product->spec_battery }}</div></div> @endif
                    @if($product->spec_weight) <div class="spec-item"><i class="bi bi-backpack"></i> <div><span class="spec-label">Trọng lượng:</span> {{ $product->spec_weight }}</div></div> @endif
                </div>
            </div>

            {{-- NÚT HÀNH ĐỘNG --}}
            <div class="action-buttons d-flex gap-3">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary w-100 btn-lg rounded-pill" {{ $product->quantity > 0 ? '' : 'disabled' }}>
                        <i class="bi bi-cart-plus me-2"></i> THÊM VÀO GIỎ
                    </button>
                </form>
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1">
                    @csrf
                    {{-- Có thể thêm input hidden redirect tới checkout nếu muốn Mua ngay --}}
                    <button type="submit" class="btn btn-danger w-100 btn-lg rounded-pill text-white" {{ $product->quantity > 0 ? '' : 'disabled' }}>
                        MUA NGAY
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- PHẦN MÔ TẢ & SẢN PHẨM LIÊN QUAN --}}
    <div class="row mb-5">
        {{-- Cột Nội dung --}}
        <div class="col-lg-8">
            <h3 class="section-title">Mô tả chi tiết</h3>
            <div class="content-box mb-5">
                {!! nl2br(e($product->description)) !!}
            </div>

            {{-- PHẦN ĐÁNH GIÁ --}}
            <h3 class="section-title" id="reviews">Đánh giá khách hàng</h3>
            <div class="content-box">
                {{-- Form Viết đánh giá --}}
                <div class="review-form-card p-4 rounded mb-4">
                    <h5 class="fw-bold mb-3 text-primary">Viết đánh giá của bạn</h5>
                    <form id="review-form" action="{{ route('reviews.store', ['productId' => $product->id]) }}" method="POST">
                        @csrf 
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Tên hiển thị</label>
                                <input type="text" name="reviewer_name" value="{{ auth()->user()->name ?? old('reviewer_name') }}" class="form-control" placeholder="Nhập tên của bạn" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Đánh giá sao</label>
                                <select name="rating" class="form-select" required>
                                    <option value="5">★★★★★ (Tuyệt vời)</option>
                                    <option value="4">★★★★☆ (Hài lòng)</option>
                                    <option value="3">★★★☆☆ (Bình thường)</option>
                                    <option value="2">★★☆☆☆ (Tệ)</option>
                                    <option value="1">★☆☆☆☆ (Rất tệ)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Nội dung đánh giá</label>
                                <textarea name="comment" rows="3" class="form-control" placeholder="Chia sẻ cảm nhận của bạn về sản phẩm..." required>{{ old('comment') }}</textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-4 fw-bold">Gửi đánh giá</button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Danh sách đánh giá --}}
                <div class="review-list">
                    @forelse ($product->reviews as $review)
                        <div class="review-item mb-3">
                            <div class="d-flex">
                                <div class="avatar-circle me-3">
                                    {{-- Lấy chữ cái đầu của tên --}}
                                    {{ strtoupper(substr($review->reviewer_name ?? $review->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-2">
                                        <h6 class="fw-bold mb-0">{{ $review->reviewer_name ?? $review->user->name }}</h6>
                                        <small class="text-muted fst-italic">- {{ $review->created_at->format('d/m/Y') }}</small>
                                    </div>
                                    <div class="text-warning small mb-2">
                                        {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                    </div>
                                    <p class="mb-0 text-secondary">{{ $review->comment }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-chat-square-text fs-1 d-block mb-2 opacity-50"></i>
                            Chưa có đánh giá nào. Hãy là người đầu tiên!
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Cột Sản phẩm liên quan (Sidebar) --}}
        <div class="col-lg-4">
            <h3 class="section-title">Sản phẩm liên quan</h3>
            <div class="content-box p-0 bg-transparent shadow-none">
                @if(isset($relatedProducts) && count($relatedProducts) > 0)
                    <div class="row row-cols-1 g-3">
                        @foreach($relatedProducts as $related)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden d-flex flex-row align-items-center p-2 bg-white">
                                    <a href="{{ route('client.product.detail', $related->slug) }}" class="flex-shrink-0" style="width: 100px;">
                                        @if($related->thumbnail)
                                            <img src="{{ asset('storage/' . $related->thumbnail) }}" class="img-fluid" style="height: 80px; object-fit: contain;" alt="{{ $related->name }}">
                                        @else
                                            <img src="https://via.placeholder.com/100" class="img-fluid" alt="No Image">
                                        @endif
                                    </a>
                                    <div class="card-body py-2 px-3">
                                        <h6 class="card-title mb-1">
                                            <a href="{{ route('client.product.detail', $related->slug) }}" class="text-decoration-none text-dark text-truncate-2 small fw-bold">
                                                {{ $related->name }}
                                            </a>
                                        </h6>
                                        <div class="text-danger fw-bold small">
                                            {{ number_format($related->sale_price ?: $related->price, 0, ',', '.') }}đ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Không có sản phẩm liên quan.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
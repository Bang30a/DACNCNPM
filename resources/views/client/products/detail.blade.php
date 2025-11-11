@extends('client.layout')
@section('title', $product->name . ' - Computer Shop')

@section('content')
    {{-- PHẦN THÔNG BÁO THÊM VÀO --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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

            {{-- === (CẬP NHẬT MỞ RỘNG) HIỂN THỊ THÔNG SỐ ĐỘNG === --}}
            <ul class="list-unstyled mb-4">
                {{-- 1. Thông số Laptop/PC --}}
                @if($product->cpu) <li><i class="bi bi-cpu me-2"></i> <strong>CPU:</strong> {{ $product->cpu }}</li> @endif
                @if($product->ram) <li><i class="bi bi-memory me-2"></i> <strong>RAM:</strong> {{ $product->ram }}</li> @endif
                @if($product->storage) <li><i class="bi bi-hdd me-2"></i> <strong>Ổ cứng:</strong> {{ $product->storage }}</li> @endif
                @if($product->vga) <li><i class="bi bi-gpu-card me-2"></i> <strong>VGA:</strong> {{ $product->vga }}</li> @endif
                @if($product->screen) <li><i class="bi bi-display me-2"></i> <strong>Màn hình:</strong> {{ $product->screen }}</li> @endif

                {{-- 2. Thông số Màn hình --}}
                @if($product->spec_screen_size) <li><i class="bi bi-display me-2"></i> <strong>Kích thước:</strong> {{ $product->spec_screen_size }}</li> @endif
                @if($product->spec_refresh_rate) <li><i class="bi bi-speedometer2 me-2"></i> <strong>Tần số quét:</strong> {{ $product->spec_refresh_rate }}</li> @endif
                @if($product->spec_panel_type) <li><i class="bi bi-grid me-2"></i> <strong>Tấm nền:</strong> {{ $product->spec_panel_type }}</li> @endif

                {{-- 3. Thông số RAM/Ổ cứng/Linh kiện --}}
                @if($product->spec_type) <li><i class="bi bi-tags me-2"></i> <strong>Loại:</strong> {{ $product->spec_type }}</li> @endif
                @if($product->spec_capacity) <li><i class="bi bi-sd-card me-2"></i> <strong>Dung lượng:</strong> {{ $product->spec_capacity }}</li> @endif
                @if($product->spec_speed) <li><i class="bi bi-activity me-2"></i> <strong>Tốc độ:</strong> {{ $product->spec_speed }}</li> @endif

                {{-- 4. Thông số Gear --}}
                @if($product->spec_connection_type) <li><i class="bi bi-plugin me-2"></i> <strong>Kết nối:</strong> {{ $product->spec_connection_type }}</li> @endif
                @if($product->spec_dpi) <li><i class="bi bi-mouse me-2"></i> <strong>DPI:</strong> {{ $product->spec_dpi }}</li> @endif
                @if($product->spec_switch_type) <li><i class="bi bi-keyboard me-2"></i> <strong>Switch:</strong> {{ $product->spec_switch_type }}</li> @endif

                {{-- 5. (MỚI) Thông số Apple / Tablet --}}
                @if($product->spec_chip) <li><i class="bi bi-cpu me-2"></i> <strong>Chip:</strong> {{ $product->spec_chip }}</li> @endif
                @if($product->spec_screen_info) <li><i class="bi bi-display me-2"></i> <strong>Màn hình:</strong> {{ $product->spec_screen_info }}</li> @endif
                @if($product->spec_ram_options) <li><i class="bi bi-memory me-2"></i> <strong>RAM:</strong> {{ $product->spec_ram_options }}</li> @endif
                @if($product->spec_storage_options) <li><i class="bi bi-hdd me-2"></i> <strong>Bộ nhớ:</strong> {{ $product->spec_storage_options }}</li> @endif
                
                {{-- 6. (MỚI) Thông số Thiết bị văn phòng --}}
                @if($product->spec_function) <li><i class="bi bi-printer me-2"></i> <strong>Chức năng:</strong> {{ $product->spec_function }}</li> @endif
                @if($product->spec_print_speed) <li><i class="bi bi-speedometer2 me-2"></i> <strong>Tốc độ in:</strong> {{ $product->spec_print_speed }}</li> @endif
                @if($product->spec_paper_size) <li><i class="bi bi-file-earmark me-2"></i> <strong>Khổ giấy:</strong> {{ $product->spec_paper_size }}</li> @endif

                {{-- 7. (MỚI) Thông số Thiết bị mạng --}}
                @if($product->spec_wifi_standard) <li><i class="bi bi-wifi me-2"></i> <strong>Chuẩn Wi-Fi:</strong> {{ $product->spec_wifi_standard }}</li> @endif
                @if($product->spec_ports) <li><i class="bi bi-ethernet me-2"></i> <strong>Cổng:</strong> {{ $product->spec_ports }}</li> @endif
                @if($product->spec_antenna) <li><i class="bi bi-reception-4 me-2"></i> <strong>Ăng ten:</strong> {{ $product->spec_antenna }}</li> @endif
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

    {{-- Phần Mô tả (giữ nguyên) --}}
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="border-bottom pb-2 mb-3">Mô tả sản phẩm</h3>
            <div class="bg-white p-4 shadow-sm rounded">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    </div>

    {{-- Phần Đánh giá (giữ nguyên) --}}
    <div class="row mb-5" id="reviews">
        <div class="col-12">
            <h3 class="border-bottom pb-2 mb-3">Đánh giá của khách hàng</h3>

            <!-- Form gửi đánh giá -->
            <div class="card shadow-sm border-0 p-4 mb-4">
                <h4 class="fw-semibold mb-4">Viết đánh giá của bạn</h4>
                
                <form id="review-form" action="{{ route('reviews.store', ['productId' => $product->id]) }}" method="POST">
                    @csrf 
                    <div class="mb-3">
                        <label for="reviewer-name" class="form-label">Tên của bạn</label>
                        <input type="text" id="reviewer-name" name="reviewer_name" value="{{ auth()->user()->name ?? old('reviewer_name') }}" required
                            class="form-control @error('reviewer_name') is-invalid @enderror">
                        @error('reviewer_name') 
                            <span class="invalid-feedback">{{ $message }}</span> 
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="rating" class="form-label">Đánh giá</label>
                        <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
                            <option value="5" @if(old('rating') == 5) selected @endif>5 Sao ★★★★★</option>
                            <option value="4" @if(old('rating') == 4) selected @endif>4 Sao ★★★★☆</option>
                            <option value="3" @if(old('rating') == 3) selected @endif>3 Sao ★★★☆☆</option>
                            <option value="2" @if(old('rating') == 2) selected @endif>2 Sao ★★☆☆☆</option>
                            <option value="1" @if(old('rating') == 1) selected @endif>1 Sao ★☆☆☆☆</option>
                        </select>
                        @error('rating') 
                            <span class="invalid-feedback">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Bình luận</label>
                        <textarea id="comment" name="comment" rows="4" required
                            class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                        @error('comment') 
                            <span class="invalid-feedback">{{ $message }}</span> 
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Gửi đánh giá
                    </button>
                </form>
            </div>

            <!-- Danh sách đánh giá -->
            <div id="review-list">
                @forelse ($product->reviews as $review)
                    <div class="card shadow-sm border-0 p-3 mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <span class="fw-bold me-3">{{ $review->reviewer_name ?? $review->user->name }}</span>
                            <span class="text-warning">
                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                            </span>
                        </div>
                        <p class="text-dark">{{ $review->comment }}</p>
                        <p class="text-muted small mt-2 mb-0">{{ $review->created_at->format('d/m/Y H:i') }}</T>
                    </div>
                @empty
                    <p class="text-muted">Chưa có đánh giá nào cho sản phẩm này.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
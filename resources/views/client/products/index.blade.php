@extends('client.layout')
@section('title', 'Cửa hàng')

@section('content')
<div class="row">
    <div class="col-lg-3 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">BỘ LỌC TÌM KIẾM</div>
            <div class="card-body">
                <form action="{{ route('client.shop') }}" method="GET">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Từ khóa</label>
                        <input type="text" class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="Tìm tên sản phẩm...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Danh mục</label>
                        <select class="form-select" name="category">
                            <option value="all">Tất cả danh mục</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Thương hiệu</label>
                        <select class="form-select" name="brand">
                            <option value="all">Tất cả thương hiệu</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                     <div class="mb-3">
                        <label class="form-label fw-bold small">Khoảng giá</label>
                        <div class="d-flex gap-2">
                            <input type="number" class="form-control" name="price_min" value="{{ request('price_min') }}" placeholder="Từ">
                            <input type="number" class="form-control" name="price_max" value="{{ request('price_max') }}" placeholder="Đến">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Lọc sản phẩm</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="m-0 text-muted">Hiển thị {{ $products->firstItem() }}-{{ $products->lastItem() }} trên {{ $products->total() }} sản phẩm</p>
            <form id="sortForm" action="{{ route('client.shop') }}" method="GET" class="d-flex align-items-center">
                @foreach(request()->except(['sort', 'page']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <label class="me-2 text-muted small text-nowrap">Sắp xếp theo:</label>
                <select class="form-select form-select-sm" name="sort" onchange="document.getElementById('sortForm').submit()">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                </select>
            </form>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @forelse($products as $product)
            <div class="col">
                <div class="card h-100 card-product border-0 shadow-sm">
                    <div class="position-relative text-center p-3" style="height: 200px; background: #f8f9fa;">
                        @if($product->thumbnail)
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid h-100" style="object-fit: contain;" alt="{{ $product->name }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 text-muted">No Image</div>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column p-3">
                        <small class="text-muted">{{ $product->category->name ?? '' }}</small>
                        <h6 class="card-title text-truncate">
                            <a href="{{ route('client.product.detail', $product->slug) }}" class="text-decoration-none text-dark stretched-link">{{ $product->name }}</a>
                        </h6>
                        <div class="mt-auto">
                             <span class="fw-bold text-primary">{{ number_format($product->sale_price ?: $product->price, 0, ',', '.') }}đ</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">Không tìm thấy sản phẩm nào phù hợp.</div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
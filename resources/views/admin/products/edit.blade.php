@extends('admin.layout')
@section('title', 'Sửa Sản phẩm')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Sửa sản phẩm: {{ $product->name }}</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary">Quay lại</a>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required value="{{ old('name', $product->name) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả chi tiết</label>
                            <textarea class="form-control" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Thông số kỹ thuật</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CPU</label>
                                <input type="text" class="form-control" name="cpu" value="{{ old('cpu', $product->cpu) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">RAM</label>
                                <input type="text" class="form-control" name="ram" value="{{ old('ram', $product->ram) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ổ cứng</label>
                                <input type="text" class="form-control" name="storage" value="{{ old('storage', $product->storage) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">VGA</label>
                                <input type="text" class="form-control" name="vga" value="{{ old('vga', $product->vga) }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Màn hình</label>
                                <input type="text" class="form-control" name="screen" value="{{ old('screen', $product->screen) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                            <select class="form-select" name="category_id" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thương hiệu <span class="text-danger">*</span></label>
                            <select class="form-select" name="brand_id" required>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Giá & Kho hàng</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">SKU <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="sku" required value="{{ old('sku', $product->sku) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá niêm yết <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="price" required value="{{ old('price', $product->price) }}" min="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá khuyến mãi</label>
                            <input type="number" class="form-control" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" min="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tồn kho</label>
                            <input type="number" class="form-control" name="quantity" value="{{ old('quantity', $product->quantity) }}" min="0">
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Ảnh đại diện</div>
                    <div class="card-body">
                        @if($product->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-thumbnail" width="100%">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="thumbnail" accept="image/*">
                        <div class="form-text">Chỉ chọn nếu muốn thay đổi ảnh hiện tại.</div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg mb-5">Cập nhật sản phẩm</button>
    </form>
@endsection
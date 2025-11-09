@extends('admin.layout')
@section('title', 'Thêm Sản phẩm mới')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Thêm Sản phẩm mới</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary">Quay lại</a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả chi tiết</label>
                            <textarea class="form-control" name="description" rows="5">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Thông số kỹ thuật (Để lọc)</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CPU</label>
                                <input type="text" class="form-control" name="cpu" value="{{ old('cpu') }}" placeholder="VD: Core i5 12500H">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">RAM</label>
                                <input type="text" class="form-control" name="ram" value="{{ old('ram') }}" placeholder="VD: 8GB DDR4">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ổ cứng</label>
                                <input type="text" class="form-control" name="storage" value="{{ old('storage') }}" placeholder="VD: 512GB SSD NVMe">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">VGA</label>
                                <input type="text" class="form-control" name="vga" value="{{ old('vga') }}" placeholder="VD: RTX 3050 4GB">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Màn hình</label>
                                <input type="text" class="form-control" name="screen" value="{{ old('screen') }}" placeholder="VD: 15.6 inch FHD 144Hz">
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
                                <option value="1" selected>Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                            <select class="form-select" name="category_id" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thương hiệu <span class="text-danger">*</span></label>
                            <select class="form-select" name="brand_id" required>
                                <option value="">-- Chọn thương hiệu --</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Giá & Kho hàng</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Mã sản phẩm (SKU) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="sku" required value="{{ old('sku') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá niêm yết <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="price" required value="{{ old('price') }}" min="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá khuyến mãi</label>
                            <input type="number" class="form-control" name="sale_price" value="{{ old('sale_price') }}" min="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số lượng tồn kho</label>
                            <input type="number" class="form-control" name="quantity" value="{{ old('quantity', 0) }}" min="0">
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Ảnh đại diện</div>
                    <div class="card-body">
                        <input type="file" class="form-control" name="thumbnail" accept="image/*" required>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg mb-5">Lưu sản phẩm</button>
    </form>
@endsection
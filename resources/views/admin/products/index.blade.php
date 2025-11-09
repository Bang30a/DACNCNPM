@extends('admin.layout')

@section('title', 'Danh sách Sản phẩm')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Danh sách Sản phẩm</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                + Thêm mới
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>
                    <th>Kho</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->thumbnail)
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" width="50" alt="{{ $product->name }}">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        {{ $product->name }}<br>
                        <small class="text-muted">SKU: {{ $product->sku }}</small>
                    </td>
                    <td>
                        @if($product->sale_price)
                            <del>{{ number_format($product->price) }}đ</del><br>
                            <strong class="text-danger">{{ number_format($product->sale_price) }}đ</strong>
                        @else
                            {{ number_format($product->price) }}đ
                        @endif
                    </td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>{{ $product->brand->name ?? 'N/A' }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        @if($product->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
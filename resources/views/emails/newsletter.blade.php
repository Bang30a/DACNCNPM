<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .header { background: #0d6efd; color: white; padding: 15px; text-align: center; border-radius: 8px 8px 0 0; }
        .product { display: flex; padding: 15px 0; border-bottom: 1px solid #eee; align-items: center; }
        /* Style cho ảnh sản phẩm */
        .product img { 
            width: 80px; 
            height: 80px; 
            object-fit: contain; 
            margin-right: 15px; 
            border: 1px solid #eee; 
            border-radius: 4px; 
            background-color: #f9f9f9;
        }
        .btn { background: #0d6efd; color: white; padding: 10px 20px; text-decoration: none; display: inline-block; margin-top: 20px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🎁 Ưu Đãi Dành Riêng Cho Bạn!</h2>
        </div>
        <p>Xin chào,</p>
        <p>Cảm ơn bạn đã đăng ký nhận tin từ Computer Shop. Dưới đây là top sản phẩm đang giảm giá sốc tuần này:</p>
        
        @foreach($products as $product)
            <div class="product">
                {{-- LOGIC HIỂN THỊ ẢNH: Sử dụng $message->embed() để đính kèm ảnh vào nội dung mail --}}
                @if($product->thumbnail && file_exists(public_path('storage/' . $product->thumbnail)))
                    <img src="{{ $message->embed(public_path('storage/' . $product->thumbnail)) }}" alt="{{ $product->name }}">
                @elseif($product->image_url)
                     {{-- Nếu là link ảnh online thì dùng trực tiếp --}}
                     <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                @else
                    {{-- Ảnh mặc định online --}}
                    <img src="https://via.placeholder.com/150?text=No+Image" alt="No Image">
                @endif

                <div>
                    <h4 style="margin: 0 0 5px; color: #333;">{{ $product->name }}</h4>
                    <strong style="color: #dc3545; font-size: 16px;">{{ number_format($product->sale_price ?? $product->price) }}đ</strong>
                    @if($product->sale_price)
                        <del style="color: #999; font-size: 12px; margin-left: 5px;">{{ number_format($product->price) }}đ</del>
                    @endif
                    <br>
                    <a href="{{ route('client.product.detail', $product->slug) }}" style="font-size: 13px; color: #0d6efd; text-decoration: none; margin-top: 5px; display: inline-block;">Xem chi tiết >></a>
                </div>
            </div>
        @endforeach

        <div style="text-align: center;">
            <p>Nhập mã <strong>WELCOME2025</strong> để giảm thêm 5% bạn nhé!</p>
            <a href="{{ route('home') }}" class="btn">Mua Ngay Kẻo Lỡ</a>
        </div>
        
        <div style="margin-top: 20px; font-size: 11px; color: #888; text-align: center; border-top: 1px solid #eee; padding-top: 10px;">
            &copy; 2025 Computer Shop. All rights reserved.
        </div>
    </div>
</body>
</html>
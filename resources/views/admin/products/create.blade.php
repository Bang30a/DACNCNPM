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
                {{-- Thông tin chung --}}
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

                {{-- === (MỚI) KHỐI THÔNG SỐ ĐỘNG === --}}

                <!-- 1. Khối Laptop / PC -->
                <div class="card mb-3 spec-group" id="spec-group-computer" style="display: none;">
                    <div class="card-header">Thông số Laptop / PC</div>
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
                                <label class="form-label">Màn hình (của Laptop/PC)</label>
                                <input type="text" class="form-control" name="screen" value="{{ old('screen') }}" placeholder="VD: 15.6 inch FHD 144Hz">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Khối Màn hình -->
                <div class="card mb-3 spec-group" id="spec-group-monitor" style="display: none;">
                    <div class="card-header">Thông số Màn hình</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kích thước</label>
                                <input type="text" class="form-control" name="spec_screen_size" value="{{ old('spec_screen_size') }}" placeholder="VD: 24 inch, 27 inch">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tần số quét</label>
                                <input type="text" class="form-control" name="spec_refresh_rate" value="{{ old('spec_refresh_rate') }}" placeholder="VD: 144Hz, 165Hz">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tấm nền</label>
                                <input type="text" class="form-control" name="spec_panel_type" value="{{ old('spec_panel_type') }}" placeholder="VD: IPS, VA, TN">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Khối Linh kiện (RAM, Ổ cứng) -->
                <div class="card mb-3 spec-group" id="spec-group-ram-storage" style="display: none;">
                    <div class="card-header">Thông số Linh kiện (RAM, Ổ cứng)</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Loại</label>
                                <input type="text" class="form-control" name="spec_type" value="{{ old('spec_type') }}" placeholder="VD: DDR4, DDR5, SSD NVMe Gen 4">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Dung lượng</label>
                                <input type="text" class="form-control" name="spec_capacity" value="{{ old('spec_capacity') }}" placeholder="VD: 8GB, 16GB, 512GB, 1TB">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">Tốc độ (nếu có)</label>
                                <input type="text" class="form-control" name="spec_speed" value="{{ old('spec_speed') }}" placeholder="VD: 3200MHz, 7000MB/s">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Khối Gaming Gear (Chuột, Phím) -->
                <div class="card mb-3 spec-group" id="spec-group-gear" style="display: none;">
                    <div class="card-header">Thông số Gaming Gear (Chuột, Phím)</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kiểu kết nối</label>
                                <input type="text" class="form-control" name="spec_connection_type" value="{{ old('spec_connection_type') }}" placeholder="VD: Không dây, Có dây, Bluetooth">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">DPI (cho chuột)</label>
                                <input type="text" class="form-control" name="spec_dpi" value="{{ old('spec_dpi') }}" placeholder="VD: 16000 DPI">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Loại Switch (cho phím)</label>
                                <input type="text" class="form-control" name="spec_switch_type" value="{{ old('spec_switch_type') }}" placeholder="VD: Red Switch, Brown Switch">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- 5. (MỚI) Khối Apple / Máy tính bảng -->
                <div class="card mb-3 spec-group" id="spec-group-apple" style="display: none;">
                    <div class="card-header">Thông số Apple / Máy tính bảng</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Chip</label>
                                <input type="text" class="form-control" name="spec_chip" value="{{ old('spec_chip') }}" placeholder="VD: Apple M2, Snapdragon 8 Gen 2">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Màn hình</label>
                                <input type="text" class="form-control" name="spec_screen_info" value="{{ old('spec_screen_info') }}" placeholder="VD: 11 inch Liquid Retina">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">RAM</label>
                                <input type="text" class="form-control" name="spec_ram_options" value="{{ old('spec_ram_options') }}" placeholder="VD: 8GB, 16GB">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Bộ nhớ trong</label>
                                <input type="text" class="form-control" name="spec_storage_options" value="{{ old('spec_storage_options') }}" placeholder="VD: 128GB, 256GB">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- 6. (MỚI) Khối Thiết bị văn phòng (Máy in...) -->
                <div class="card mb-3 spec-group" id="spec-group-office" style="display: none;">
                    <div class="card-header">Thông số Thiết bị văn phòng</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Chức năng</label>
                                <input type="text" class="form-control" name="spec_function" value="{{ old('spec_function') }}" placeholder="VD: In, Scan, Copy, Fax">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tốc độ in</LAbel>
                                <input type="text" class="form-control" name="spec_print_speed" value="{{ old('spec_print_speed') }}" placeholder="VD: 20 trang/phút">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Khổ giấy</label>
                                <input type="text" class="form-control" name="spec_paper_size" value="{{ old('spec_paper_size') }}" placeholder="VD: A4, A3">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 7. (MỚI) Khối Thiết bị mạng (Router...) -->
                <div class="card mb-3 spec-group" id="spec-group-network" style="display: none;">
                    <div class="card-header">Thông số Thiết bị mạng</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Chuẩn Wi-Fi</label>
                                <input type="text" class="form-control" name="spec_wifi_standard" value="{{ old('spec_wifi_standard') }}" placeholder="VD: Wi-Fi 6 (802.11ax)">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số cổng</label>
                                <input type="text" class="form-control" name="spec_ports" value="{{ old('spec_ports') }}" placeholder="VD: 4x LAN 1Gbps, 1x WAN 1Gbps">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ăng ten</label>
                                <input type="text" class="form-control" name="spec_antenna" value="{{ old('spec_antenna') }}" placeholder="VD: 4 ăng ten 5dBi">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Cột bên phải (Giá, Danh mục, Ảnh) --}}
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
                            <select class="form-select" name="category_id" id="category-select" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thương hiệu <span class="text-danger">*</span></label>
                            <select class="form-select" name="brand_id" required>
                                <option value="">-- Chọn thương hiệu --</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
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
                        <input type="file" class="form-control" name="thumbnail" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg mb-5">Lưu sản phẩm</button>
    </form>
@endsection

{{-- === (PHẦN JS ĐÃ SỬA LỖI "LỆCH" THEO ID CHÍNH XÁC) === --}}
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // --- (ĐÃ SỬA LẠI ID THEO ẢNH 'image_31acc4.png') ---
        
        // ID 2, 3, 7: Laptop VP, Laptop Game, PC Đồng bộ
        const computerCategoryIds = ['2', '3', '7']; 
        
        // ID 9: Màn hình máy tính
        const monitorCategoryIds = ['9']; 
        
        // ID 8, 12: Linh kiện, Thiết bị lưu trữ
        const ramStorageCategoryIds = ['8', '12'];
        
        // ID 10: Gaming Gear
        const gearCategoryIds = ['10'];

        // ID 5, 6: Apple, Máy tính bảng
        const appleCategoryIds = ['5', '6'];
        
        // ID 11: Thiết bị văn phòng
        const officeCategoryIds = ['11'];
        
        // ID 13: Thiết bị mạng
        const networkCategoryIds = ['13'];
        // --- HẾT PHẦN CÀI ĐẶT ---

        const categorySelect = document.getElementById('category-select');
        const specGroups = document.querySelectorAll('.spec-group');

        function toggleSpecGroups() {
            if (!categorySelect) return;
            
            const selectedCategoryId = categorySelect.value;
            
            // Ẩn tất cả các khối
            specGroups.forEach(group => {
                group.style.display = 'none';
            });

            // Hiển thị khối tương ứng
            if (computerCategoryIds.includes(selectedCategoryId)) {
                document.getElementById('spec-group-computer').style.display = 'block';
            } else if (monitorCategoryIds.includes(selectedCategoryId)) {
                document.getElementById('spec-group-monitor').style.display = 'block';
            } else if (ramStorageCategoryIds.includes(selectedCategoryId)) {
                document.getElementById('spec-group-ram-storage').style.display = 'block';
            } else if (gearCategoryIds.includes(selectedCategoryId)) {
                document.getElementById('spec-group-gear').style.display = 'block';
            } else if (appleCategoryIds.includes(selectedCategoryId)) {
                document.getElementById('spec-group-apple').style.display = 'block';
            } else if (officeCategoryIds.includes(selectedCategoryId)) {
                document.getElementById('spec-group-office').style.display = 'block';
            } else if (networkCategoryIds.includes(selectedCategoryId)) {
                document.getElementById('spec-group-network').style.display = 'block';
            }
        }

        // 1. Chạy 1 lần khi trang tải (để xử lý 'old value' nếu có)
        toggleSpecGroups();

        // 2. Chạy mỗi khi người dùng thay đổi danh mục
        categorySelect.addEventListener('change', toggleSpecGroups);
    });
</script>
@endsection
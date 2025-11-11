<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import Str

class Product extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     * Tự động tạo slug khi tạo/cập nhật sản phẩm.
     */
    protected static function booted()
    {
        static::saving(function ($product) {
            $product->slug = Str::slug($product->name, '-');
        });
    }

    // (CẬP NHẬT MỞ RỘNG)
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'thumbnail',
        'description',
        'price',
        'sale_price',
        'quantity',
        'status',
        'category_id',
        'brand_id',
        
        // 1. Thông số Laptop/PC
        'cpu',
        'ram',
        'storage',
        'vga',
        'screen',

        // 2. Thông số chung (Linh kiện, Gear...)
        'spec_type',
        'spec_capacity',
        'spec_speed',
        'spec_connection_type',

        // 3. Thông số Màn hình
        'spec_screen_size',
        'spec_refresh_rate',
        'spec_panel_type',

        // 4. Thông số Gaming Gear
        'spec_dpi',
        'spec_switch_type',

        // 5. (MỚI) Thông số Apple / Máy tính bảng
        'spec_chip',
        'spec_storage_options',
        'spec_ram_options',
        'spec_screen_info',

        // 6. (MỚI) Thông số Thiết bị văn phòng
        'spec_function',
        'spec_print_speed',
        'spec_paper_size',

        // 7. (MỚI) Thông số Thiết bị mạng
        'spec_wifi_standard',
        'spec_ports',
        'spec_antenna',
    ];

    /**
     * Lấy danh mục của sản phẩm.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Lấy thương hiệu của sản phẩm.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Lấy tất cả các đánh giá của sản phẩm.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Khai báo các trường được phép gán dữ liệu hàng loạt (Mass Assignment)
    protected $fillable = [
        'brand_id', 'category_id', 'name', 'slug', 'sku', 'thumbnail',
        'price', 'sale_price', 'quantity', 'description', 'status',
        'cpu', 'ram', 'storage', 'vga', 'screen'
    ];

    // Quan hệ: Sản phẩm thuộc về 1 Thương hiệu
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Quan hệ: Sản phẩm thuộc về 1 Danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
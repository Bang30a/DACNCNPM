<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; // <-- Đã thêm
use App\Models\Brand;    // <-- Đã thêm
use Illuminate\Http\Request; // <-- Đã thêm

class ProductController extends Controller
{
    /**
     * HÀM MỚI BỊ THIẾU
     * Hiển thị trang Cửa hàng (Shop) + Lọc sản phẩm
     */
    public function index(Request $request)
    {
        // 1. Khởi tạo query lấy sản phẩm đang hiển thị
        $query = Product::where('status', 1);

        // 2. Xử lý tìm kiếm theo tên
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 3. Xử lý lọc theo danh mục
        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        // 4. Xử lý lọc theo thương hiệu
        if ($request->filled('brand') && $request->brand != 'all') {
            $query->where('brand_id', $request->brand);
        }

        // 5. Xử lý lọc theo giá
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // 6. Sắp xếp
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc'); // Mặc định mới nhất
        }

        // 7. Lấy dữ liệu và phân trang
        $products = $query->with(['category'])->paginate(12)->withQueryString();

        // Lấy danh sách cho sidebar lọc
        $categories = Category::all();
        $brands = Brand::all();

        return view('client.products.index', compact('products', 'categories', 'brands'));
    }


    /**
     * HÀM CŨ CỦA BẠN (Giữ nguyên)
     * Hiển thị trang Chi tiết sản phẩm
     */
    public function detail($slug)
    {
        // Tìm sản phẩm theo slug
        $product = Product::where('slug', $slug)
                          ->where('status', 1)
                          ->with(['category', 'brand'])
                          ->firstOrFail();

        // Lấy thêm sản phẩm liên quan
        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->where('status', 1)
                                  ->take(4)
                                  ->get();

        return view('client.products.detail', compact('product', 'relatedProducts'));
    }
}
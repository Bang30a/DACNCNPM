<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; 
use App\Models\Brand; 
use App\Models\Review;
use Illuminate\Support\Facades\Auth;   
use Illuminate\Http\Request; 

class ProductController extends Controller
{
    /**
     * HÀM MỚI BỊ THIẾU (ĐÃ GIỮ LẠI)
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
     * HÀM CỦA BẠN (ĐÃ SỬA LỖI ĐỂ TẢI REVIEWS)
     * Hiển thị trang Chi tiết sản phẩm
     */
    public function detail($slug)
    {
        // Tìm sản phẩm theo slug
        // *** ĐÂY LÀ PHẦN SỬA LỖI QUAN TRỌNG ***
        // Kết hợp logic của bạn (lấy product) VỚI logic của tôi (lấy reviews)
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->with([
                'category', 
                'brand', 
                'reviews' => function ($query) { // Tải đánh giá
                    $query->latest(); 
                }, 
                'reviews.user' // Tải user của đánh giá
            ])
            ->firstOrFail();

        // Lấy thêm sản phẩm liên quan (Logic này của bạn, giữ nguyên)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->take(4)
            ->get();

        // Trả về view với CẢ HAI biến
        return view('client.products.detail', compact('product', 'relatedProducts'));
    }

    // *** ĐÃ XÓA HÀM show($id) BỊ TRÙNG LẶP ***
    // Hàm show($id) bạn dán vào bị trùng lặp với hàm detail($slug)
    // và routes/web.php của bạn đang dùng 'detail($slug)',
    // nên tôi đã xóa hàm show($id) thừa đó đi.

    /**
     * HÀM CỦA BẠN (GIỮ NGUYÊN)
     * Lưu một đánh giá mới cho sản phẩm.
     */
    public function storeReview(Request $request, $productId)
    {
        // Xác thực dữ liệu form
        $request->validate([
            'reviewer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // Lấy thông tin user đã đăng nhập
        $userId = Auth::id(); 

        if (!$userId) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để đánh giá.');
        }

        Review::create([
            'product_id' => $productId,
            'user_id' => $userId,
            'reviewer_name' => $request->reviewer_name,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Quay lại trang sản phẩm với thông báo thành công
        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá!');
    }
}
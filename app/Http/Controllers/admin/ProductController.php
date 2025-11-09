<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; 
use App\Models\Brand;    
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // with(['category', 'brand']): Kỹ thuật Eager Loading giúp truy vấn nhanh hơn
    $products = Product::with(['category', 'brand'])->orderBy('id', 'desc')->paginate(10); // Dùng paginate để phân trang nếu nhiều sp
    return view('admin.products.index', compact('products'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Lấy danh mục và thương hiệu để hiển thị trong thẻ <select>
    $categories = Category::all();
    $brands = Brand::all();
    return view('admin.products.create', compact('categories', 'brands'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // 1. Validate dữ liệu (Rất quan trọng)
    $request->validate([
        'name' => 'required|max:255|unique:products,name',
        'sku' => 'required|unique:products,sku',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
        'thumbnail' => 'required|image|max:2048', // Bắt buộc có ảnh đại diện
        // Các trường khác có thể nullable nên không cần validate chặt
    ], [
        'name.required' => 'Vui lòng nhập tên sản phẩm.',
        'name.unique' => 'Tên sản phẩm đã tồn tại.',
        'sku.required' => 'Vui lòng nhập mã SKU.',
        'sku.unique' => 'Mã SKU đã tồn tại.',
        'price.required' => 'Vui lòng nhập giá bán.',
        'category_id.required' => 'Vui lòng chọn danh mục.',
        'brand_id.required' => 'Vui lòng chọn thương hiệu.',
        'thumbnail.required' => 'Vui lòng chọn ảnh đại diện.',
        'thumbnail.image' => 'File phải là hình ảnh.',
    ]);

    // 2. Chuẩn bị dữ liệu để lưu
    $data = $request->all();
    $data['slug'] = Str::slug($request->name);

    // 3. Xử lý upload ảnh đại diện
    if ($request->hasFile('thumbnail')) {
        $path = $request->file('thumbnail')->store('products/thumbnails', 'public');
        $data['thumbnail'] = $path;
    }

    // 4. Lưu vào database
    Product::create($data);

    // 5. Chuyển hướng về trang danh sách
    return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $product = Product::findOrFail($id);
    // Lấy danh sách danh mục và thương hiệu để hiển thị lại trong select box
    $categories = Category::all();
    $brands = Brand::all();

    return view('admin.products.edit', compact('product', 'categories', 'brands'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);

    // Validate (chú ý phần unique cho name và sku phải trừ chính sản phẩm hiện tại ra)
    $request->validate([
        'name' => 'required|max:255|unique:products,name,' . $id,
        'sku' => 'required|unique:products,sku,' . $id,
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
        'thumbnail' => 'nullable|image|max:2048', // Ảnh lúc update là nullable (không bắt buộc)
    ]);

    $data = $request->all();
    // Chỉ tạo slug mới nếu tên sản phẩm thay đổi
    if ($request->name !== $product->name) {
        $data['slug'] = Str::slug($request->name);
    }

    // Xử lý ảnh đại diện mới
    if ($request->hasFile('thumbnail')) {
        // Xóa ảnh cũ để tránh rác server
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        // Lưu ảnh mới
        $data['thumbnail'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
    } else {
        // Nếu không upload ảnh mới thì giữ nguyên ảnh cũ
        // (Xóa thumbnail khỏi mảng $data để tránh bị ghi đè thành null)
        unset($data['thumbnail']);
    }

    $product->update($data);

    return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $product = Product::findOrFail($id);
    if ($product->thumbnail) {
        Storage::disk('public')->delete($product->thumbnail);
    }
    $product->delete();
    return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
}
}

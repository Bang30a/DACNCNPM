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
        $products = Product::with(['category', 'brand'])->orderBy('id', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     * (ĐÃ CẬP NHẬT MỞ RỘNG)
     */
    public function store(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'name' => 'required|max:255|unique:products,name',
            'sku' => 'required|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'thumbnail' => 'nullable|image|max:2048',
            
            // Validate tất cả các trường (nullable)
            'cpu' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'storage' => 'nullable|string|max:255',
            'vga' => 'nullable|string|max:255',
            'screen' => 'nullable|string|max:255',
            'spec_type' => 'nullable|string|max:255',
            'spec_capacity' => 'nullable|string|max:255',
            'spec_speed' => 'nullable|string|max:255',
            'spec_connection_type' => 'nullable|string|max:255',
            'spec_screen_size' => 'nullable|string|max:255',
            'spec_refresh_rate' => 'nullable|string|max:255',
            'spec_panel_type' => 'nullable|string|max:255',
            'spec_dpi' => 'nullable|string|max:255',
            'spec_switch_type' => 'nullable|string|max:255',

            // (MỚI) Validate các trường mới
            'spec_chip' => 'nullable|string|max:255',
            'spec_storage_options' => 'nullable|string|max:255',
            'spec_ram_options' => 'nullable|string|max:255',
            'spec_screen_info' => 'nullable|string|max:255',
            'spec_function' => 'nullable|string|max:255',
            'spec_print_speed' => 'nullable|string|max:255',
            'spec_paper_size' => 'nullable|string|max:255',
            'spec_wifi_standard' => 'nullable|string|max:255',
            'spec_ports' => 'nullable|string|max:255',
            'spec_antenna' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            'sku.required' => 'Vui lòng nhập mã SKU.',
            'sku.unique' => 'Mã SKU đã tồn tại.',
            'price.required' => 'Vui lòng nhập giá bán.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'brand_id.required' => 'Vui lòng chọn thương hiệu.',
            'thumbnail.image' => 'File phải là hình ảnh.',
        ]);

        // 2. Chuẩn bị dữ liệu
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // 3. Xử lý upload ảnh
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('products/thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        // 4. Lưu vào database
        Product::create($data);

        // 5. Chuyển hướng
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
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     * (ĐÃ CẬP NHẬT MỞ RỘNG)
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // Validate (chú ý unique)
        $request->validate([
            'name' => 'required|max:255|unique:products,name,' . $id,
            'sku' => 'required|unique:products,sku,' . $id,
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'thumbnail' => 'nullable|image|max:2048', 

            // Validate tất cả các trường (nullable)
            'cpu' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'storage' => 'nullable|string|max:255',
            'vga' => 'nullable|string|max:255',
            'screen' => 'nullable|string|max:255',
            'spec_type' => 'nullable|string|max:255',
            'spec_capacity' => 'nullable|string|max:255',
            'spec_speed' => 'nullable|string|max:255',
            'spec_connection_type' => 'nullable|string|max:255',
            'spec_screen_size' => 'nullable|string|max:255',
            'spec_refresh_rate' => 'nullable|string|max:255',
            'spec_panel_type' => 'nullable|string|max:255',
            'spec_dpi' => 'nullable|string|max:255',
            'spec_switch_type' => 'nullable|string|max:255',
            
            // (MỚI) Validate các trường mới
            'spec_chip' => 'nullable|string|max:255',
            'spec_storage_options' => 'nullable|string|max:255',
            'spec_ram_options' => 'nullable|string|max:255',
            'spec_screen_info' => 'nullable|string|max:255',
            'spec_function' => 'nullable|string|max:255',
            'spec_print_speed' => 'nullable|string|max:255',
            'spec_paper_size' => 'nullable|string|max:255',
            'spec_wifi_standard' => 'nullable|string|max:255',
            'spec_ports' => 'nullable|string|max:255',
            'spec_antenna' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        if ($request->name !== $product->name) {
            $data['slug'] = Str::slug($request->name);
        }

        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
        } else {
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
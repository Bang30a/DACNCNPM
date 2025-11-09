<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // 1. Xem giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('client.cart.index', compact('cart', 'total'));
    }

    // 2. Thêm sản phẩm vào giỏ
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Nếu sản phẩm đã có trong giỏ thì tăng số lượng
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Nếu chưa có thì thêm mới
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->sale_price ?: $product->price, // Ưu tiên giá khuyến mãi
                'thumbnail' => $product->thumbnail
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // 3. Cập nhật giỏ hàng (sẽ làm chi tiết sau khi có View)
    public function update(Request $request) { /* ... */ }

    // 4. Xóa sản phẩm khỏi giỏ
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }
}
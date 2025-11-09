<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Để dùng transaction

class OrderController extends Controller
{
    public function index()
{
    $cart = session()->get('cart', []);
    if (count($cart) == 0) {
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Lấy thông tin người dùng đang đăng nhập để điền sẵn vào form
    $user = auth()->user();

    return view('client.checkout.index', compact('cart', 'total', 'user'));
}

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'shipping_address' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Sử dụng DB Transaction để đảm bảo toàn vẹn dữ liệu (lưu cả order và detail cùng lúc)
        try {
            DB::beginTransaction();

            // 1. Tạo đơn hàng
            $order = Order::create([
                'user_id' => auth()->id(), 
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'shipping_address' => $request->shipping_address,
                'note' => $request->note,
                'total_amount' => $total,
                'status' => 0, // Mới đặt
                'payment_method' => $request->payment_method ?? 'COD'
            ]);

            // 2. Lưu chi tiết đơn hàng
            foreach ($cart as $id => $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            DB::commit(); // Xác nhận lưu vào DB

            // 3. Xóa giỏ hàng sau khi đặt thành công
            session()->forget('cart');

            return redirect()->route('checkout.success')->with('success', 'Đặt hàng thành công! Mã đơn hàng #' . $order->id);

        } catch (\Exception $e) {
            DB::rollBack(); // Nếu lỗi thì hủy hết các thao tác trên
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đặt hàng, vui lòng thử lại.');
        }
    }
    // Xem lịch sử đơn hàng
    public function history()
    {
        // Lấy danh sách đơn hàng của user đang đăng nhập, sắp xếp mới nhất lên đầu
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->paginate(10);
        return view('client.orders.index', compact('orders'));
    }

    // Xem chi tiết một đơn hàng
    public function detail($id)
    {
        // Tìm đơn hàng theo ID và đảm bảo nó thuộc về user đang đăng nhập
        $order = Order::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->with('details')
                    ->firstOrFail();

        return view('client.orders.show', compact('order'));
    }
    public function success()
    {
        return view('client.checkout.success');
    }
}
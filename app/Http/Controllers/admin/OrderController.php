<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 1. Danh sách đơn hàng
    public function index()
    {
        // Lấy đơn hàng mới nhất lên đầu
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // 2. Xem chi tiết đơn hàng
    public function show($id)
    {
        // Lấy đơn hàng kèm theo chi tiết sản phẩm (Eager Loading 'details')
        $order = Order::with('details')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // 3. Cập nhật trạng thái đơn hàng
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
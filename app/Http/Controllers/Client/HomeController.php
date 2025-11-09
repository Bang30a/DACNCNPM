<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 8 sản phẩm mới nhất để hiển thị
        $newProducts = Product::where('status', 1) // Chỉ lấy sp đang hiển thị
                              ->orderBy('created_at', 'desc')
                              ->take(8)
                              ->get();

        return view('client.home', compact('newProducts'));
    }
}
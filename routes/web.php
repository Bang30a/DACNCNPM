<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\OrderController; 
use App\Http\Controllers\Admin\OrderController as AdminOrderController; 

/*
|--------------------------------------------------------------------------
| Tuyến đường Client (Front-end)
|--------------------------------------------------------------------------
*/

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Trang chi tiết sản phẩm
Route::get('/san-pham/{slug}', [App\Http\Controllers\Client\ProductController::class, 'detail'])->name('client.product.detail');

// Trang cửa hàng (hiển thị tất cả sp và lọc)
Route::get('/cua-hang', [App\Http\Controllers\Client\ProductController::class, 'index'])->name('client.shop');

// Nhóm route Giỏ hàng
Route::prefix('gio-hang')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/them/{id}', [CartController::class, 'add'])->name('add');
    Route::post('/cap-nhat', [CartController::class, 'update'])->name('update');
    Route::get('/xoa/{id}', [CartController::class, 'remove'])->name('remove');
});

// Nhóm route Thanh toán (Dùng Client\OrderController)
Route::get('/thanh-toan', [OrderController::class, 'index'])->name('checkout.index');
Route::post('/thanh-toan', [OrderController::class, 'store'])->name('checkout.store');
Route::get('/dat-hang-thanh-cong', [OrderController::class, 'success'])->name('checkout.success');

// Route Đăng ký - Đăng nhập - Đăng xuất
Route::get('/dang-ky', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/dang-ky', [AuthController::class, 'register']);
Route::get('/dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'login']);
Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Tuyến đường Admin (Back-end)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () { return view('admin.dashboard'); })->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.update_status');
});
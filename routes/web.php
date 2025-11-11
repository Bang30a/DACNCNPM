<?php

use Illuminate\Support\Facades\Route;

// Import Controller cho Admin
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController; 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReviewController; // <-- THÊM CONTROLLER MỚI
use App\Http\Controllers\Client\AccountController;
// Import Controller cho Client
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController as ClientProductController;


/*
|--------------------------------------------------------------------------
| TUYẾN ĐƯỜNG CLIENT (FRONT-END)
|--------------------------------------------------------------------------
|
| Các route này dành cho khách hàng truy cập website.
|
*/

// --- Các trang công khai (Ai cũng xem được) ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cua-hang', [ClientProductController::class, 'index'])->name('client.shop');
Route::get('/san-pham/{slug}', [ClientProductController::class, 'detail'])->name('client.product.detail');

// === THÊM ROUTE MỚI ĐỂ LƯU ĐÁNH GIÁ ===
Route::post('/san-pham/{productId}/review', [ClientProductController::class, 'storeReview'])->name('reviews.store');
// ======================================

// --- Giỏ hàng (Không cần đăng nhập) ---
Route::prefix('gio-hang')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/them/{id}', [CartController::class, 'add'])->name('add');
    Route::post('/cap-nhat', [CartController::class, 'update'])->name('update');
    Route::get('/xoa/{id}', [CartController::class, 'remove'])->name('remove');
});

// --- Xác thực (Đăng ký, Đăng nhập, Đăng xuất) ---
Route::get('/dang-ky', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/dang-ky', [AuthController::class, 'register']);
Route::get('/dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'login']);
Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');

// --- Các trang yêu cầu đăng nhập (Khách hàng) ---
Route::middleware(['auth'])->group(function () {
    
    // Thanh toán
    Route::get('/thanh-toan', [OrderController::class, 'index'])->name('checkout.index');
    Route::post('/thanh-toan', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/dat-hang-thanh-cong', [OrderController::class, 'success'])->name('checkout.success');
    
    // Lịch sử đơn hàng của tôi (ĐÃ DI CHUYỂN VÀO ĐÂY)
    Route::get('/don-hang-cua-toi', [OrderController::class, 'history'])->name('client.orders.index');
    Route::get('/don-hang-cua-toi/{id}', [OrderController::class, 'detail'])->name('client.orders.show');

    // Route Quản lý Tài khoản (Profile)
    Route::get('/tai-khoan', [AccountController::class, 'index'])->name('client.account.index');
    Route::post('/tai-khoan/cap-nhat-thong-tin', [AccountController::class, 'updateProfile'])->name('client.account.update_profile');
    Route::post('/tai-khoan/doi-mat-khau', [AccountController::class, 'updatePassword'])->name('client.account.update_password');
});


/*
|--------------------------------------------------------------------------
| TUYẾN ĐƯỜNG ADMIN (BACK-END)
|--------------------------------------------------------------------------
|
| Tất cả route quản trị đều được bảo vệ bởi middleware 'auth' và 'admin'.
|
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Quản lý (CRUD)
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);

    // Quản lý Đơn hàng (Admin)
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.update_status');

    // Quản lý Khách hàng (Admin)
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customers.show'); 
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy'); 
    
    // === QUẢN LÝ ĐÁNH GIÁ (MỚI) ===
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    // ================================
    
});
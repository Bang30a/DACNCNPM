<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- ĐĂNG KÝ ---
    public function showRegisterForm()
    {
        return view('client.auth.register');
    }

    public function register(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // confirmed: phải khớp với password_confirmation
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã được đăng ký.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ]);

        // 2. Tạo user mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
            'role' => 0, // Mặc định là khách hàng (0)
        ]);

        // 3. Đăng nhập ngay sau khi đăng ký thành công
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Đăng ký tài khoản thành công!');
    }

    // --- ĐĂNG NHẬP ---
    public function showLoginForm()
    {
        return view('client.auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validate dữ liệu cơ bản
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Thử đăng nhập
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Kiểm tra checkbox "Ghi nhớ đăng nhập"

        if (Auth::attempt($credentials, $remember)) {
            // Đăng nhập thành công
            $request->session()->regenerate(); // Bảo mật session

            // Kiểm tra role: Nếu là admin (role = 1) thì chuyển vào trang admin dashboard
            if (Auth::user()->role == 1) {
                return redirect()->route('admin.dashboard');
            }

            // Nếu là khách hàng thì về trang chủ
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        // 3. Đăng nhập thất bại
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    // --- ĐĂNG XUẤT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Đã đăng xuất!');
    }
}
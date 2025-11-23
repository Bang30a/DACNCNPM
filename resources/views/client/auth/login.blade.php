@extends('client.layout')
@section('title', 'Đăng nhập')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-lg my-5">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Đăng nhập</h2>
                    <p class="text-muted">Chào mừng bạn quay trở lại!</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger text-center mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                        <label for="email">Địa chỉ Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required>
                        <label for="password">Mật khẩu</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">Đăng nhập</button>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        Quên mật khẩu? <a href="{{ route('password.request') }}" class="text-decoration-none fw-bold">Đặt lại ngay</a>
                    </div>
                    <div class="text-center mt-2">
                        Chưa có tài khoản? <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Đăng ký ngay</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
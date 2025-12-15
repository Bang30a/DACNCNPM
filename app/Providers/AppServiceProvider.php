<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- Nhớ thêm dòng này

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ép buộc HTTPS khi chạy trên Production hoặc bất kỳ tên miền nào chứa 'ngrok'
        if($this->app->environment('production') || str_contains(request()->getHost(), 'ngrok')) {
            URL::forceScheme('https');
            
            // Đảm bảo các request nội bộ cũng hiểu là đang dùng HTTPS
            $this->app['request']->server->set('HTTPS', 'on');
        }
    }
}
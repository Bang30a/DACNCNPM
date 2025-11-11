<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // --- BỘ LỌC NGÀY THÁNG ---
        // 1. Lấy ngày bắt đầu và kết thúc từ request
        // Mặc định: 30 ngày gần nhất
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(29);

        // Đảm bảo $endDate luôn lớn hơn $startDate
        if ($startDate->gt($endDate)) {
            $startDate = $endDate->copy()->subDays(29);
        }

        // --- 4 THẺ THỐNG KÊ (Lọc theo ngày) ---
        $totalRevenue = Order::where('status', 2) // Chỉ tính đơn "Hoàn thành"
                            ->whereBetween('updated_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                            ->sum('total_amount');

        $newOrders = Order::where('status', 0) // Chỉ tính đơn "Chờ xác nhận"
                         ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                         ->count();

        // Các thống kê tổng (không lọc theo ngày)
        $totalCustomers = User::where('role', 0)->count();
        $totalProducts = Product::count();

        // --- BIỂU ĐỒ 1: DOANH THU (Lọc theo ngày) ---
        // Lấy doanh thu (đơn hoàn thành) theo từng ngày trong khoảng đã chọn
        $revenueData = Order::select(
                                DB::raw('DATE(updated_at) as date'),
                                DB::raw('SUM(total_amount) as total')
                            )
                            ->where('status', 2)
                            ->whereBetween('updated_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                            ->groupBy('date')
                            ->orderBy('date', 'asc')
                            ->get();
        
        // Chuẩn bị mảng dữ liệu cho biểu đồ (lấp đầy các ngày không có doanh thu)
        $chartLabels = [];
        $chartData = [];
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dateString = $currentDate->format('d/m');
            $chartLabels[] = $dateString;

            // Tìm doanh thu cho ngày này
            $dailyRevenue = $revenueData->firstWhere('date', $currentDate->format('Y-m-d'));
            $chartData[] = $dailyRevenue ? $dailyRevenue->total : 0;
            
            $currentDate->addDay();
        }

        // --- BIỂU ĐỒ 2: TRẠNG THÁI ĐƠN HÀNG (Lọc theo ngày) ---
        $statusCounts = Order::select('status', DB::raw('COUNT(*) as count'))
                            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                            ->groupBy('status')
                            ->get()
                            ->mapWithKeys(function ($item) {
                                return [$item->status => $item->count];
                            });

        $statusData = [
            $statusCounts->get(0, 0), // Chờ xác nhận
            $statusCounts->get(1, 0), // Đang giao
            $statusCounts->get(2, 0), // Hoàn thành
            $statusCounts->get(3, 0), // Đã hủy
        ];
        $statusLabels = ['Chờ xác nhận', 'Đang giao', 'Hoàn thành', 'Đã hủy'];


        // --- ĐƠN HÀNG MỚI NHẤT (Lọc theo ngày) ---
        $recentOrders = Order::whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        // Trả dữ liệu về view
        return view('admin.dashboard', compact(
            'totalRevenue', 
            'newOrders', 
            'totalCustomers', 
            'totalProducts', 
            'recentOrders',
            'chartLabels',
            'chartData',
            'statusLabels',
            'statusData',
            'startDate', // Gửi lại ngày đã chọn để hiển thị trên form
            'endDate'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy ngày hôm nay
        $today = Carbon::now()->toDateString();

        // Truy vấn để lấy tổng doanh thu cho ngày hôm nay
        $revenueToday = Order::whereDate('create_at', $today)->sum('total_price');

        // Tính tổng User
        $totalUsers = User::count();

        // Tính tổng Customer
        $totalCustomers = Customers::count();

        // Tính tổng Product
        $totalProducts = Products::count();

        // Truy vấn để lấy dữ liệu thống kê cho biểu đồ
        $default_start_date = Carbon::now()->startOfMonth();
        $default_end_date = Carbon::now()->endOfMonth();
        $filtered_data = Order::selectRaw('DATE(create_at) as date, COUNT(*) as total_orders, SUM(total_price) as total_revenue')
            ->whereBetween('create_at', [$default_start_date, $default_end_date])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top 10 product
        $bestSeller = Products::select('products.*', DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->join('order_details', 'order_details.product_id', '=', 'products.product_id')
            ->join('orders', 'orders.order_id', '=', 'order_details.order_id')
            // Bạn có thể thêm điều kiện cho orders nếu cần, ví dụ: ->where('orders.status', 'completed')
            ->groupBy(['products.product_id', 'products.cat_id', 'products.product_name', 'products.price', 'products.quantity', 'products.description', 'products.image', 'products.status', 'products.create_at', 'products.update_at'])
            ->orderBy('total_quantity', 'desc')
            ->limit(6)
            ->get();

        // dd($bestSeller);

        // Transaction

        $orderToday = Order::orderByDesc('create_at')->with('orderDetail')->limit(6)->get();

        // dd($orderToday);

        return view('admin.dashboard', compact('revenueToday', 'totalUsers', 'totalCustomers', 'totalProducts', 'filtered_data', 'bestSeller','orderToday'));
    }

    public function filterStatistical(Request $request)
    {
        // Lấy ngày bắt đầu và kết thúc
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        // Truy vấn để lấy tổng số đơn hàng và tổng doanh thu cho mỗi ngày trong khoảng thời gian
        $filtered_data = Order::selectRaw('DATE(create_at) as date, COUNT(*) as total_orders, SUM(total_price) as total_revenue')
            ->whereBetween('create_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Lấy ngày hôm nay
        $today = Carbon::now()->toDateString();

        // Truy vấn để lấy tổng doanh thu cho ngày hôm nay
        $revenueToday = Order::whereDate('create_at', $today)->sum('total_price');

        // Tính tổng User
        $totalUsers = User::count();

        // Tính tổng Customer
        $totalCustomers = Customers::count();

        // Tính tổng Product
        $totalProducts = Products::count();

        return view('admin.dashboard', compact('revenueToday', 'totalUsers', 'totalCustomers', 'totalProducts', 'filtered_data'));
    }
}

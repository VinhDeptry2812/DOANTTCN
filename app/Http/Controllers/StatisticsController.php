<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Order;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        // Tổng số đơn hàng
        $total_orders = Order::count();
        $filter = $request->get('filter', 'day'); // default theo day
        // Thống kê số đơn hàng theo trạng thái
        $orders_status = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status'); // ['pending' => 10, 'confirmed' => 5...]
        // Tổng đơn hàng theo filter
        switch ($filter) {
            case 'day':
                $total_orders_filtered = Order::select(DB::raw('DATE(created_at) as date'))
                    ->whereDate('created_at', today())
                    ->count();
                break;
            case 'month':
                $total_orders_filtered = Order::whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))
                    ->count();
                break;
            case 'year':
                $total_orders_filtered = Order::whereYear('created_at', date('Y'))
                    ->count();
                break;
            default:
                $total_orders_filtered = $total_orders;
        }

        switch ($filter) {
            case 'day':
                $revenue = Order::select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('SUM(total_price) as total')
                )
                    ->groupBy('date')
                    ->orderBy('date')
                    ->pluck('total', 'date');
                $labels = $revenue->keys();
                break;

            case 'month':
                $revenue = Order::select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('SUM(total_price) as total')
                )
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('month')
                    ->pluck('total', 'month');
                $labels = $revenue->keys();
                break;

            case 'year':
                $revenue = Order::select(
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('SUM(total_price) as total')
                )
                    ->groupBy('year')
                    ->pluck('total', 'year');
                $labels = $revenue->keys();
                break;
        }

        // Tổng số sản phẩm, blog, voucher
        $total_products = Product::count();
        $total_blogs    = Blog::count();
        $total_vouchers = Voucher::count();

        return view('admin.statistics.index', compact(
            'orders_status',
            'total_orders',
            'filter',
            'labels',
            'revenue',
            'orders_status',
            'total_orders_filtered',
            'total_products',
            'total_blogs',
            'total_vouchers',
        ));
    }
}

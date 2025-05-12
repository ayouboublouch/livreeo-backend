<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class StatisticsController extends Controller
{
    public function totalOrders() {
        $count = Order::count();
        return response()->json(['total_orders' => $count]);
    }

    public function totalVisitors() {
        // Count unique visitors based on orders' customer IP or user_id if available
        $count = Order::distinct('customer_ip')->count('customer_ip');
        return response()->json(['total_visitors' => $count]);
    }

    public function totalRevenue() {
        $sum = Order::sum('amount');
        return response()->json(['total_dhs' => $sum]);
    }

    public function usersLast30Minutes() {
        $count = User::where('last_active_at', '>=', now()->subMinutes(30))->count();
        return response()->json(['users_last_30_minutes' => $count]);
    }

    public function incompleteOrders() {
        $count = Order::where('status', '!=', 'completed')->count();
        return response()->json(['incomplete_orders' => $count]);
    }

    public function dashboard()
    {
        $totalOrders = Order::count();
        $totalVisitors = Order::distinct('customer_ip')->count('customer_ip');
        $totalDhs = Order::sum('amount');
        $usersLast30Minutes = User::where('last_active_at', '>=', now()->subMinutes(30))->count();
        $incompleteOrders = Order::where('status', '!=', 'completed')->count();

        return response()->json([
            'total_orders' => $totalOrders,
            'total_visitors' => $totalVisitors,
            'total_dhs' => $totalDhs,
            'users_last_30_minutes' => $usersLast30Minutes,
            'incomplete_orders' => $incompleteOrders,
        ]);
    }
}

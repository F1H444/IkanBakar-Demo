<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_price');
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalMenus = Menu::count();

        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'pendingOrders', 'totalMenus', 'recentOrders'));
    }
}

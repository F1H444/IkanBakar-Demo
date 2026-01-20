<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Order; // Will be added later
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Placeholder for orders
        // $orders = Auth::user()->orders()->latest()->paginate(10);
        $orders = collect([]);
        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Placeholder
        return view('user.orders.show');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'userCount' => User::count(),
            'supplierCount' => Supplier::count(),
            'productCount' => Product::count(),
            'orderCount' => Order::count(),
            'recentOrders' => Order::with('user')->latest()->take(5)->get(),
        ]);
    }
}

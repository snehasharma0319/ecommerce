<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        
        // Get featured products
        $featuredProducts = Product::where('is_active', true)
            ->where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Get recent orders
        $recentOrders = Order::where('user_id', $user->id)
            ->with('items.product')
            ->latest()
            ->take(5)
            ->get();

        // Get cart items count
        $cartItemsCount = count(session('cart', []));

        return view('dashboard', compact('user', 'featuredProducts', 'recentOrders', 'cartItemsCount'));
    }
} 
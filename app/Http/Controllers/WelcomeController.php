<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the application welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $featuredProducts = Product::where('is_featured', true)
            ->where('stock', '>', 0)
            ->take(8)
            ->get();

        return view('welcome', compact('categories', 'featuredProducts'));
    }
} 
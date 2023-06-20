<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Find the current user ID
        $user_id = auth()->user()->id;

        // Find the current user's restaurant
        $restaurant = Restaurant::where('user_id', $user_id)->first();
        
        // If user has a restaurant, get restaurant products
        if($restaurant) {
            $products = Product::where('restaurant_id', $restaurant->id)->get();
        } else {
            $products = null;
        }

        return view('dashboard', compact('products', 'restaurant'));
    }
}

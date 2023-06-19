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

        // Find the current user's restaurants
        $restaurants = Restaurant::where('user_id', $user_id)->get();

        // Find the current user's restaurant ID
        $userRestaurantId = Restaurant::where('user_id', $user_id)->first()->id;

        // Find the current user's products
        $products = Product::where('restaurant_id', $userRestaurantId)->get();

        return view('dashboard', compact('user_id', 'products', 'restaurants'));
    }
}

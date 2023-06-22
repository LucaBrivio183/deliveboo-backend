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
        if(auth()->user()->restaurant) {

            $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();
        
            $products = Product::where('restaurant_id', $restaurant->id)->take(3)->get();

            return view('dashboard', compact('restaurant', 'products'));
        } else {

            return redirect()->route('welcome');
        }
    }
}

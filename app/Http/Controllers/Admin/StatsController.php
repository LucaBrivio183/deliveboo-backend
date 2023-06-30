<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;

class StatsController extends Controller
{
    /**
     * Get the current user's restaurant.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getCurrentUserRestaurant()
    {
        // Find the current user ID
        $currentUserId = auth()->user()->id;
        // Find the current user's restaurant ID
        $userRestaurant = Restaurant::where('user_id', $currentUserId)->first();

        if ($userRestaurant) {
            return $userRestaurant->id;
        }
    }

    /**
     * Get the current restaurant's orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrentYearOrders()
    {
        // Find the current restaurant's orders within the current year
        $orders = Order::where('restaurant_id', $this->getCurrentUserRestaurant())->whereYear('created_at', date('Y'))->get();
        return $orders;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->getCurrentYearOrders();
        return view('admin.orders.stats', ['orders' => [$orders]]);
    }
}

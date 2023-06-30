<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Restaurant;

class OrderController extends Controller
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
    public function getCurrentRestaurantOrders()
    {

        // Find the current restaurant's orders
        $orders = Order::where('restaurant_id', $this->getCurrentUserRestaurant())->orderBy('created_at', 'desc')->get();
        return $orders;
    }
    /**
     * Get the current restaurant's products.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrentOrderProducts(Order $order)
    {
        $products = OrderProduct::where('order_id', $order->id)->get();
        return $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        // Find the current user ID
        $currentUser = auth()->user();
        $orders = $this->getCurrentRestaurantOrders();

        return view(('admin.orders.index'), compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

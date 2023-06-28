<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\RestaurantMail;
use App\Mail\UserMail;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
   public function store(Request $request) 
   {
      try {
         $data = $request->all();

         $newOrder = new Order();

         // Create a new order
         $newOrder->restaurant_id = $data['restaurant_id'];
         $newOrder->name = $data['name'];
         $newOrder->email = $data['email'];
         $newOrder->address = $data['address'];
         $newOrder->phone_number = $data['phone_number'];
         $newOrder->total_price = $data['total_price'];

         $newOrder->save();

         // Save the order into the pivot table
         foreach ($data['products'] as $product) {
            $newOrderProduct = new OrderProduct();
   
            $newOrderProduct->order_id = $newOrder->id;
            $newOrderProduct->product_id = $product['id'];
            $newOrderProduct->quantity = $product['quantity'];
   
            $newOrderProduct->save();
         }

         $sendToRestaurant = [
            ['email' => $newOrder->restaurant->user->email, 'name' => $newOrder->restaurant->user->name],
         ];

         $sendToUser = [
            ['email' => $newOrder->email, 'name' => $newOrder->name],
         ];

         // Send an email to the restaurant
         $restaurantMail = new RestaurantMail($newOrder);
         Mail::to($sendToRestaurant)->send($restaurantMail);

         // Send an email to the user
         $userEmail = new UserMail($newOrder);
         Mail::to($sendToUser)->send($userEmail);

         return response()->json([
            'success' => true,
            'results' => $newOrder,
         ]);
      } catch (\Throwable $th) {
            return response()->json([
               'success' => false,
               'results' => $request->all()
            ], 500);
     }
   }
}
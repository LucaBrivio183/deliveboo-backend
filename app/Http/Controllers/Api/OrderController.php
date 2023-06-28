<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;


class OrderController extends Controller
{
   public function store(Request $request) 
   {
      try {
         $data = $request->all();

         $newOrder = new Order();

         $newOrder->restaurant_id = $data['restaurant_id'];
         $newOrder->name = $data['name'];
         $newOrder->email = $data['email'];
         $newOrder->address = $data['address'];
         $newOrder->phone_number = $data['phone_number'];
         $newOrder->total_price = $data['total_price'];

         $newOrder->save();

         foreach ($data['products'] as $product) {
            $newOrderProduct = new OrderProduct();
   
            $newOrderProduct->order_id = $newOrder->id;
            $newOrderProduct->product_id = $product['id'];
            $newOrderProduct->quantity = $product['quantity'];
   
            $newOrderProduct->save();
         }

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
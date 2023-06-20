<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller

{
    // Get all restaurants (paginated by 5) with their typologies
    public function index() {

        try {

            $restaurants = Restaurant::with('typologies')->paginate(5);
            
            if($restaurants) {
    
                return response()->json([
                    'success' => true,
                    'results' => $restaurants,
                ]);
            } else {
    
                return response()->json([
                    'success' => false,
                    'results' => null
                ], 404);
            }
            
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'results' => null
            ], 500);
        }
    }
  
    public function show(string $slug) {
        $restaurant = Restaurant::where('slug', $slug)->with('products')->first();

        if ($restaurant) {
            return response()->json([
                'success' => true,
                'results' => $restaurant
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => null
            ], 404);
        }
    }
}
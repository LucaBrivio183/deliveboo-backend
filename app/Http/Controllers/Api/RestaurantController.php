<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RestaurantController extends Controller

{
    // Get all restaurants (paginated by 5) if no typology selected. Get restaurants filtered by typology otherwise.
    public function index(Request $request) {

        try {
            
            $typologiesId = $request->all();
            $numTypologies = count($typologiesId);

            $restaurants = Restaurant::whereHas('typologies', function (Builder $query) use ($typologiesId) {
                $query->whereIn('typology_id', $typologiesId);
            }, '=', $numTypologies)->paginate(5);

            return response()->json([
                'success' => true,
                'results' => $restaurants,
            ]);
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
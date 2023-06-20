<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Typology;
use Illuminate\Http\Request;

class TypologyController extends Controller
{
    public function index() {

        try {
            // Get all the typologies associated with at least a restaurant
            $typologies = Typology::has('restaurants')->get();
    
            if($typologies) {
                
                return response()->json([
                    'success' => true,
                    'results' => $typologies,
                ]);
            } else {
    
                return response()->json([
                    'success' => false,
                    'results' => null,
                ], 404);
            }
        } catch (\Throwable $th) {
            
            return response()->json([
                'success' => false,
                'results' => null,
            ], 500);
        }
    }
}
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TypologyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Homepage restaurants Api (restaurants with typologies)
Route::get('homepage', [RestaurantController::class, 'index']);

// Homepage typologies Api (only typologies associated with at least a restaurant)
Route::get('homepage/typologies', [TypologyController::class, 'index']);

// Single restaurant API with products
Route::get('restaurant/{slug}', [RestaurantController::class, 'show']);

require __DIR__ . '/auth.php';
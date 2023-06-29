<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StatsController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth', 'verified')->prefix('admin')->name('admin.')->group(function () {
    //profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //restaurants routes
    Route::resource('restaurants', RestaurantController::class);

    //products routes
    Route::resource('products', ProductController::class)->parameters(['products' => 'product:slug']);

    //categories routes
    Route::resource('categories', CategoryController::class);

    //orders routes
    Route::resource('orders', OrderController::class)->parameters(['orders' => 'order:id']);

    //orders stats route
    Route::resource('stats', StatsController::class);
});

require __DIR__ . '/auth.php';

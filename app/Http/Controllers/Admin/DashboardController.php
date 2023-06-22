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

            return view('dashboard');
        } else {

            return redirect()->route('welcome');
        }
    }
}

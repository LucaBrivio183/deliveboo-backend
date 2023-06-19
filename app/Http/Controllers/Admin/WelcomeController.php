<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        return view('welcome', compact('user_id'))
        ;
    }
}
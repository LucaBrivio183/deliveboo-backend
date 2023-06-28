<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function send()
    {
        Mail::to('team.flamingo.boolean@gmail.com')->send(new
        NewOrder());
    }
}

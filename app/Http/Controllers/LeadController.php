<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        Mail::to('team.flamingo.boolean@gmail.com')->send(new
        NewOrder());
    }
}

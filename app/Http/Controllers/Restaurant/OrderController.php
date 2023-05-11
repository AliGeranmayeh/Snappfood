<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    { 
        return view('restaurant_owner.orders-list',[
            'orders' => Auth::user()->restaurant->orders
        ]);
    }
}

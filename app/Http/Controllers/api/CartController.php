<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddToCartRequest;


class CartController extends Controller
{
    public function index()
    {
        return response()->json([
            'carts' => Auth::user()->carts
        ],200);
    }

    public function add(AddToCartRequest $request)
    {
        
    }
}

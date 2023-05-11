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

    public function post(Request $request)
    {
        dd($request);
        if ($request->has('filter')) {
            return $this->filterOrderStatus($request->order_status_filter);
        }
        if ($request->has('change_status')) {
            return $this->changeOrderStatus($request->order_statuse);
        }
        return redirect()->route('show-order-page');
    }

    public function filterOrderStatus($data)
    {
        return view('restaurant_owner.orders-list');
    }
    public function changeOrderStatus($data)
    {
        return view('restaurant_owner.orders-list');
    }

}

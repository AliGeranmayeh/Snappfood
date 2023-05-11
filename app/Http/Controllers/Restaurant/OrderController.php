<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

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
        
        if ($request->has('filter')) {
            return $this->filterOrderStatus($request->order_status_filter);
        }
        if ($request->has('change_status')) {
            return $this->changeOrderStatus($request->order_statuse,$request->change_status);
        }
        return redirect()->route('show-order-page');
    }

    public function filterOrderStatus($data)
    {
        if ($data != '0') {
            $orders = Auth::user()->restaurant->orders->where('order_status',$data);
            return view('restaurant_owner.orders-list',[
                'orders' => $orders
            ]);
        }
        return redirect()->route('show-order-page');
        
    }
    public function changeOrderStatus($order_status , $order_id)
    {
        if ($order_status != null) {
            Order::where('id',$order_id)->update(['order_status'=>$order_status]); 
            // Auth::user()->restaurant->orders->where('id',$order_id)->update(['order_status'=>$order_status]);   
        }
        return redirect()->route('show-order-page');
    }

}

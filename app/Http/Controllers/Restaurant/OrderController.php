<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Models\Cart;
use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Gate;
use App\Enums\OrderStatusEnum;

class OrderController extends Controller
{
    public function index()
    { 
        if (!Gate::allows('complete-restaurant-profile')) {
            return redirect()->route('restaurant.profile');
        }
        $total_income = 0;
        $orders =  Order::where('restaurant_id',Auth::user()->restaurant->id)->whereNot('order_status', OrderStatusEnum::DELIVERED->value)->get();
        $all_orders =Order::where('restaurant_id',Auth::user()->restaurant->id)->get();
        // dd($all_orders[0]->cart->total_price);
        foreach ($all_orders as $order) {
            $total_income += $order->cart->total_price;
        }
        
        return view('restaurant_owner.orders-list',[
            'total_income' => $total_income,
            'orders' => $orders
        ]);
    }

    public function post(Request $request)
    {
        
        if ($request->has('filter')) {
            return $this->filterOrderStatus($request->order_status_filter,$request->order_time_filter);
        }
        if ($request->has('change_status')) {
            return $this->changeOrderStatus($request->order_statuse,$request->change_status);
        }
        return redirect()->route('order.page');
    }

    public function filterOrderStatus($order_status = 0,$order_time = 0)
    {
        $total_income = 0;
        $all_orders =Order::where('restaurant_id',Auth::user()->restaurant->id)->get();
        foreach ($all_orders as $order) {
            $total_income += $order->cart->total_price;
        }
        if ($order_status != '0' && $order_time != '0') {
            return redirect()->route('order.page');
        }
        elseif ($order_status != '0') {
            
            $orders = Auth::user()->restaurant->orders->where('order_status',$order_status);
            
            return view('restaurant_owner.orders-list',[
                'total_income'=>$total_income,
                'orders' => $orders
            ]);
        }
        elseif ($order_time != '0') {
            
            if($order_time == 'week'){
                $orders = Auth::user()->restaurant->orders->where('created_at','>=', date('Y-m-d', strtotime("-1 week")));
            }
            if($order_time == 'month'){
                $orders = Auth::user()->restaurant->orders->where('created_at','>=', date('Y-m-d', strtotime("-1 month")));
            }
            
            return view('restaurant_owner.orders-list',[
                'total_income'=> $total_income,
                'orders' => $orders
            ]);
        }
        return redirect()->route('order.page');
        
    }
    public function changeOrderStatus($order_status , $order_id)
    {
        if ($order_status != null) {
            $cart_id= Auth::user()->restaurant->orders->where('id',$order_id)->first()->cart_id;
            $user_id = Cart::find($cart_id)->user_id;
            $ordered_email = User::find($user_id)->email;
            Order::where('id',$order_id)->update(['order_status'=>$order_status]);

            $mail_data = [
                'content' => "your order status is $order_status" 
            ];
             Mail::to($ordered_email)->send(new SendMail($mail_data));
   
        }
        return redirect()->route('order.page');
    }

}

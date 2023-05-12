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

class OrderController extends Controller
{
    public function index()
    { 
        // dd(Order::where('restaurant_id',Auth::user()->restaurant->id)->wherenot('order_status', 'deliverd')->get());
        return view('restaurant_owner.orders-list',[
            
            'orders' => Order::where('restaurant_id',Auth::user()->restaurant->id)->whereNot('order_status', 'delivered')->get()
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
            $cart_id= Auth::user()->restaurant->orders->where('id',$order_id)->first()->cart_id;
            $user_id = Cart::find($cart_id)->user_id;
            $ordered_email = User::find($user_id)->email;
            Order::where('id',$order_id)->update(['order_status'=>$order_status]);

            $mail_data = [
                'content' => "your order status is $order_status" 
            ];
             Mail::to($ordered_email)->send(new SendMail($mail_data));
            // Auth::user()->restaurant->orders->where('id',$order_id)->update(['order_status'=>$order_status]);   
        }
        return redirect()->route('show-order-page');
    }

}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Http\Requests\AddCommentRequest;
use App\Models\Comment;
use App\Models\CommentFood;

class CommentController extends Controller
{
    public function index()
    {
        return response()->json([
            'comments' => Auth::user()->comments 
        ],200);
    }

    public function addComment($order_id , AddCommentRequest $request)
    {
        $cart_id = 0;
        $is_user_order_flag = false;
        $user_orders = Auth::user()->carts->where('payment_status',1);
        foreach ($user_orders as $key => $user_order) {
            $order = Order::where('cart_id',$user_order->id)->first();
            if ($order->id == $order_id) {
                $is_user_order_flag = true;
               $cart_id = $user_order->id;
                break;
            }
        }
        if (!$is_user_order_flag) {
            return response()->json([
                'error' => "User order doesn't exist"
            ],404);
        }
        $user_order = Order::find($order_id);
        if ($user_order->order_status != 'delivered') {
            return response()->json([
                'error' => "You can't comment until you receive your order"
            ],404);
        }
       $comment = Comment::create([
        'user_id'=>Auth::user()->id,
        'restaurant_id'=> $user_order->restaurant_id,
        'order_id'=>$order_id,
        'cart_id'=>$cart_id,
        'comment' =>$request->comment,
        'status' => 0 //waitimg confirmation
       ]);


       return response()->json([
        'message' => "your comment sent for restaurant owner"
    ],200);

    }
}

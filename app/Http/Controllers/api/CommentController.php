<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Http\Requests\AddCommentRequest;
use App\Models\Comment;
use App\Models\CommentFood;
use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Foundation\Auth\User;
use App\Models\Food;
use App\Http\Resources\getCommentResource;
use App\Models\Restaurant;
use App\Enums\CommentStatusEnum;

class CommentController extends Controller
{
    public function index()
    {
        return response()->json([
            'comments' => Auth::user()->comments
        ], 200);
    }

    public function addComment($order_id, AddCommentRequest $request)
    {
        $cart_id = 0;
        $is_user_order_flag = false;
        $user_orders = Auth::user()->carts->where('payment_status', PaymentStatusEnum::PAID->value);
        foreach ($user_orders as $key => $user_order) {
            $order = Order::where('cart_id', $user_order->id)->first();
            if ($order->id == $order_id) {
                $is_user_order_flag = true;
                $cart_id = $user_order->id;
                break;
            }
        }
        if (!$is_user_order_flag) {
            return response()->json([
                'error' => "User order doesn't exist"
            ], 404);
        }
        $user_order = Order::find($order_id);
        if ($user_order->order_status != 'delivered') {
            return response()->json([
                'error' => "You can't comment until you receive your order"
            ], 404);
        }
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'restaurant_id' => $user_order->restaurant_id,
            'order_id' => $order_id,
            'cart_id' => $cart_id,
            'comment' => $request->comment,
            'status' => CommentStatusEnum::CONFIRM_REQUEST->value
        ]);


        return response()->json([
            'message' => "your comment sent for restaurant owner"
        ], 200);

    }

    public function foodComments($food_id)
    {
        if (!Food::find($food_id)) {
            return response()->json([
                'error' => "food didn't found"
            ], 404);
        }
        
        $comments = [];
        $cart_items = CartItem::where('food_id', $food_id)->get();

        foreach ($cart_items as $cart_item) {
            $food_comments = Cart::find($cart_item->cart_id)->comments;

            foreach ($food_comments as $food_comment) {
                if ($food_comment->parent_id == null && $food_comment->status != 0) {
                    $comments[] = [
                        'id' =>$food_comment->id,
                        'user' => User::find($food_comment->user_id)->name,
                        'comment' =>$food_comment->comment,
                        'reply' => (Comment::where('parent_id', $food_comment->id)->first()!=null)?new getCommentResource(Comment::where('parent_id', $food_comment->id)->first()):null
                    ];
                }
            }
        }
        
        return response()->json([
            'comments' => $comments
        ], 200);
    }

    public function restaurantComments($restaurant_id)
    {
        if (!Restaurant::find($restaurant_id)) {
            return response()->json([
                'error' => "Restaurant didn't found"
            ], 404);
        }
        $comments = [];
        $restaurant_comments = Restaurant::find($restaurant_id)->comments;

        foreach ($restaurant_comments as $restaurant_comment) {
            if ($restaurant_comment->parent_id == null && $restaurant_comment->status != 0) {
                $comments[] = [
                    'id' => $restaurant_comment->id,
                    'user' => User::find($restaurant_comment->user_id)->name,
                    'comment' => $restaurant_comment->comment,
                    'reply' =>(Comment::where('parent_id', $restaurant_comment->id)->first())? new getCommentResource(Comment::where('parent_id', $restaurant_comment->id)->first()):null
                ];
            }
        }
        return response()->json([
            'comments' => $comments
        ], 200);
    }
}

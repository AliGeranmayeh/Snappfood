<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddToCartRequest;
use App\Models\Food;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
class CartController extends Controller
{
    public function index()
    {
        $carts = [];
        foreach (Auth::user()->carts as $key=> $cart) {
            if ($cart->payment_status==0) {
                $carts[$key]['cart_info'][] = $cart;
                $carts[$key]['cart_foods'][] = CartItem::where('cart_id',$cart->id)->get();
            }
        }
        return response()->json([
            'carts' => $carts
        ], 200);
    }

    public function add(AddToCartRequest $request)
    {
        
        $food = Food::find($request->food_id);

        if (!$food) {
            return response()->json([
                'message' => "Food does'nt exist."
            ], 400);
        }
        if ($request->count <= 0) {
            return response()->json([
                'message' => "Unacceptable count."
            ], 400);
        }

        if (count(Auth::user()->carts) != 0) {
            foreach (Auth::user()->carts as $cart) {
                if ($food->restaurant->id == $cart->restaurant_id && $cart->payment_status == 0) {
                    $food_in_cart = CartItem::where('cart_id', $cart->id)->where('food_id', $food->id)->first();
                    ($food_in_cart) ? $food_price = $this->updateFoodInCart($food_in_cart, (float)$request->count) : $food_price = $this->addFoodIncart($food, $cart->id,(float) $request->count);
                    Cart::where('id', $cart->id)->update(['total_price' => $cart->total_price + $food_price]);
                    return response()->json([
                        'message' => 'food added to cart successfully',
                        "cart_id" => $cart->id
                    ], 200);
                }
            }
        }
        
        $total_price = ($food->price - ($food->price * $food->discount)) * $request->count;
        $cart = $this->createNewCart(Auth::user()->id, $food->restaurant->id, $total_price);
        $this->addFoodIncart($food, $cart->id, $request->count);
        return response()->json([
            'message' => 'food added to cart successfully',
            "cart_id" => $cart->id
        ]);
    }

    public function update(AddToCartRequest $request)
    {
        $user_active_carts_id = [];
        $user_active_carts = Cart::where('user_id',Auth::user()->id)->where('payment_status',0)->get();
        if (count($user_active_carts)!=0) {
            foreach ($user_active_carts as $user_active_cart) {
                $user_active_carts_id[]= $user_active_cart->id;
            }  
            foreach ($user_active_carts_id as $user_active_cart_id) {
                $cart_food = CartItem::where('food_id',$request->food_id)->where('cart_id', $user_active_cart_id)->first();
                $cart = Cart::find($user_active_cart_id);
                if ($cart_food) {
                   $final_count = $cart_food->food_count + (float)$request->count;
                   if ( $final_count > 0) {
                       $price = $this->updateFoodInCart($cart_food,(float)$request->count);
                       Cart::where('id', $user_active_cart_id)->update(['total_price' => $cart->total_price + $price]);
                    return response()->json(['message' => 'cart updated successfully',"cart_id" => $cart->id], 200);
                    }
                   $price = $this->deleteFoodFromCart($cart_food,(float)$cart_food->food_count);
                   if (count(CartItem::where('cart_id',$user_active_cart_id)->get())==0) {
                    Cart::where('id', $user_active_cart_id)->delete();
                    return response()->json(['message' => 'Cart deleted (no food)'], 200);
                   }
                   Cart::where('id', $user_active_cart_id)->update(['total_price' => $cart->total_price - $price]);
                   return response()->json(['message' => 'cart updated successfully',"cart_id" => $cart->id], 200);
                }
            }
        }
        return response()->json(['error' => 'there is no food with this information in your active carts'], 404);
    }

    public function getCartInfo($cart_id)
    {
        if (!Cart::where('user_id',Auth::user()->id)->where('id',$cart_id)->where('payment_status',0)->first()) {
            return response()->json(['error' => 'You do not have a active cart with this information'], 404);
        }
        $cart = Cart::find($cart_id);
        $cart_items = CartItem::where('cart_id',$cart_id)->get();
        return response()->json([
            'data' => [
                'cart_info' => $cart,
                'cart_foods' => $cart_items
            ]
        ],200);
    }


    public function peyForCart($cart_id)
    {
        if (!Cart::where('user_id',Auth::user()->id)->where('id',$cart_id)->where('payment_status',0)->first()) {
            return response()->json(['error' => 'You do not have a active cart with this information'], 404);
        }
        $cart = Cart::find($cart_id);
        Order::create([
            'restaurant_id' => $cart->restaurant_id,
            'cart_id' => $cart_id,
            'order_status' => 'checking'
        ]);
        Cart::where('id',$cart_id)->update(['payment_status'=>1]);

        return response()->json([
            'message' => 'You payed for your cart'
        ],200);
    }












    
    public function createNewCart($user_id, $restaurant_id, $total_price)
    {
        $cart = Cart::create([
            'user_id' => $user_id,
            'restaurant_id' => $restaurant_id,
            'total_price' => $total_price
        ]);
        return $cart;

    }
    public function updateFoodInCart($food, $count)
    {
        $new_count = $food->food_count +(float)$count;
        $item = CartItem::where('cart_id', $food->cart_id)->where('food_id', $food->food_id)->update([
            'food_count' =>$new_count
        ]);
       
        return $count * ($food->food_price - $food->food_price * $food->food_discount);
    }
    public function addFoodIncart($food, $cart_id, $count)
    {
        CartItem::create([
            'food_id' => $food->id,
            'cart_id' => $cart_id,
            'food_name' => $food->name,
            'food_price' => $food->price,
            'food_discount' => $food->discount,
            'food_count' => (float)$count
        ]);
        return $count * ($food->price - $food->price * $food->discount);
    }

    public function deleteFoodFromCart($food, $count)
    {
        $price = $count * ($food->food_price - $food->food_price * $food->food_discount);
        CartItem::where('cart_id', $food->cart_id)->where('food_id', $food->food_id)->delete();
        return $price;
    }
}

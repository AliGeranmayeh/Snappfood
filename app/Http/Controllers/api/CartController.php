<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddToCartRequest;
use App\Models\Food;
use App\Models\Cart;


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
        $food = Food::find($request->food_id);
        $this->addToCartErrors($food,$request->count);
        $foods = [[
            'id' => $food->id,
            'name' => $food->name,
            'price' => $food->price,
            'discount' => $food->discount,
            'count' => $request->count
            ]];
        if (count(Auth::user()->carts) != 0) {
            foreach (Auth::user()->carts as $cart) {
                $total_price = $cart->total_price + (($food->price -($food->price* $food->discount)) * $request->count);
                if ($food->restaurant->id == $cart->restaurant_id && $cart->payment_status == 0) {
                    $cart_foods = json_decode($cart->foods,true);
                    foreach ($cart_foods as $key=> $cart_food) {
                        dd($foods[0]['id'],$cart_food['id']);
                        if ($cart_food['id'] == $foods[0]['id']) {
                            $cart_foods[$key]['count'] += $foods[0]['count'];
                            $this->addToCartTableHandler($cart->id,$cart_foods,$total_price);
                        }
                    }
                    $cart_foods[] = $foods;
                    $this->addToCartTableHandler($cart->id,$cart_foods,$total_price);
                }
            }
        }
        $total_price=($food->price -($food->price* $food->discount)) * $request->count;
        $this->createNewCart(Auth::user()->id,$food->restaurant->id,json_encode($foods, JSON_PRETTY_PRINT),$total_price);
    }
    public function addToCartTableHandler($cart_id,$foods,$total_price)
    {
        Cart::where('id', $cart_id)->update([
            'foods' => json_encode($foods, JSON_PRETTY_PRINT),
            'total_price' => $total_price
        ]);
        return response()->json([
            'message' => 'food added to cart successfully',
            "cart_id" => $cart_id
        ]);
    }
    public function createNewCart($user_id,$restaurant_id,$foods,$total_price)
    {
        $cart = Cart::create([
            'user_id' => $user_id,
            'restaurant_id' => $restaurant_id,
            'foods' => json_encode($foods, JSON_PRETTY_PRINT),
            'total_price' => $total_price
        ]);
        return response()->json([
            'message' => 'food added to cart successfully',
            "cart_id" => $cart->id
        ]);
    }
    public function addToCartErrors($food,$count)
    {
        if (!$food) {
            return response()->json([
                'message' => "Food does'nt exist."
            ]);
        }
        if ($count <= 0) {
            return response()->json([
                'message' => "Unacceptable count."
            ]);
        }
    }
}

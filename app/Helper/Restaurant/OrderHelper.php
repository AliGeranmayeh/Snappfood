<?php


namespace App\Helper\Restaurant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class OrderHelper

{
    public static function getThisRestaurantNotDeliveredOrders()
    {
        return Order::notDelivered()->get();
    }

    public static function getThisRestaurantOrders()
    {
        $currentRestaturant = Auth::user()->restaurant;
        return Order::where('restaurant_id', $currentRestaturant->id)->get();
    }
}

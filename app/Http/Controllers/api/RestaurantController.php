<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index($restaurant_id)
    {
        $restaurant = Restaurant::find($restaurant_id);
        $restaurant_type = $restaurant->type;
        return response()->json([
            "message" => $restaurant,
            ], 200);
    }
}

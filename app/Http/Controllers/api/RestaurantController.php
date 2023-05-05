<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Http\Requests\FilterRestaurantsRequest;
use App\Models\User;

class RestaurantController extends Controller
{
    public function index($restaurant_id)
    {

        $restaurant = Restaurant::find($restaurant_id);
        if (!$restaurant) {
            return response()->json([
                "message" => "Restaurant doesn't exist",
                ], 404);
        }
        $restaurant_type = $restaurant->type;
        return response()->json([
            "message" => $restaurant,
            ], 200);
    }

    public function search(FilterRestaurantsRequest $request)
    {
        // $query = Restaurant::query();
        // Restaurant::when(!$request->has('type') , function ($q) {
        //      return response()->json([
        //         'message' => $q->all()
        //     ],200);
        // });
        if (!$request->has('type')) {
            return response()->json([
                'message' => Restaurant::all()
            ],200);
        }
        return response()->json([
            'message' => Restaurant::where('type_id',$request->type)->get()
        ],200);
    }

    public function foods($restaurant_id)
    {

        $restaurant =Restaurant::find($restaurant_id);
        if (!$restaurant) {
            return response()->json([
                'message' => 'There is no restaurant with this id'
            ]);
        }
        return response()->json([
            'message' => $restaurant->foods
        ]);
    }
}

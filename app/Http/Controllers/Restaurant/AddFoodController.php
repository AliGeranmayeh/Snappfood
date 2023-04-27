<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\FoodCategory;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Food;
use App\Models\Restaurant;
use App\Http\Requests\FoodRequest;

class AddFoodController extends Controller
{
    public function index()
    {
        $food_categories = FoodCategory::all();
        $admin_user_id = User::where('role','admin')->first()->id;
        $discounts = Discount::where('user_id',Auth::user()->id)->orwhere('user_id',$admin_user_id)->get();
        return view('restaurant_owner.food',[
            'food_categories' => $food_categories,
            'discounts' =>$discounts,
        ]);
    }

    public function create(FoodRequest $request)
    {
        $request->validated();
        Food::create([
            'name' => $request->name,
            'image' => $request->image,
            'price' => $request->price,
            'materials' => $request->materials,
            'discount_id' => $request->discount,
            'type_id' => $request->type,
            'restaurant_id' => Restaurant::where('user_id',Auth::user()->id)->first()->id
        ]);
        return redirect()->route('home');   
    }
}

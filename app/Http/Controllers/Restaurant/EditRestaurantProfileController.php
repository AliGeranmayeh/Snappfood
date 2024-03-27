<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\RestaurantCategory;
use App\Http\Requests\CreateRestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Gate;

class EditRestaurantProfileController extends Controller
{
    public function index()
    {
        $restaurant_categories = RestaurantCategory::all();
        $restaurant = User::find(Auth::user()->id)->restaurant;  
        $restaurant_category_id = RestaurantCategory::find($restaurant->type_id)->id;
        return view('restaurant_owner.edit-profile',[
            'restaurant' => $restaurant,
            'restaurant_category_id' => $restaurant_category_id,
            'restaurant_categories' => $restaurant_categories,
            'error' => null
        ]);
    }

    public function update(CreateRestaurantRequest $request)
    {
        $request->validated();
        Restaurant::where('user_id', Auth::user()->id)->update([
            'name' => $request->name,
                'phone' => $request->phone,
                'account' => $request->account,
                'user_id' => Auth::user()->id,
                'type_id' => $request->type,
                'address'=> $request->address,
        ]);

        return redirect()->route('restaurant.profile');
    }
}

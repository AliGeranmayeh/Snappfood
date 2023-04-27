<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Http\Requests\CreateRestaurantRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $restaurant_categories = RestaurantCategory::all();
        $restaurant = User::find(Auth::user()->id)->restaurant;
        $restaurant_category = RestaurantCategory::find($restaurant->type_id)->name;
        return view('restaurant_owner.profile',[
            'restaurant' => $restaurant,
            'category' => $restaurant_category,
            'restaurant_categories' => $restaurant_categories,
            'error' => null
        ]);
    }

    public function create(CreateRestaurantRequest $request)
    {

        if ($request->has('create')) {
            // dd($request);
            $request->validated();
            $resturant = new Restaurant;
            $resturant->name =$request->name;
            $resturant->phone = $request->phone;
            $resturant->account = $request->account;
            $resturant->user_id = Auth::user()->id;
            $resturant->type_id = $request->type;
            $resturant->address = $request->address;
            $resturant->save();
            // Restaurant::create([
            //     'name' => $request->name,
            //     'phone' => $request->phone,
            //     'account' => $request->account,
            //     'user_id' => Auth::user()->id,
            //     'type_id' => $request->type,
            //     'address'=> $request->address,
            // ]);
    
            return redirect()->route('restaurant-profile');   
        }
        
        $restaurant_categories = RestaurantCategory::all();
        $restaurant = User::find(Auth::user()->id)->restaurant;
        $restaurant_category = RestaurantCategory::find($restaurant->type_id)->name;
        return view('restaurant_owner.profile',[
            'restaurant' => $restaurant,
            'category' => $restaurant_category,
            'restaurant_categories' => $restaurant_categories,
            'error' => 'What happend??'
        ]);
    }

}

<?php

namespace App\Http\Controllers\Restaurant;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helper\Restaurant\RestaurantHelper;
use App\Http\Requests\RestaurantProfileRequest;


class ProfileController extends Controller
{
    public function showProfileInfoPage()
    {
        return view('restaurant_owner.profile', [
            'restaurant' => RestaurantHelper::getThisRestaurant(),
            'category' => RestaurantHelper::getThisRestaurantCategory(),
            'restaurant_categories' => RestaurantHelper::getAllRestaurantCategories(),
            'error' => null
        ]);
    }

    public function create(RestaurantProfileRequest $request)
    {

        if ($request->has('create')) {
            // dd($request);
            $request->validated();
            $resturant = new Restaurant;
            $resturant->name = $request->name;
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

            return redirect()->route('restaurant.profile');
        }

        $restaurant_categories = RestaurantCategory::all();
        $restaurant = User::find(Auth::user()->id)->restaurant;
        $restaurant_category = RestaurantCategory::find($restaurant->type_id)->name;
        return view('restaurant_owner.profile', [
            'restaurant' => $restaurant,
            'category' => $restaurant_category,
            'restaurant_categories' => $restaurant_categories,
            'error' => 'What happend??'
        ]);
    }

    public function showUpdateProfilePage()
    {
        $restaurant_categories = RestaurantCategory::all();
        $restaurant = User::find(Auth::user()->id)->restaurant;
        $restaurant_category_id = RestaurantCategory::find($restaurant->type_id)->id;
        return view('restaurant_owner.edit-profile', [
            'restaurant' => $restaurant,
            'restaurant_category_id' => $restaurant_category_id,
            'restaurant_categories' => $restaurant_categories,
            'error' => null
        ]);
    }


    public function update(RestaurantProfileRequest $request)
    {
        Restaurant::where('user_id', Auth::user()->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'account' => $request->account,
            'user_id' => Auth::user()->id,
            'type_id' => $request->type,
            'address' => $request->address,
        ]);

        return redirect()->route('restaurant.profile');
    }

}

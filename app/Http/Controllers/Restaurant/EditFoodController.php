<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FoodRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Gate;
use App\Enums\UserRoleEnum;

class EditFoodController extends Controller
{
    public function index($id)
    {
        if (!Gate::allows('complete-restaurant-profile')) {
            return redirect()->route('restaurant.profile');
        }
        $food = Food::find($id);
        $food_categories = FoodCategory::all();
        $admin_user_id = User::where('role',UserRoleEnum::ADMIN->value)->first()->id;
        $discounts = Discount::where('user_id',Auth::user()->id)->orwhere('user_id',$admin_user_id)->get();
        return view('restaurant_owner.edit-food',[
            'food' =>$food,
            'food_categories' => $food_categories,
            'discounts' =>$discounts,
        ]);
    }

    public function update(FoodRequest $request , $id)
    {
        $food = Food::find($id);
        $image_path = $food->image;
        $discount_id =null;
        $discount = 0;
        if($request->has('image')){
            if ($image_path != 'images/default.png'){
                unlink("$image_path");
            }
            $new_image_name = time().'-'.$request->name.'.'.$request->image->extension();
            $request->image->move(public_path('images'),$new_image_name);
            $image_path = 'images/'.$new_image_name;
        }
        if ($request->discount != 'null') {
            $discount_id = $request->discount;
            $discount = ((Discount::find($discount_id)->percentage)/100);
        }
        $request->validated();
        Food::where('id', $id)->update([
            'name' => $request->name,
            'image' => $image_path,
            'price' => $request->price,
            'materials' => $request->materials,
            'discount_id' => $discount_id,
            'discount' => $discount,
            'type_id' => $request->type,
            'restaurant_id' => Restaurant::where('user_id',Auth::user()->id)->first()->id
        ]);

        return redirect()->route('owner.home');

    }
}

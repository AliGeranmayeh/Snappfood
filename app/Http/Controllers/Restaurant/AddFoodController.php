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
use Illuminate\Support\Facades\Gate;

class AddFoodController extends Controller
{
    public function index()
    {
        if (!Gate::allows('complete-restaurant-profile')) {
            abort(403);
        }
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
        $image_path = 'images/default.png';
        $discount_id =null;
        $discount_percent = 0;
        if($request->has('image')){
            $new_image_name = time().'-'.$request->name.'.'.$request->image->extension();
            $request->image->move(public_path('images'),$new_image_name);
            $image_path = 'images/'.$new_image_name;
        }
        if ($request->discount != 'null') {
            $discount_id = $request->discount;
            $discount_percent = ((Discount::find($discount_id)->percentage)/100);
        }
        
        $food = new Food;
        $food->name = $request->name;
        $food->image  = $image_path;
        $food->price = $request->price;
        $food->materials = $request->materials;
        $food->discount_id = $discount_id;
        // dd($discount_percent);
        $food->discount = $discount_percent;
        $food->type_id = $request->type;
        $food->restaurant_id =  Restaurant::where('user_id',Auth::user()->id)->first()->id;
        $food->save();
        // Food::create([
        //     'name' => $request->name,
        //     'image' => $image_path,
        //     'price' => $request->price,
        //     'materials' => $request->materials,
        //     'discount_id' => $discount_id,
        //     'discount' => $discount,
        //     'type_id' => $request->type,
        //     'restaurant_id' => Restaurant::where('user_id',Auth::user()->id)->first()->id
        // ]);
        return redirect()->route('home');   
    }
}

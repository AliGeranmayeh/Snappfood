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
use App\Enums\UserRoleEnum;
use App\Helper\Restaurant\FoodHelper;
use App\Helper\Restaurant\DiscountHelper;
use App\Helper\Restaurant\RestaurantHelper;


class FoodController extends Controller
{
    public function showCreatePage()
    {
        return view('restaurant_owner.food',[
            'food_categories' => FoodHelper::getAllFoodCategories(),
            'discounts' =>DiscountHelper::getAvailableDiscounts(),
        ]);
    }

    public function create(FoodRequest $request)
    {
    
        $foodDiscount = ((int)$request->discount >0)? $request->discount :null;

        FoodHelper::createFood([
            'name' =>$request->name,
            'image'=>$this->imagePath($request->image,$request->name),
            'price' => $request->price,
            'materials' => $request->materials,
            'discount_id' => $foodDiscount,
            'discount' => $this->calculateDiscountPercentage($request->discount),
            'type_id' => $request->type,
            'restaurant_id' => RestaurantHelper::getThisRestaurant()->id
        ]);
        return redirect()->route('owner.home');   
    }

    public function showUpdatePage(Food $food)
    {
        $food_categories = FoodCategory::all();
        $admin_user_id = User::where('role',UserRoleEnum::ADMIN->value)->first()->id;
        $discounts = Discount::where('user_id',Auth::user()->id)->orwhere('user_id',$admin_user_id)->get();
        return view('restaurant_owner.edit-food',[
            'food' =>$food,
            'food_categories' => $food_categories,
            'discounts' =>$discounts,
        ]);
    }

    public function update(FoodRequest $request, Food $food)
    {
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
            // dd($discount_id,Discount::find($discount_id)->percentage,Discount::find($discount_id));
            $discount = ((Discount::find($discount_id)->percentage)/100);
        }
        $request->validated();
        $food->update([
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

    public function delete(Food $food)
    {
        $image_path = $food->image;
        if ($image_path != 'images/default.png') {
            unlink("$image_path");
        }
        // Food::destroy($data->delete);
        $food->delete();

        return redirect()->route('owner.home');
    }

    private function imagePath($image , string $name)
    {
        $image_path = 'images/default.png';
        if(!empty($image)){
            $new_image_name = time().'-'.$name.'.'.$image->extension();
            $image->move(public_path('images'),$new_image_name);
            $image_path = 'images/'.$new_image_name;
        }
        return $image_path;
    }

    private function calculateDiscountPercentage(int $dicountId){
        try {
            return (Discount::find($dicountId)->percentage)/100;
        } catch (\Throwable $th) {
            return 0;
        }
    }
}

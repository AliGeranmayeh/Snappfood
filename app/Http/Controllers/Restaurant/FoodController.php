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
        return view('restaurant_owner.food', [
            'food_categories' => FoodHelper::getAllFoodCategories(),
            'discounts' => DiscountHelper::getAvailableDiscounts(),
        ]);
    }

    public function create(FoodRequest $request)
    {

        $foodDiscount = ((int)$request->discount > 0) ? $request->discount : null;

        FoodHelper::createFood([
            'name' => $request->name,
            'image' => $this->createImagePath($request->image, $request->name),
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
        return view('restaurant_owner.edit-food', [
            'food' => $food,
            'food_categories' => FoodHelper::getAllFoodCategories(),
            'discounts' => DiscountHelper::getAvailableDiscounts(),
        ]);
    }

    public function update(FoodRequest $request, Food $food)
    {

        $foodDiscount = ((int)$request->discount > 0) ? $request->discount : null;

        FoodHelper::updateFood($food, [
            'name' => $request->name,
            'image' => $this->updateImagePath($request->image, $request->name),
            'price' => $request->price,
            'materials' => $request->materials,
            'discount_id' => $foodDiscount,
            'discount' => $this->calculateDiscountPercentage($request->discount),
            'type_id' => $request->type,
            'restaurant_id' => RestaurantHelper::getThisRestaurant()->id
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

    private function createImagePath($image, string $name)
    {
        $image_path = 'images/default.png';
        if (!empty($image)) {
            $image_path = $this->stroreImage($image, $name);
        }
        return $image_path;
    }

    private function updateImagePath($image, string $name)
    {
        $image_path = $image;
        if (!empty($image)) {
            if ($image_path != 'images/default.png') {
                unlink("$image_path");
            }
            $image_path = $this->stroreImage($image, $name);
        }
        return $image_path;
    }

    private function storeImage($image, string $name, $path = 'image/')
    {
        $new_image_name = time() . '-' . $name . '.' . $image->extension();
        $image->move(public_path('images'), $new_image_name);
        return $path . $new_image_name; //where image is stored
    }

    private function calculateDiscountPercentage(int $dicountId)
    {
        try {
            return (Discount::find($dicountId)->percentage) / 100;
        }
        catch (\Throwable $th) {
            return 0;
        }
    }
}

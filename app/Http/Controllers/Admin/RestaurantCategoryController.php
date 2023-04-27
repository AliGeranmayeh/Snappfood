<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\RestaurantCategory;

class RestaurantCategoryController extends Controller
{
    public function index()
    {
        $restaurant_categories = RestaurantCategory::all();
        return view('admin.restaurant-category' , [
            'restaurant_categories' => $restaurant_categories,
            'name' => null,
            'id' => null,
            'error' => null
        ]);
    }

    public function post(Request $request)
    {
        if ($request->has('update')) {
            return $this->updateRestaurantCategory($request);
        }
        elseif ($request->has('edit')) {
            return $this->editRestaurantCategory($request);   
        }
        elseif ($request->has('delete')) {
            return $this->deleteRestaurantCategory($request);
        }
        elseif ($request->has('create')) {
            return $this->createRestaurantCategory($request);
        }

        return redirect()->route('restaurant-category');
    }

    public function updateRestaurantCategory($data)
    {
        RestaurantCategory::where('id',$data->update)->update(['name' => $data->name]);
        $restaurant_categories = RestaurantCategory::all();
        return view('admin.restaurant-category' , [
            'restaurant_categories' => $restaurant_categories,
            'name' => null,
            'id' => null,
            'error' => 'Update was successful'
        ]);
    }
    public function deleteRestaurantCategory($data)
    {
        RestaurantCategory::destroy($data->delete);
        $restaurant_categories = RestaurantCategory::all();
        return view('admin.restaurant-category' , [
            'restaurant_categories' => $restaurant_categories,
            'name' => null,
            'id' => null,
            'error' => 'Delete was successful'
        ]);
    }
    public function editRestaurantCategory($data)
    {
        
        $restaurant_categories = RestaurantCategory::all();
        $restaurant_category = RestaurantCategory::find($data->edit);
        return view('admin.restaurant-category' , [
            'restaurant_categories' => $restaurant_categories,
            'name' => $restaurant_category->name,
            'id' => $restaurant_category->id,
            'error' => null
        ]);
    }
    public function createRestaurantCategory($data)
    {
        RestaurantCategory::create([
            'name' => $data->name
        ]);
        $restaurant_categories = RestaurantCategory::all();
        return view('admin.restaurant-category' , [
            'restaurant_categories' => $restaurant_categories,
            'name' => null,
            'id' => null,
            'error' => 'A new category created'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\FoodCategory;

class FoodCategoryController extends Controller
{
    public function index()
    {
        $food_categories = FoodCategory::all();
        return view('admin.food-category' , [
            'food_categories' => $food_categories,
            'name' => null,
            'id' => null,
            'error' => null
        ]);
    }

    public function post(Request $request)
    {
        if ($request->has('update')) {
            return $this->updateFoodCategory($request);
        }
        elseif ($request->has('edit')) {
            return $this->editFoodCategory($request);   
        }
        elseif ($request->has('delete')) {
            return $this->deleteFoodCategory($request);
        }
        elseif ($request->has('create')) {
            return $this->createFoodCategory($request);
        }

        return redirect()->route('food-category');
    }

    public function updateFoodCategory($data)
    {
        FoodCategory::where('id',$data->update)->update(['name' => $data->name]);
        $food_categories = FoodCategory::all();
        return view('admin.food-category' , [
            'food_categories' => $food_categories,
            'name' => null,
            'id' => null,
            'error' => 'Update was successful'
        ]);
    }
    public function deleteFoodCategory($data)
    {
        FoodCategory::destroy($data->delete);
        $food_categories = FoodCategory::all();
        return view('admin.food-category' , [
            'food_categories' => $food_categories,
            'name' => null,
            'id' => null,
            'error' => 'Delete was successful'
        ]);
    }
    public function editFoodCategory($data)
    {
        
        $food_categories = FoodCategory::all();
        $food_category = FoodCategory::find($data->edit);
        return view('admin.food-category' , [
            'food_categories' => $food_categories,
            'name' => $food_category->name,
            'id' => $food_category->id,
            'error' => null
        ]);
    }
    public function createFoodCategory($data)
    {
        FoodCategory::create([
            'name' => $data->name
        ]);
        $food_categories = FoodCategory::all();
        return view('admin.food-category' , [
            'food_categories' => $food_categories,
            'name' => null,
            'id' => null,
            'error' => 'A new category created'
        ]);
    }
}

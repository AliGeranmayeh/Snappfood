<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discount' , [
            'discounts' => $discounts,
            'error' => null
        ]);
    }

    public function post(Request $request)
    {
        
        if ($request->has('delete')) {
            return $this->deleteDiscount($request);
        }
        elseif ($request->has('create')) {
            return $this->createDiscount($request);
        }

        return redirect()->route('get-discount');
    }

    
    public function deleteDiscount($data)
    {
        Discount::destroy($data->delete);
        $restaurant_categories = Discount::all();
        return view('admin.restaurant-category' , [
            'restaurant_categories' => $restaurant_categories,
            'error' => 'Delete was successful'
        ]);
    }
    
    public function createDiscount($data)
    {
        $data->validated();
        Discount::create([
            'name' => $data->name,
            'percentage' => $data->percentage,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('get-discount');
    }
}

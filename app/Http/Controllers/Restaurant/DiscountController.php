<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DiscountRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class DiscountController extends Controller
{
    public function index()
    {
        if (!Gate::allows('complete-restaurant-profile')) {
            return redirect()->route('restaurant.profile');
        }
        $admin_user_id = User::where('role','admin')->first()->id;
        
        $discounts = Discount::where('user_id',Auth::user()->id)->orwhere('user_id',$admin_user_id)->get();
        return view('restaurant_owner.discount' , [
            'discounts' => $discounts,
            'error' => null
        ]);
    }

    public function post(DiscountRequest $request)
    {
        
        if ($request->has('delete')) {
            return $this->deleteDiscount($request);
        }
        elseif ($request->has('create')) {
            return $this->createDiscount($request);
        }

        return redirect()->route('owner.discount.get');
    }

    
    public function deleteDiscount($data)
    {
        Discount::destroy($data->delete);
        $admin_user_id = User::where('role','admin')->first()->id;
        $discounts = Discount::where('user_id',Auth::user()->id)->orwhere('user_id',$admin_user_id)->get();
        return view('restaurant_owner.discount' , [
            'discounts' => $discounts,
            'error' => 'Delete was successful'
        ]);
    }
    
    public function createDiscount($data)
    {
        if ($data->percentage!= 0) {
            $data->validated();
            Discount::create([
                'name' => $data->name,
                'percentage' => $data->percentage,
                'user_id' => Auth::user()->id
            ]);
            return redirect()->route('owner.discount.get');
        }
        $admin_user_id = User::where('role','admin')->first()->id;
        $discounts = Discount::where('user_id',Auth::user()->id)->orwhere('user_id',$admin_user_id)->get();
        return view('restaurant_owner.discount' , [
            'discounts' => $discounts,
            'error' => "Percentage can't be 0"
        ]);
        
    }
}

<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DiscountRequest;
use App\Models\User;

class DiscountController extends Controller
{
    public function index()
    {
        $admin_user_id = User::where('role','admin')->get()->id;
        $discounts = Discount::where('user_id',Auth::user()->id)->orwhere('user_id',$admin_user_id);
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

        return redirect()->route('get-owner-discount');
    }

    
    public function deleteDiscount($data)
    {
        Discount::destroy($data->delete);
        $admin_user_id = User::where('role','admin')->get()->id;
        $discounts = Discount::where('user_id',Auth::user()->id)->orwhere('user_id',$admin_user_id);
        return view('admin.discount' , [
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
            return redirect()->route('get-owner-discount');
        }
        $admin_user_id = User::where('role','admin')->get()->id;
        $discounts = Discount::where('user_id',Auth::user()->id)->orwhere('user_id',$admin_user_id);
        return view('restaurant_owner.discount' , [
            'discounts' => $discounts,
            'error' => "Percentage can't be 0"
        ]);
        
    }
}

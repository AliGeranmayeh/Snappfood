<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DiscountRequest;

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

    public function post(DiscountRequest $request)
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
        $discounts = Discount::all();
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
            return redirect()->route('get-discount');
        }
        $discounts = Discount::all();
        return view('admin.discount' , [
            'discounts' => $discounts,
            'error' => "Percentage can't be 0"
        ]);
        
    }
}

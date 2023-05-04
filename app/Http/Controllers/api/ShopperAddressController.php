<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class ShopperAddressController extends Controller
{
    public function add(AddressRequest $request)
    {

    if (Address::where('user_id',Auth::user()->id)->where('title',$request->title)) {
        return response()->json([
            "message" => 'This address title already exist.',],406);
    }
    $address = Address::create(array_merge(
        $request->validated(),
        ['user_id' => Auth::user()->id]
    ));
      
    return response()->json([
          "message" => 'new address added',
          'address' => $address
      ],200);
    }
}

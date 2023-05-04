<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Models\Address;

class ShopperAddressController extends Controller
{
    public function add(AddressRequest $request)
    {
      $address = Address::create($request->validated());
      
      return response()->json([
          "message" => 'new address added',
          'address' => $address
      ],200);
    }
}

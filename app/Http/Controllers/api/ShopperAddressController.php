<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateAddressRequest;
use App\Enums\AddressStatusEnum;

class ShopperAddressController extends Controller
{
    public function add(AddressRequest $request)
    {
        if (Address::where('user_id', Auth::user()->id)->where('title', $request->title)->first()) {
            return response()->json([
                "message" => 'This address title already exist.', ], 406);
        }

        if ($request->status == AddressStatusEnum::SET->value && Address::where('user_id', Auth::user()->id)->where('status', AddressStatusEnum::SET->value)->first()) {
            Address::where('user_id', Auth::user()->id)->where('status', AddressStatusEnum::SET->value)->update(['status' => AddressStatusEnum::UNSET->value]);
        }
        $address = Address::create(array_merge(
            $request->validated(),
        ['user_id' => Auth::user()->id]
        ));

        return response()->json([
            "message" => 'new address added',
            'address' => $address
        ], 200);
    }

    public function get()
    {
        return response()->json([
            "message" => Address::where('user_id', Auth::user()->id)->get()], 200);
    }

    public function update(UpdateAddressRequest $request, $address_id)
    {
        if (!Address::where('user_id', Auth::user()->id)->where('id', $address_id)->first()) {
            return response()->json([
                "message" => 'You do not have access to this address'], 403);
        }
        if ($request->has('title') && Address::where('user_id', Auth::user()->id)->where('title', $request->title)->first()) {
            return response()->json([
                "message" => 'This address title already exist.', ], 406);
        }
        if(!Address::find($address_id)){
            return response()->json([
                "message" => 'This address does not exist'], 404);
        }
        if ($request->status == AddressStatusEnum::SET->value) {
            Address::where('user_id', Auth::user()->id)->where('status', AddressStatusEnum::SET->value)->update(['status' => AddressStatusEnum::UNSET->value]);
        }
        Address::where('id', $address_id)->update($request->validated());
        return response()->json([
            "message" => 'current address updated successfully'], 200);

    }
}

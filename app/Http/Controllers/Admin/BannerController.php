<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners =Banner::all();
        return view('admin.banners' , [
            'banners' => $banners,
            'text' => null,
            'id' => null,
            'error' => null
        ]);
    }

    public function post(Request $request)
    {
        if ($request->has('update')) {
            return $this->updateBanners($request);
        }
        elseif ($request->has('edit')) {
            return $this->editBanners($request);   
        }
        elseif ($request->has('delete')) {
            return $this->deleteBanners($request);
        }
        elseif ($request->has('create')) {
            return $this->createBanners($request);
        }

        return redirect()->route('get-banners');
    }
}

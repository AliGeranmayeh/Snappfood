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
            return $this->updateBanner($request);
        }
        elseif ($request->has('edit')) {
            return $this->editBanner($request);   
        }
        elseif ($request->has('delete')) {
            return $this->deleteBanner($request);
        }
        elseif ($request->has('create')) {
            return $this->createBanner($request);
        }

        return redirect()->route('get-banners');
    }

    public function createBanner($data)
    {
        Banner::create([
            'text' => $data->text
        ]);
        $banners = Banner::all();
        return view('admin.banners' , [
            'banners' => $banners,
            'text' => null,
            'id' => null,
            'error' => 'A new banner created'
        ]);
    }
}

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
}

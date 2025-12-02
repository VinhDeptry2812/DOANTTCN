<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Product;

class HomePageController extends Controller
{
    public function index()
    {
        $products = Product::with(['category','images'])
                    ->orderBy('id', 'asc')
                    ->take(5)
                    ->get();

        $carouselBanners = Banner::where('position', 'header-top')->where('status', 1)->get();

        $banner1 = Banner::where('position', 'middle-1')->where('status',1)->get();
        $banner2 = Banner::where('position', 'middle-2')->where('status',1)->get();
        $banner3 = Banner::where('position', 'middle-3')->where('status',1)->get();
        return view('component.layout', compact('products','carouselBanners','banner1','banner2','banner3',));
    }

}

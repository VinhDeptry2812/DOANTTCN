<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Product;

class HomePageController extends Controller
{
    public function index()
    {
        $products_nam = Product::with(['category', 'images'])
            ->whereHas('category', function ($q) {
                $q->where('id', 1);
            })
            ->take(5)
            ->get();
        $products_nu = Product::with(['category', 'images'])
            ->whereHas('category', function ($q) {
                $q->where('id', 2);
            })
            ->take(5)
            ->get();
        $products_treem = Product::with(['category', 'images'])
            ->whereHas('category', function ($q) {
                $q->where('id', 3);
            })
            ->take(5)
            ->get();



        $carouselBanners = Banner::where('position', 'header-top')->where('status', 1)->get();

        $banner1 = Banner::where('position', 'middle-1')->where('status', 1)->get();
        $banner2 = Banner::where('position', 'middle-2')->where('status', 1)->get();
        $banner3 = Banner::where('position', 'middle-3')->where('status', 1)->get();
        return view('component.layout', compact('products_nam','products_nu','products_treem', 'carouselBanners', 'banner1', 'banner2', 'banner3',));
    }


    public function productdetail($id){
        $product_info = Product::with('images')->findOrFail($id);

        return view('component.productdetail',compact('product_info'));
    }
}

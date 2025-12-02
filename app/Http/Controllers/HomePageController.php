<?php

namespace App\Http\Controllers;

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
        
        return view('component.layout', compact('products'));
    }

}

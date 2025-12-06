<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
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
        $categories = Category::all();


        $carouselBanners = Banner::where('position', 'header-top')->where('status', 1)->get();

        $banner1 = Banner::where('position', 'middle-1')->where('status', 1)->get();
        $banner2 = Banner::where('position', 'middle-2')->where('status', 1)->get();
        $banner3 = Banner::where('position', 'middle-3')->where('status', 1)->get();
        return view('component.layout', compact(
            'products_nam',
            'products_nu',
            'products_treem',
            'carouselBanners',
            'banner1',
            'banner2',
            'banner3',
            'categories',
        ));
    }


    public function productdetail($id)
    {
        $product_info = Product::with('images')->findOrFail($id);
        $categories = Category::all();

        return view('component.productdetail', compact('product_info', 'categories'));
    }

    function removeAccents($str)
    {
        $unwanted_array = [
            'á' => 'a',
            'ặ' => 'a',
            'â' => 'a',
            'ấ' => 'a',
            'ầ' => 'a',
            'ẩ' => 'a',
            'ẫ' => 'a',
            'ậ' => 'a',
            'đ' => 'd',
            'é' => 'e',
            'è' => 'e',
            'à' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'ạ' => 'a',
            'ă' => 'a',
            'ắ' => 'a',
            'ằ' => 'a',
            'ẳ' => 'a',
            'ẵ' => 'a',
            'ẻ' => 'e',
            'ẽ' => 'e',
            'ẹ' => 'e',
            'ê' => 'e',
            'ế' => 'e',
            'ề' => 'e',
            'ể' => 'e',
            'ễ' => 'e',
            'ệ' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ị' => 'i',
            'ó' => 'o',
            'ò' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ọ' => 'o',
            'ô' => 'o',
            'ố' => 'o',
            'ồ' => 'o',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ộ' => 'o',
            'ơ' => 'o',
            'ớ' => 'o',
            'ờ' => 'o',
            'ở' => 'o',
            'ỡ' => 'o',
            'ợ' => 'o',
            'ú' => 'u',
            'ù' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ụ' => 'u',
            'ư' => 'u',
            'ứ' => 'u',
            'ừ' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ự' => 'u',
            'ý' => 'y',
            'ỳ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'ỵ' => 'y'
        ];
        return strtr($str, $unwanted_array);
    }


    public function indexAll(Request $request)
    {
        $query = Product::query()->with('category');

        // Nếu có category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Nếu có search
        $keyword = $this->removeAccents(strtolower(trim($request->search)));
        $words = explode(' ', $keyword);

        $query->where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->where(function ($sub) use ($word) {
                    $sub->whereRaw('LOWER(name) like ?', ["%{$word}%"])
                        ->orWhereRaw('LOWER(decription) like ?', ["%{$word}%"]);
                });
            }
        });



        $products = $query->get();
        $categories = Category::all();
        $currentCategory = $request->category ? Category::find($request->category) : null;

        return view('component.allproduct', compact('products', 'categories', 'currentCategory'));
    }
}

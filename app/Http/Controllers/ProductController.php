<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get(); // load category luôn
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $imagePath = null;

        // Chỉ xử lý ảnh khi có file được upload
         if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // tạo tên file duy nhất
            $file->move(public_path('uploads/products'), $filename); // lưu vào public/uploads
            $imagePath = $filename; // đường dẫn để lưu vào DB
        }

        Product::create([
            'name' => $request->name,
            'decription' => $request->decription,
            'image' => $imagePath,
            'slug' => Str::slug($request->name),
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('product.index')->with('success', 'Them san pham thanh cong!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update($id,ProductRequest $request){
        $product = Product::findOrFail($id);

         $product->update([
            'name' => $request->get('name'),
            'decription' =>$request->get('decription'),
            'image' => $request->get('image'),
            'stock' => $request->get('stock'),
            'price' => $request->get('price'),
            'category_id' => $request->get('category_id'),
         ]);
         return redirect()->route('product.index')->with('success', 'Update san pham thanh cong!');
    }

    // public function delete($id)

    // {
    //     $product = Product::findOrFail($id);
    //     $product->delete();
    //     return back()->with('success', 'Xoa san pham thanh cong');
    // }
}

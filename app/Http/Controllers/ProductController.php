<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductEditRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class ProductController extends Controller
{


    public function index()
    {
        $products = Product::with(['category', 'images'])->paginate(5); // load category luôn, 5 sản phẩm 1 trang

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {

        $product = Product::create([
            'name' => $request->name,
            'decription' => $request->decription,
            'slug' => Str::slug($request->name),
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'discount_price' => $request->discount_price,
        ]);



        // Lưu ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $destination = public_path('uploads/products');

            // Tự tạo folder nếu chưa có
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            // Lưu vào bảng images
            $product->image = 'uploads/products/' . $fileName;


            $file->move($destination, $fileName);
            $product->save();
        }

        // Lưu gallery 
        if ($request->hasFile('gallery')) {

            $galleryFiles = $request->file('gallery');

            // Đảm bảo gallery là array
            if (!is_array($galleryFiles)) {
                $galleryFiles = [$galleryFiles];
            }

            foreach ($galleryFiles as $img) {
                if ($img->isValid()) {
                    $fileName = uniqid() . '-' . $img->getClientOriginalName();
                    $destination = public_path('uploads/products/gallery');

                    if (!is_dir($destination)) {
                        mkdir($destination, 0777, true);
                    }

                    $product->images()->create([
                        'url_image' => 'uploads/products/gallery/' . $fileName,
                    ]);

                    $img->move($destination, $fileName);
                }
            }
        }





        return redirect()->route('product.index')->with('success', 'Them san pham thanh cong!');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::with('images')->findOrFail($id);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update($id, ProductEditRequest $request)
    {
        $product = Product::with('images')->findOrFail($id);

        // Lưu ảnh
        if ($request->hasFile('image')) {
            //Xoa anh
            $this->delateImage($id);
            $file = $request->file('image');

            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $destination = public_path('uploads/products');

            // Tự tạo folder nếu chưa có
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            // Lưu vào bảng images
            $product->image = 'uploads/products/' . $fileName;


            $file->move($destination, $fileName);
            $product->save();
        }

        // Xử lí xóa ảnh cũ gallery
        if ($request->has('old_gallery')) {
            foreach ($request->delete_old_images as $imageId) {

                $img = ProductImage::find($imageId);

                if ($img) {
                    // xóa khỏi storage
                    if (file_exists(public_path($img->url_image))) {
                        unlink(public_path($img->url_image));
                    }

                    // xóa database
                    $img->delete();
                }
            }
        }


        // Lưu gallery 
        if ($request->hasFile('gallery')) {
            //Xoa gallery
            // $this->delateGallery($id);
            $galleryFiles = $request->file('gallery');

            // Đảm bảo gallery là array
            if (!is_array($galleryFiles)) {
                $galleryFiles = [$galleryFiles];
            }

            foreach ($galleryFiles as $img) {
                if ($img->isValid()) {
                    $fileName = uniqid() . '-' . $img->getClientOriginalName();
                    $destination = public_path('uploads/products/gallery');

                    if (!is_dir($destination)) {
                        mkdir($destination, 0777, true);
                    }

                    $product->images()->create([
                        'url_image' => 'uploads/products/gallery/' . $fileName,
                    ]);

                    $img->move($destination, $fileName);
                }
            }
        }


        $product->update([
            'name' => $request->name,
            'decription' => $request->decription,
            'slug' => Str::slug($request->name),
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'discount_price' => $request->discount_price,
        ]);
        return redirect()->route('product.index')->with('success', 'Update san pham thanh cong!');
    }



    public function delete($id)
    {

        //Xoa anh
        $this->delateImage($id);
        //Xoa gallery
        $this->delateGallery($id);

        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Xoa san pham thanh cong');
    }

    //Xóa ảnh
    public function delateImage($id)
    {
        $product = Product::findOrFail($id);

        // Đường dẫn trong DB đã bao gồm 'uploads/products/...'
        $old_path = public_path($product->image);

        if ($product->image && file_exists($old_path) && !is_dir($old_path)) {
            unlink($old_path);
        }
    }

    //Xóa gallery
    public function delateGallery($id)
    {
        $product = Product::findOrFail($id);

        if ($product->images && $product->images->count() > 0) {
            foreach ($product->images as $img) {
                $old_path = public_path($img->url_image);

                if (file_exists($old_path) && !is_dir($old_path)) {
                    unlink($old_path); // xóa file vật lý
                }

                $img->delete(); // xóa record DB
            }
        }
    }
}

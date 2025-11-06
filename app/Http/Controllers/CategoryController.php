<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\StoraCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoraCategoryRequest $request)
    {

        $imagePath = null;

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // tạo tên file duy nhất
            $file->move(public_path('uploads'), $filename); // lưu vào public/uploads
            $imagePath = $filename; // đường dẫn để lưu vào DB
        }

        Category::create([
            'name' => $request->name,
            'decription' => $request->decription,
            'image' => $imagePath,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Them danh muc thanh cong!');
    }

    public function edit($id){
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update($id,EditCategoryRequest $request){
        $category = Category::findOrFail($id);

         $category->update([
            'name' => $request->get('name'),
            'decription' =>$request->get('decription'),
            'image' => $request->get('image'),
         ]);
         return redirect()->route('categories.index')->with('success', 'Update danh muc thanh cong!');
    }

     public function delete($id)

    {
        $category = Category::findOrFail($id);
        $category->delete();
        return back()->with('success', 'Category deleted!');
    }
}

<?php

namespace App\Http\Controllers;


use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\StoraCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


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

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update($id, EditCategoryRequest $request)
    {
        $category = Category::findOrFail($id);

        

        // Xử lý upload ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu còn
            if ($category->image && file_exists(public_path('uploads/category/' . $category->image))) {
                unlink(public_path('uploads/category/' . $category->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/category'), $filename);

            $category->image = $filename; // cập nhật ảnh mới
        }

        // Cập nhật các field khác
        $category->update([
            'name' => $request->get('name'),
            'decription' => $request->get('decription'),
            'slug' => Str::slug($request->name),
            // 'image' => đã set trực tiếp ở trên
        ]);

        return redirect()->route('categories.index')->with('success', 'Update danh mục thành công!');
    }




    public function delete($id)
    {
        $this->delateImage($id);

        $category = Category::findOrFail($id);
        $category->delete();
        return back()->with('success', 'Category deleted!');
    }

    //Xóa ảnh
    public function delateImage($id)
    {
        $category = Category::findOrFail($id);
        $old_path = public_path('uploads/category/' . $category->image);
        if (!empty($category->image) && file_exists($old_path) && !is_dir($old_path)) {
            unlink($old_path);
        }

        //if kiểm tra ảnh hiện tại có rỗng không, đường dẫn có không, 
        //và đảm bảo đường dẫn đó không phải thư mục thì xóa tránh lỗi
    }
}

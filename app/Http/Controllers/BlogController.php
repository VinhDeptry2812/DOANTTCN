<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update($id, BlogRequest $request)
    {
        $blog = Blog::findOrFail($id);

        $data = [
            'title'       => $request->title,
            'content'     => $request->content,
            'category_id' => $request->category_id,
            'status'      => $request->status,
        ];

        // Nếu có ảnh mới
        if ($request->hasFile('image')) {
             // Xoá ảnh cũ
            $this->delateImage($id);

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Gắn vào mảng update
            $data['thumbnail'] = 'blogs/' . $filename;
            // Lưu đúng thư mục
            $file->move(public_path('blogs'), $filename);

           
        }

        // Cập nhật 1 lần duy nhất
        $blog->update($data);

        return redirect()->route('blog.index')->with('success', 'Cập nhật thành công!');
    }

    public function store(BlogRequest $request)
    {

        // Lưu blog
        $blog = Blog::create([
            'title'        => $request->title,
            'content'      => $request->content,
            'category_id'  => $request->category_id,
            'status'       => $request->status,
        ]);
        // Lưu ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $destination = public_path('blogs');

            // Tự tạo folder nếu chưa có
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            // Lưu vào bảng blog
            $blog->thumbnail = 'blogs/' . $fileName;


            $file->move($destination, $fileName);
            $blog->save();
        }
        return redirect()->route('blog.index')
            ->with('success', 'Tạo bài viết thành công!');
    }



    public function delete($id)
    {
        $blog = Blog::findOrFail($id);

        $this->delateImage($id);
        // Xóa thumbnail nếu có
        if ($blog->thumbnail && file_exists(public_path($blog->thumbnail))) {
            unlink(public_path($blog->thumbnail));
        }

        $blog->delete();

        return redirect()->route('blog.index')
            ->with('success', 'Xóa bài viết thành công!');
    }

    //Xóa ảnh
    public function delateImage($id)
    {
        $product = Blog::findOrFail($id);

        // Đường dẫn trong DB đã bao gồm 'uploads/products/...'
        $old_path = public_path($product->thumbnail);

        if ($product->thumbnail && file_exists($old_path) && !is_dir($old_path)) {
            unlink($old_path);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::all();
        return view('admin.banner.index', compact('banner'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(BannerRequest $request)
    {
        $banner = new Banner();
        $banner->position = $request->position;
        $banner->status = $request->status;

        // Lưu ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $destination = public_path('banner/');

            // Tự tạo folder nếu chưa có
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }


            $banner->image = 'banner/' . $fileName;


            $file->move($destination, $fileName);
        }

        $banner->save();



        return redirect()->route('banner.index')->with('success', 'Them banner thanh cong!');
    }


    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        return view('admin.banner.edit', compact('banner'));
    }

    

    public function update($id, BannerRequest $request)
    {
        $banner = Banner::findOrFail($id);

        $data = [
            'status' => $request->status,
        ];

        // Nếu có ảnh mới
        if ($request->hasFile('image')) {
            // Xoá ảnh cũ
            $this->delateImage($id);

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Lưu đúng thư mục
            $file->move(public_path('banner'), $filename);

            // Gắn vào mảng update
            $data['image'] = 'banner/' . $filename;
        }

        // Cập nhật 1 lần duy nhất
        $banner->update($data);

        return redirect()->route('banner.index')->with('success', 'Sửa banner thành công!');
    }


    public function delete($id)
    {

        $this->delateImage($id);


        $banner = Banner::findOrFail($id);
        $this->delateImage($id);
        $banner->delete();

        return back()->with('success', 'Xóa banner thành công');
    }

    //Xóa ảnh
    public function delateImage($id)
    {
        $product = Banner::findOrFail($id);

        $old_path = public_path($product->image);

        if ($product->image && file_exists($old_path) && !is_dir($old_path)) {
            unlink($old_path);
        }
    }
}

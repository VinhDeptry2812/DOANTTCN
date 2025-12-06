<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcountInfoRequest;
use App\Http\Requests\AcountRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AcountController extends Controller
{
    public function index()
    {
        $acounts = User::where('role', 'admin')->get();
        return view('admin.acount.indexAdmin', compact('acounts'));
    }

    public function indexU()
    {
        $acounts = User::where('role', 'user')->get();
        return view('admin.acount.indexUser', compact('acounts'));
    }

    public function indexM()
    {
        $acounts = User::where('role', 'manager')->get();
        return view('admin.acount.index', compact('acounts'));
    }

    public function edit($id)
    {
        $acounts = User::findOrFail($id);
        return view('admin.acount.edit', compact('acounts'));
    }


    public function update(AcountRequest $request, $id)
    {


        // Không cho tự đổi role chính mình (tránh tự khoá acc luôn)
        if ($id == Auth::id()) {
            return abort(403, 'Không thể tự thay đổi vai trò của chính mình');
        }

        // Cập nhật role
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('acount.indexM')->with('success', 'Cập nhật role thành công!');
    }

    public function delete($id)
    {
        $acount = User::findOrFail($id);
        $acount->delete();
        return back()->with(
            'sucssec',
            'Xóa user thành công!'
        );
    }

    public function acount_info()
    {
        $categories = Category::all();

        return view('component.acountpage',compact('categories'));
    }

    public function update_info(AcountInfoRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcountRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AcountController extends Controller
{
    public function index()
    {
        $acounts = User::all();
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

        return redirect()->route('acount.index')->with('success', 'Cập nhật role thành công!');
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
}

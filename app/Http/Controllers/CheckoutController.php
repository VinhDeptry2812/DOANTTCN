<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session('cart', []);
        return view('component.checkout', compact('cartItems'));
    }

    public function process(Request $request)
    {
        $cartItems = session('cart', []);

        if(count($cartItems) == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        // Xử lý đơn hàng: lưu vào DB, gửi email, thanh toán, ...
        // Ví dụ tạm: xóa session giỏ hàng sau khi đặt
        session()->forget('cart');

        return redirect()->route('homepage')->with('success', 'Đặt hàng thành công!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session('cart', []);
        // Tính tạm tính
        $subtotal = collect($cartItems)->sum(function ($item) {
            $price = $item['discount_price'] ?? $item['price'] ?? 0;
            return $price * $item['quantity'];
        });

        return view('component.checkout', compact('cartItems', 'subtotal'));
    }

    public function process(Request $request)
    {
        $cartItems = session('cart', []);

        if (count($cartItems) == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        // Xử lý đơn hàng: lưu vào DB, gửi email, thanh toán, ...
        // Ví dụ tạm: xóa session giỏ hàng sau khi đặt
        session()->forget('cart');

        return redirect()->route('homepage')->with('success', 'Đặt hàng thành công!');
    }
}

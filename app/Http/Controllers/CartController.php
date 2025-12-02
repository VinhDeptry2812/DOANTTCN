<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cartItems = session('cart', []); // Lấy giỏ hàng từ session
        return view('component.cart', compact('cartItems'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request)
    {
        $product = [
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 1,
        ];

        $cart = session('cart', []);
        $cart[$product['id']] = $product; // Thêm hoặc cập nhật sản phẩm
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $cart = session('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return redirect()->back()->with('success', 'Đã xóa sản phẩm!');
    }

    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $cart = session('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session(['cart' => $cart]);
        }
        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\Component;

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

    public function placeOrder(CheckoutRequest $request)
    {
       
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng trống bé ơi!');
        }

        // Tính tổng
        $total = collect($cart)->sum(function ($item) {
            $price = $item['discount_price'] ?? $item['price'] ?? 0;
            return $price * $item['quantity'];
        });

        // Tạo đơn
        $order = Order::create([
            'code' => 'DH' . time(),
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'customer_email' => $request->email,
            'customer_address' => $request->address,
            'total_price' => $total,
            'status' => 'pending',
            'decription' => $request->decription,
        ]);

        
        // Lưu chi tiết đơn
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['discount_price'] ?? $item['price']
            ]);
        }

        

        // Xóa giỏ
        session()->forget('cart');

        return redirect()->route('checkout.list')->with('success', 'Đặt hàng thành công bé iu!');
    }

    public function list(){


        return view('component.ordersuccess');

    }

}

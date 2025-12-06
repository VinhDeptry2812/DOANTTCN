<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cartItems = session('cart', []); // array of items

        $subtotal = collect($cartItems)->sum(function ($item) {
            // dùng discount_price nếu có, fallback qua price, default 0
            $price = $item['discount_price'] ?? $item['price'] ?? 0;
            $qty = $item['quantity'] ?? 0;
            return $price * $qty;
        });

        $categories = Category::all();

        // logic phí ship 
        // 1) miễn phí khi subtotal >= 500k
        // 2) ngược lại 30k
        if ($subtotal >= 500000) {
            $ship = 0;
        } elseif ($subtotal == 0) {
            $ship = 0; // hoặc null nếu muốn ẩn khi giỏ rỗng
        } else {
            $ship = 30000;
        }

        $total = $subtotal + $ship;

        return view('component.cart', compact('cartItems','categories', 'subtotal', 'ship', 'total'));
    }


    public function add(Request $request)
    {
        $p = Product::findOrFail($request->id);

        $cart = session('cart', []);

        $qtyFromFE = max(1, (int)$request->quantity);  // <-- nhận quantity từ FE

        if (isset($cart[$p->id])) {
            $cart[$p->id]['quantity'] += $qtyFromFE;
        } else {
            $cart[$p->id] = [
                'id' => $p->id,
                'name' => $p->name,
                'discount_price' => $p->discount_price,
                'quantity' => $qtyFromFE,     // ⭐ SỬA TẠI ĐÂY
                'image' => $p->image,
            ];
        }

        session(['cart' => $cart]);

        return response()->json([
            'message' => 'Đã thêm vào giỏ hàng!',
            'count' => count($cart)
        ]);
    }




    public function remove(Request $request)
    {
        $cart = session('cart', []);

        $id = $request->id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session(['cart' => $cart]);

        // Tính lại totals
        $subtotal = collect($cart)->sum(fn($i) => $i['discount_price'] * $i['quantity']);
        $ship = $subtotal > 0 ? 30000 : 0;
        $total = $subtotal + $ship;

        return response()->json([
            'subtotal' => $subtotal,
            'ship' => $ship,
            'total' => $total
        ]);
    }


    public function update(Request $request)
    {
        $cart = session('cart', []);

        $id = $request->id;
        $type = $request->type; // plus / minus

        if (!isset($cart[$id])) {
            return response()->json(['error' => 'Item not found']);
        }

        if ($type === 'plus') {
            $cart[$id]['quantity']++;
        } else {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
        }

        session(['cart' => $cart]);

        // Tính lại totals
        $subtotal = collect($cart)->sum(fn($i) => $i['discount_price'] * $i['quantity']);
        $ship = $subtotal > 0 ? 30000 : 0;
        $total = $subtotal + $ship;

        return response()->json([
            'qty' => $cart[$id]['quantity'],
            'subtotal' => $subtotal,
            'item_price' => $cart[$id]['discount_price'],
            'ship' => $ship,
            'total' => $total
        ]);
    }
}

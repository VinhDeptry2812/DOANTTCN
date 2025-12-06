<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Voucher;
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

        return redirect()->route('checkout.list', ['id' => $order->id])->with('success', 'Đặt hàng thành công bé iu!');
    }

    public function list($id)
    {
        $order = Order::findOrFail($id);
        $categories = Category::all();

        return view('component.ordersuccess', compact('order', 'categories'));
    }

    public function applyDiscount(Request $request)
    {
        $code = $request->code;
        $cart = session('cart', []);

        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng trống bé ơi!']);
        }

        $today = now()->format('Y-m-d H:i:s');

        $voucher = Voucher::where('code', $code)
            ->where('status', '1')
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->whereColumn('usage_count', '<', 'usage_limit')
            ->first();

        if (!$voucher) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không hợp lệ hoặc hết hạn']);
        }

        $subtotal = collect($cart)->sum(fn($item) => ($item['discount_price'] ?? $item['price']) * $item['quantity']);

        if ($voucher->min_order_value && $subtotal < $voucher->min_order_value) {
            return response()->json([
                'success' => false,
                'message' => "Đơn hàng phải ≥ {$voucher->min_order_value}₫ để áp dụng mã này"
            ]);
        }

        // Tính giảm giá
        if ($voucher->type === 'percent') {
            $discount_amount = $subtotal * $voucher->value / 100;
            if ($voucher->max_discount) {
                $discount_amount = min($discount_amount, $voucher->max_discount);
            }
        } else {
            $discount_amount = $voucher->value;
        }

        $total = max($subtotal - $discount_amount, 0);

        session(['discount_code' => $voucher->code, 'discount_amount' => $discount_amount]);

        $ship = 0; // tính logic ship nếu muốn

        return response()->json([
            'success' => true,
            'subtotal' => $subtotal,
            'discount_amount' => $discount_amount,
            'ship' => $ship,
            'total' => $total
        ]);
    }
}

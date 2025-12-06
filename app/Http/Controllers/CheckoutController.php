<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session('cart', []) ?? [];

        // Lấy thông tin voucher đã áp dụng
        $discount = session('discount', ['code' => null, 'amount' => 0]);
        $discount_amount = $discount['amount'] ?? 0;

        // Lấy % giảm (nếu voucher là percent)
        $discount_percent = session('discount_percent', 0);

        $ship = 30000; // phí ship cố định

        // Tính giá cho từng sp sau khi áp dụng mã giảm
        $cartItemsWithDiscount = collect($cartItems)->map(function ($item) use ($discount_percent) {
            $original_price = $item['discount_price'] ?? $item['price'] ?? 0;
            $qty = $item['quantity'];
            $subtotal_item = $original_price * $qty;

            // Tính giảm giá theo %
            $discount_item = $subtotal_item * $discount_percent / 100;

            return array_merge($item, [
                'original_total' => $subtotal_item,
                'discounted_total' => max($subtotal_item - $discount_item, 0),
                'image' => $item['image'] ?? '/images/default.png',
            ]);
        });

        // Tạm tính tổng gốc và tổng sau giảm
        $subtotal = $cartItemsWithDiscount->sum('original_total');
        $total_after_discount = $cartItemsWithDiscount->sum('discounted_total');
        $total = $total_after_discount + $ship;

        return view('component.checkout', compact(
            'cartItemsWithDiscount',
            'subtotal',
            'discount_amount',
            'ship',
            'total',
            'cartItems'
        ));
    }



    public function placeOrder(CheckoutRequest $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng trống bé ơi!');
        }

        // Tính tổng
        $subtotal = collect($cart)->sum(function ($item) {
            $price = $item['discount_price'] ?? $item['price'] ?? 0;
            return $price * $item['quantity'];
        });

        $discount = session('discount', ['code' => null, 'amount' => 0]);
        $total = max($subtotal - $discount['amount'], 0) + 30000; // cộng ship

        // Tạo đơn hàng
        $order = Order::create([
            'code' => 'DH' . time(),
            'user_id' => Auth::id(),
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'customer_email' => $request->email,
            'customer_address' => $request->address,
            'total_price' => $total,
            'discount_code' => $discount['code'],
            'discount_amount' => $discount['amount'],
            'status' => 'pending',
            'decription' => $request->decription,
        ]);

        // Tăng lượt dùng của voucher nếu có
        if (!empty($discount['code'])) {
            $voucher = Voucher::where('code', $discount['code'])->first();

            if ($voucher) {
                $voucher->increment('usage_count', 1);
            }
        }


        // Lưu chi tiết đơn
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['discount_price'] ?? $item['price']
            ]);
        }


        // Xóa giỏ và mã giảm
        session()->forget('cart');
        session()->forget('discount');
        session()->forget('discount_percent');


        return redirect()->route('checkout.list', ['id' => $order->id])
            ->with('success', 'Đặt hàng thành công bé iu!');
    }


    public function list($id)
    {
        $order = Order::findOrFail($id);

        return view('component.ordersuccess', compact('order'));
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

            session(['discount_percent' => $voucher->value]);
        } else {
            $discount_amount = $voucher->value;
            session(['discount_percent' => 0]);
        }

        // Ship mặc định
        $ship = 30000;

        $total = max($subtotal - $discount_amount, 0) + $ship;

        // Lưu session
        session(['discount' => [
            'code' => $voucher->code,
            'amount' => $discount_amount
        ]]);

        return response()->json([
            'success' => true,
            'subtotal' => $subtotal,
            'discount_amount' => $discount_amount,
            'ship' => $ship,
            'total' => $total
        ]);
    }
}

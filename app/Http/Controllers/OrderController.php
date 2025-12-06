<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function order_history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->get();

        return view('component.orderHistory',compact('orders'));
    }

    public function order_history_detail($id)
    {
       $order = Order::findOrFail($id);

        return view('component.orderHistorydetail',compact('order'));
    }



    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.edit', compact('order'));
    }

    public function update($id, Request $req)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => $req->status,
        ]);

        return redirect()->route('order.index')->with('success', 'Update đơn hàng thành công!');
    }
}

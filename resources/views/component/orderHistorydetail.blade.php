@extends('component.mainlayout')
@section('title', 'Chi tiết đơn hàng')
@section('content')

<main class="max-w-screen-xl mx-auto px-4 lg:px-10 py-8">

    <h1 class="text-2xl font-bold mb-6">Chi tiết đơn hàng #{{ $order->code }}</h1>

    <div class="grid md:grid-cols-2 gap-6">

        {{-- THÔNG TIN ĐƠN HÀNG --}}
        <div class="bg-white p-5 rounded-xl shadow-sm">
            <h2 class="font-semibold text-lg mb-4">Thông tin đơn hàng</h2>

            <div class="space-y-2 text-sm">
                <p><strong>Người nhận:</strong> {{ $order->customer_name }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                <p><strong>Ghi chú:</strong> {{ $order->description ?? 'Không có' }}</p>
                <p>
                    <strong>Trạng thái:</strong>
                    <span class="font-semibold 
                        @if($order->status == 'pending') text-blue-600
                        @elseif($order->status == 'confirmed') text-green-600
                        @elseif($order->status == 'transit') text-yellow-600
                        @else text-red-600
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        {{-- SẢN PHẨM TRONG ĐƠN --}}
        <div class="bg-white p-5 rounded-xl shadow-sm">
            <h2 class="font-semibold text-lg mb-4">Sản phẩm trong đơn</h2>

            <div class="space-y-4">
                @foreach ($order->items as $item)
                    <div class="flex items-center gap-4 border-b pb-3">
                        <img src="{{ $item->product_image }}" class="w-16 h-16 rounded-lg object-cover" alt="">
                        <div class="flex-1 text-sm">
                            <p class="font-semibold">{{ $item->product_name }}</p>
                            <p>Số lượng: {{ $item->quantity }}</p>
                            <p>Giá: {{ format_price($item->price) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 border-t pt-3 text-right text-sm font-semibold space-y-1">
                 <p>Phí ship: {{ format_price('30000') }}</p>
                <p>Giảm giá: -{{ format_price($order->discount_amount) }}</p>
                <p class="text-lg font-bold">Tổng: {{ format_price($order->total_price) }}</p>
            </div>

        </div>

    </div>

</main>

@endsection

@extends('component.mainlayout')
@section('title', 'Đơn hàng')

@section('content')

    <div class="max-w-5xl mx-auto py-10">

        <!-- Title -->
        <h1 class="text-2xl font-bold mb-6">Lịch sử đơn hàng</h1>

        <!-- Nếu không có đơn -->
        @if ($orders->isEmpty())
            <div class="text-center py-10 text-gray-500">
                Bạn chưa có đơn hàng nào 😢
                <a href="/products" class="text-blue-500 underline">Mua sắm ngay</a>
            </div>
        @endif

        <!-- Danh sách đơn -->
        <div class="space-y-6">
            @foreach ($orders as $order)
                <div class="border rounded-lg p-5 bg-white shadow-sm hover:shadow-md transition">

                    <!-- Info -->
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-lg">Đơn #{{ $order->code }}</p>
                            <p class="text-sm text-gray-500">
                                Ngày đặt: {{ $order->created_at->format('d/m/Y - H:i') }}
                            </p>
                            <p class="text-sm mt-1">
                                Trạng thái:
                                <span
                                    class="font-semibold 
                                @if ($order->status == 'pending') text-blue-500
                                @elseif($order->status == 'transit') text-yellow-500
                                @elseif($order->status == 'confirmed') text-green-600
                                @else text-gray-500 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-lg font-semibold text-orange-600">
                                {{ format_price($order->total_price) }}
                            </p>

                            <a href="{{route('order.history_detail',['id'=>$order->id])}}"
                                class="mt-3 inline-block px-4 py-2 text-sm bg-yellow-400 text-white rounded-md hover:bg-yellow-500">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>

@endsection

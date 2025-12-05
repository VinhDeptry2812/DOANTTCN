@extends('admin.dashboard')

@section('contents')
    <section class="p-8">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">
                Chi tiết đơn hàng – {{ $order->code }}
            </h1>

            <a href="{{ route('order.index') }}"
                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                ← Trở về
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT: ORDER INFO -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Order Info -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Thông tin đơn hàng</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <p class="text-sm text-gray-500">Mã đơn hàng</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $order->code }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Ngày đặt hàng</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $order->created_at }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Tổng giá đơn hàng</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ format_price($order->total_price) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Trạng thái</p>
                            <span
                                class="
                            px-3 py-1 mt-1 rounded-full text-xs font-medium
                            @if ($order->status === 'pending') bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300
                            @elseif ($order->status === 'transit') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300
                            @elseif ($order->status === 'confirmed') bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300
                            @elseif ($order->status === 'cancelled') bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300 @endif
                        ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                    </div>
                </div>

                <!-- Items List -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Items in Order</h2>

                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="pb-3 text-left text-gray-500">Sản phẩn</th>
                                <th class="pb-3 text-center text-gray-500">Số lượng</th>
                                <th class="pb-3 text-right text-gray-500">Giá</th>
                                <th class="pb-3 text-right text-gray-500">Tổng</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y dark:divide-gray-700">

                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="py-3 font-medium text-gray-900 dark:text-white">
                                        {{ $item->product->name }}
                                    </td>

                                    <td class="py-3 text-center text-gray-700 dark:text-gray-300">
                                        {{ $item->quantity }}
                                    </td>

                                    <td class="py-3 text-right text-gray-700 dark:text-gray-300">
                                        {{ format_price($item->price) }}
                                    </td>

                                    <td class="py-3 text-right font-semibold text-gray-900 dark:text-white">
                                        {{ format_price($item->quantity * $item->price) }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="text-right mt-4 border-t pt-4 dark:border-gray-700">
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            Tổng: {{ format_price($order->total_price) }}
                        </p>
                    </div>
                </div>

            </div>

            <!-- RIGHT: CUSTOMER INFO -->
            <div class="space-y-6">

                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Thông tin khách hàng</h2>

                    <div class="space-y-4">

                        <div>
                            <p class="text-sm text-gray-500">Tên</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $order->customer_name }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Điện thoại</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $order->customer_phone }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $order->customer_email }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Địa chỉ</p>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ $order->customer_address }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>
@endsection

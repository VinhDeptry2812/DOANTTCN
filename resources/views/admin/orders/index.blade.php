@extends('admin.dashboard')

@section('contents')
<section class="p-8">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Orders</h1>

        <div class="flex items-center gap-3">
            <!-- Search -->
            <input type="text" placeholder="Search orders..."
                class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                       bg-white dark:bg-gray-800 text-sm w-48
                       focus:ring-2 focus:ring-gray-900/10 dark:focus:ring-gray-600
                       focus:border-gray-400 dark:text-gray-200" />

            <!-- Filter -->
            <select
                class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600
                       bg-white dark:bg-gray-800 text-sm
                       focus:ring-2 focus:ring-gray-900/10 dark:focus:ring-gray-600
                       focus:border-gray-400 dark:text-gray-200">
                <option value="">All statuses</option>
                <option value="pre">Pre-order</option>
                <option value="transit">In transit</option>
                <option value="confirmed">Confirmed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
    </div>

    <!-- TABLE WRAPPER -->
    <div class="rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-800/70">
                <tr>
                    <th class="px-6 py-4 text-left font-medium text-gray-700 dark:text-gray-300">Order ID</th>
                    <th class="px-6 py-4 text-left font-medium text-gray-700 dark:text-gray-300">Date</th>
                    <th class="px-6 py-4 text-left font-medium text-gray-700 dark:text-gray-300">Total</th>
                    <th class="px-6 py-4 text-left font-medium text-gray-700 dark:text-gray-300">Status</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                @forelse ($orders as $order)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-colors">

                    <!-- ID -->
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                        {{ $order->code }}
                    </td>

                    <!-- Date -->
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                        {{ $order->created_at }}
                    </td>

                    <!-- Total -->
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-gray-100">
                        {{ format_price($order->total_price) }}
                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-4">
                        @if ($order->status === 'pending')
                            <span class="px-3 py-1 mt-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300">
                                Pending
                            </span>
                        @elseif ($order->status === 'transit')
                            <span class="px-3 py-1 mt-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-300">
                                In transit
                            </span>
                        @elseif ($order->status === 'confirmed')
                            <span class="px-3 py-1 mt-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300">
                                Confirmed
                            </span>
                        @elseif ($order->status === 'cancelled')
                            <span class="px-3 py-1 mt-1 rounded-full text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-400">
                                Cancelled
                            </span>
                        @endif
                    </td>

                    <!-- ACTIONS -->
                    <td class="px-4 py-3 relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-8 h-8 flex items-center justify-center
                                   text-gray-500 dark:text-gray-300
                                   hover:text-blue-600 dark:hover:text-blue-400
                                   hover:bg-gray-100 dark:hover:bg-gray-700/60
                                   rounded-full transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 7h14M5 12h14M5 17h10" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.outside="open=false" x-transition
                            class="absolute top-[-35px] left-0 mt-1 w-36 
                                   bg-white dark:bg-gray-700 
                                   border border-gray-200 dark:border-gray-600
                                   rounded-md shadow-lg z-20 overflow-hidden">

                            <a href="{{ route('order.show', ['id' => $order->id]) }}"
                                class="block px-4 py-2 text-sm text-blue-600 dark:text-blue-300 
                                       hover:bg-blue-50 dark:hover:bg-gray-600">
                                View
                            </a>

                            <a href="{{ route('order.edit', ['id' => $order->id]) }}"
                                class="block px-4 py-2 text-sm text-amber-600 dark:text-amber-300 
                                       hover:bg-amber-50 dark:hover:bg-gray-600">
                                Edit
                            </a>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">
                        Không có đơn hàng
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>

</section>
@endsection

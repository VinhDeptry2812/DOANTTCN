@extends('admin.dashboard')

@section('contents')
    <section class="p-8">

        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">
                Edit Order #{{ $order->code }}
            </h1>
            <a href="{{ route('order.index') }}"
                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                ← Back
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow">

            <form action="{{ route('order.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Order Code -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Order Code</label>
                        <input type="text" value="{{ $order->code }}" disabled
                            class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:border-gray-600" />
                    </div>

                    <!-- Created At -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Created At</label>
                        <input type="text" value="{{ $order->created_at }}" disabled
                            class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:border-gray-600" />
                    </div>

                    <!-- Total Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Total Price</label>
                        <input type="text" value="{{ format_price($order->total_price) }}" disabled
                            class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:border-gray-600" />
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Order Status</label>

                        <select name="status"
                            class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pre-order</option>
                            <option value="transit" {{ $order->status == 'transit' ? 'selected' : '' }}>In transit</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                            </option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('order.index') }}"
                        class="px-5 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600">
                        Cancel
                    </a>

                    <button type="submit" class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                        Update Order
                    </button>
                </div>

            </form>

        </div>

    </section>
@endsection

@extends('component.mainlayout')
@section('title', 'Đặt hàng thành công')
@section('content')
    
<section class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-10">
    <div class="bg-white shadow-xl rounded-2xl p-10 max-w-xl w-full text-center border border-gray-200">

        <!-- Icon + title -->
        <div class="flex flex-col items-center">
            <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>

            <h1 class="text-3xl font-semibold text-gray-900 mb-2">
                Order Placed Successfully!
            </h1>

            <p class="text-gray-600">
                Thank you for your purchase. Your order has been received and is now being processed.
            </p>
        </div>

        <!-- Order info -->
        <div class="mt-10 bg-gray-50 rounded-xl p-6 text-left border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Details</h2>

            <div class="space-y-3 text-gray-700">
                <p class="flex justify-between text-sm">
                    <span class="text-gray-500">Order ID:</span>
                    <span class="font-medium text-gray-900">#FWB127364372</span>
                </p>

                <p class="flex justify-between text-sm">
                    <span class="text-gray-500">Customer:</span>
                    <span class="font-medium">Nguyen Van A</span>
                </p>

                <p class="flex justify-between text-sm">
                    <span class="text-gray-500">Total:</span>
                    <span class="font-semibold text-green-600">$129.99</span>
                </p>

                <p class="flex justify-between text-sm">
                    <span class="text-gray-500">Payment Status:</span>
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                        Paid
                    </span>
                </p>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/orders"
                class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-black transition shadow-sm">
                View All Orders
            </a>

            <a href="{{route('homepage')}}"
                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">
                Continue Shopping
            </a>
        </div>

    </div>
</section>


@endsection

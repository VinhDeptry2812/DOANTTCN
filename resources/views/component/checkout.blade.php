@extends('component.mainlayout')
@section('title', 'Thanh toán')
@section('content')
    {{-- MAIN CONTENT --}}
    <main class="max-w-screen-xl mx-auto px-4 lg:px-10 py-8">

        <h1 class="text-2xl font-bold mb-6">Thanh toán</h1>

        @if (count($cartItems) > 0)
            <div class="grid md:grid-cols-2 gap-6">
                {{-- Giỏ hàng --}}
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <h2 class="font-semibold mb-4">Giỏ hàng của bạn</h2>
                    @if (!empty($cartItems) && count($cartItems) > 0)
                        <table class="w-full text-sm">
                            <thead class="border-b">
                                <tr>
                                    <th class="text-left py-2">Sản phẩm</th>
                                    <th class="text-center py-2">Số lượng</th>
                                    <th class="text-right py-2">Giá gốc</th>
                                    <th class="text-right py-2">Giá sau giảm</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItemsWithDiscount as $item)
                                    <tr class="border-b">
                                        <td class="py-2 flex items-center gap-2">
                                            <img src="{{ $item['image'] }}" class="w-12 h-12 object-cover rounded"
                                                alt="{{ $item['name'] }}">
                                            {{ $item['name'] }}
                                        </td>
                                        <td class="text-center py-2">{{ $item['quantity'] }}</td>
                                        <td class="text-right py-2">{{ format_price($item['original_total']) }}</td>
                                        <td class="text-right py-2">{{ format_price($item['discounted_total']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Giỏ hàng của bạn đang trống.</p>
                    @endif

                    <div class="mt-4 text-right font-semibold space-y-1">
                        <div>Tạm tính: {{ format_price($subtotal) }}</div>
                        <div>Giảm giá: -{{ format_price($discount_amount) }}</div>
                        <div>Phí vận chuyển: {{ format_price($ship) }}</div>
                        <div class="text-lg font-bold">Tổng cộng: {{ format_price($total) }}</div>
                    </div>

                </div>

                {{-- Thông tin thanh toán --}}
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <h2 class="font-semibold mb-4">Thông tin người nhận</h2>
                    <form id="checkout-form" action="{{ route('checkout.placeOrder') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-1">Họ và tên</label>
                            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-1">Số điện thoại</label>
                            <input type="text" name="phone" class="w-full border rounded px-3 py-2" required>
                             @error('phone')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-1">Địa chỉ</label>
                            <input name="address" class="w-full border rounded px-3 py-2" rows="3" required></input>
                             @error('address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-1">Ghi chú (tùy chọn)</label>
                            <textarea name="decription" class="w-full border rounded px-3 py-2" rows="2"></textarea>
                        </div>

                        <button type="submit"
                            class="mt-4 w-full py-3 rounded-full bg-[#ff9b0d] hover:bg-[#f79400] text-white font-semibold text-sm uppercase tracking-wide">
                            Đặt hàng
                        </button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center text-gray-500">Giỏ hàng của bạn đang trống.</p>
        @endif

    </main>

@endsection

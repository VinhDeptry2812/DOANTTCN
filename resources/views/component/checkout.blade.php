<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - YODY</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

{{-- HEADER / NAV --}}
<header class="shadow-sm bg-[#f9d800] sticky top-0 z-50">
    <nav class="px-4 lg:px-10 py-3">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            {{-- LOGO --}}
            <a href="{{ route('homepage') }}" class="flex items-center">
                <img src="{{ asset('logo/Screenshot_2025-11-23_184019-removebg-preview.png') }}"
                     alt="YODY Logo" class="h-10 w-auto object-contain">
                <b class="ml-1">YODY</b>
            </a>

            {{-- MENU --}}
            <ul class="hidden lg:flex flex-wrap items-center text-sm font-semibold uppercase">
                <li class="mr-6"><a href="#section-men" class="hover:underline underline-offset-4">Nam</a></li>
                <li class="mr-6"><a href="#section-women" class="hover:underline underline-offset-4">Nữ</a></li>
                <li class="mr-6"><a href="#section-kids" class="hover:underline underline-offset-4">Trẻ em</a></li>
                <li class="mr-6"><a href="#section-collection" class="hover:underline underline-offset-4">Bộ sưu tập</a></li>
                <li class="mr-6"><a href="#" class="hover:underline underline-offset-4">Sale</a></li>
            </ul>
        </div>
    </nav>
</header>

{{-- MAIN CONTENT --}}
<main class="max-w-screen-xl mx-auto px-4 lg:px-10 py-8">

    <h1 class="text-2xl font-bold mb-6">Thanh toán</h1>

    @if(count($cartItems) > 0)
        <div class="grid md:grid-cols-2 gap-6">
            {{-- Giỏ hàng --}}
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <h2 class="font-semibold mb-4">Giỏ hàng của bạn</h2>
                <table class="w-full text-sm">
                    <thead class="border-b">
                        <tr>
                            <th class="text-left py-2">Sản phẩm</th>
                            <th class="text-center py-2">Số lượng</th>
                            <th class="text-right py-2">Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr class="border-b">
                            <td class="py-2">{{ $item['name'] }}</td>
                            <td class="text-center py-2">{{ $item['quantity'] }}</td>
                            <td class="text-right py-2">{{ number_format($item['price'],0,',','.') }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 text-right font-semibold">
                    Tổng tiền: {{ number_format($cartSubtotal,0,',','.') }}đ
                </div>
            </div>

            {{-- Thông tin thanh toán --}}
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <h2 class="font-semibold mb-4">Thông tin người nhận</h2>
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Họ và tên</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Số điện thoại</label>
                        <input type="text" name="phone" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Địa chỉ</label>
                        <textarea name="address" class="w-full border rounded px-3 py-2" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Ghi chú (tùy chọn)</label>
                        <textarea name="note" class="w-full border rounded px-3 py-2" rows="2"></textarea>
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

{{-- FOOTER --}}
<footer class="bg-white mt-10 border-t border-gray-200">
    <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-8 text-sm text-gray-500 text-center">
        © {{ date('Y') }} YODY. All Rights Reserved.
    </div>
</footer>

</body>
</html>

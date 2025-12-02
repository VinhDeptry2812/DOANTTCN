<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Giỏ hàng - YODY Shop</title>
</head>

<body class="bg-gray-100 text-gray-800">
{{-- HEADER YODY STYLE --}}
<header class="shadow-sm bg-[#f9d800]">

    {{-- MAIN NAV --}}
    <nav class="fixed top-0 left-0 w-full z-50 bg-[#f9d800] shadow-sm px-4 lg:px-10 py-3">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            {{-- LOGO --}}
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('logo/Screenshot_2025-11-23_184019-removebg-preview.png') }}"
                     alt="YODY Logo"
                     class="h-10 w-auto object-contain">
                <b class="ml-1">YODY</b>
            </a>

            {{-- SEARCH (PC) --}}
            <form
                action="#"
                method="GET"
                class="hidden lg:flex flex-1 mx-8 max-w-xl bg-white rounded-full overflow-hidden border border-yellow-300">
                <input type="text"
                       name="q"
                       class="flex-1 px-4 py-2 text-sm focus:outline-none"
                       placeholder="Tìm sản phẩm: áo polo, quần jean, váy, phụ kiện...">
                <button type="submit" class="px-4 py-2 text-sm font-semibold bg-[#ff9b0d] text-white">
                    Tìm kiếm
                </button>
            </form>

            {{-- RIGHT ACTIONS --}}
            <div class="flex items-center space-x-3 lg:space-x-6 lg:order-2">
                {{-- Search icon mobile --}}
                <button
                    class="lg:hidden p-2 rounded-full bg-white/70 hover:bg-white"
                    id="toggle-search-mobile">
                    🔍
                </button>

                {{-- Auth text buttons (PC) --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="hidden md:inline-block text-sm font-medium hover:underline">
                        Đăng nhập
                    </a>
                    <a href="{{ route('register') }}"
                       class="hidden md:inline-block text-sm font-medium px-3 py-1 rounded-full border border-white hover:bg-white/90 hover:text-[#f9a602] transition">
                        Đăng ký
                    </a>
                @endguest

                @auth
                    <div class="hidden md:flex flex-col text-xs text-right">
                        <span>Xin chào,</span>
                        <span class="font-semibold">{{ Auth::user()->name }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="hidden md:inline-block">
                        @csrf
                        <button type="submit"
                                class="text-xs px-3 py-1 rounded-full border border-white hover:bg-red-600 hover:border-red-600 text-white transition">
                            Đăng xuất
                        </button>
                    </form>
                @endauth

                {{-- Cart icon --}}
                <a href="{{ url('/cart') }}"
                   class="relative p-2 rounded-full bg-white/70 hover:bg-white">
                    🛒
                    <span
                        class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] rounded-full px-1.5">
                        0
                    </span>
                </a>

                {{-- Login / Account icon --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="p-2 rounded-full bg-white/70 hover:bg-white">
                        👤
                    </a>
                @else
                    <a href="#"
                       class="p-2 rounded-full bg-white/70 hover:bg-white"
                       title="Tài khoản">
                        {{ Str::substr(Auth::user()->name, 0, 1) }}
                    </a>
                @endguest

                {{-- Mobile menu button --}}
                <button data-collapse-toggle="mobile-menu"
                        type="button"
                        class="inline-flex items-center p-2 text-sm rounded-lg lg:hidden hover:bg-white/80 focus:outline-none"
                        aria-controls="mobile-menu"
                        aria-expanded="false">
                    <span class="sr-only">Mở menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            {{-- MENU DESKTOP --}}
            <div class="hidden lg:flex w-full mt-3 lg:mt-0 lg:w-auto lg:order-1">
                <ul class="flex flex-wrap items-center text-sm font-semibold uppercase">
                    <li class="mr-6">
                        <a href="{{ url('/#section-men') }}" class="hover:underline underline-offset-4">Nam</a>
                    </li>
                    <li class="mr-6">
                        <a href="{{ url('/#section-women') }}" class="hover:underline underline-offset-4">Nữ</a>
                    </li>
                    <li class="mr-6">
                        <a href="{{ url('/#section-kids') }}" class="hover:underline underline-offset-4">Trẻ em</a>
                    </li>
                    <li class="mr-6">
                        <a href="{{ url('/#section-collection') }}" class="hover:underline underline-offset-4">Bộ sưu tập</a>
                    </li>
                    <li class="mr-6">
                        <a href="#" class="hover:underline underline-offset-4">Sale</a>
                    </li>
                </ul>
            </div>

            {{-- MENU MOBILE --}}
            <div class="hidden w-full lg:hidden mt-2" id="mobile-menu">
                <form action="#" method="GET" class="mb-2">
                    <div class="flex bg-white rounded-full overflow-hidden border border-yellow-300">
                        <input type="text"
                               name="q"
                               class="flex-1 px-4 py-2 text-sm focus:outline-none"
                               placeholder="Tìm kiếm sản phẩm...">
                        <button type="submit" class="px-4 py-2 text-sm font-semibold bg-[#ff9b0d] text-white">
                            Tìm
                        </button>
                    </div>
                </form>

                <ul class="flex flex-col text-sm font-semibold uppercase bg-[#f9d800] rounded-b-md overflow-hidden">
                    <li>
                        <a href="{{ url('/#section-men') }}" class="block px-4 py-2 border-t border-yellow-300">Nam</a>
                    </li>
                    <li>
                        <a href="{{ url('/#section-women') }}" class="block px-4 py-2 border-t border-yellow-300">Nữ</a>
                    </li>
                    <li>
                        <a href="{{ url('/#section-kids') }}" class="block px-4 py-2 border-t border-yellow-300">Trẻ em</a>
                    </li>
                    <li>
                        <a href="{{ url('/#section-collection') }}" class="block px-4 py-2 border-t border-yellow-300">Bộ sưu tập</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 border-t border-yellow-300">Sale</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

{{-- MAIN CONTENT: GIỎ HÀNG --}}
<main class="pt-15">
    <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-8">

        {{-- breadcrumb + title --}}
        <div class="mb-6">
            <nav class="text-xs text-gray-500 mb-1">
                <a href="{{ url('/') }}" class="hover:underline">Trang chủ</a>
                <span class="mx-1">/</span>
                <span>Giỏ hàng</span>
            </nav>
            <h1 class="text-2xl md:text-3xl font-semibold text-gray-800 uppercase">
                Giỏ hàng của bạn
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Kiểm tra lại sản phẩm trước khi đặt hàng.
            </p>
        </div>

        @php
            // DEMO dữ liệu nếu chưa truyền từ controller
            if (!isset($cartItems)) {
                $cartItems = [
                    [
                        'id' => 1,
                        'name' => 'Áo polo nam Pique',
                        'image' => asset('products/nam_1.jpg'),
                        'color' => 'Trắng',
                        'size' => 'L',
                        'price' => 299000,
                        'quantity' => 1,
                    ],
                    [
                        'id' => 2,
                        'name' => 'Quần jean nữ basic',
                        'image' => asset('products/nu_1.jpg'),
                        'color' => 'Xanh',
                        'size' => 'M',
                        'price' => 399000,
                        'quantity' => 2,
                    ],
                ];
            }

            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
            $ship = $subtotal > 0 ? 30000 : 0;
            $total = $subtotal + $ship;
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- DANH SÁCH SẢN PHẨM --}}
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">
                @if(count($cartItems) === 0)
                    <div class="p-6 text-center text-gray-500">
                        Giỏ hàng của bạn đang trống.
                        <a href="{{ url('/') }}"
                           class="text-[#ff9b0d] font-semibold hover:underline ml-1">
                            Mua sắm ngay
                        </a>
                    </div>
                @else
                    {{-- header row --}}
                    <div class="px-4 py-3 border-b border-gray-100 hidden md:flex text-xs font-semibold text-gray-500">
                        <div class="w-2/5">SẢN PHẨM</div>
                        <div class="w-1/5 text-center">GIÁ</div>
                        <div class="w-1/5 text-center">SỐ LƯỢNG</div>
                        <div class="w-1/5 text-right">THÀNH TIỀN</div>
                    </div>

                    <div>
                        @foreach($cartItems as $item)
                            <div class="px-4 py-4 border-b border-gray-100 flex flex-col md:flex-row items-center md:items-stretch gap-3">
                                {{-- ảnh + info --}}
                                <div class="w-full md:w-2/5 flex">
                                    <div class="w-20 h-24 flex-shrink-0 rounded border border-gray-200 overflow-hidden bg-gray-50">
                                        <img src="{{ $item['image'] }}"
                                             alt="{{ $item['name'] }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                    <div class="ml-3 flex flex-col justify-between">
                                        <div>
                                            <h3 class="text-sm font-semibold text-gray-800">
                                                {{ $item['name'] }}
                                            </h3>
                                            <p class="text-xs text-gray-500 mt-1">
                                                Màu: <span class="font-medium">{{ $item['color'] ?? '—' }}</span> ·
                                                Size: <span class="font-medium">{{ $item['size'] ?? '—' }}</span>
                                            </p>
                                        </div>
                                        <button
                                            class="mt-2 text-xs text-red-500 hover:underline text-left">
                                            Xoá khỏi giỏ
                                        </button>
                                    </div>
                                </div>

                                {{-- giá --}}
                                <div class="w-full md:w-1/5 text-center text-sm font-semibold text-gray-800">
                                    {{ number_format($item['price'], 0, ',', '.') }}₫
                                </div>

                                {{-- số lượng --}}
                                <div class="w-full md:w-1/5 flex justify-center">
                                    <div class="inline-flex items-center border border-gray-300 rounded-full overflow-hidden">
                                        <button
                                            type="button"
                                            class="px-3 py-1 text-sm hover:bg-gray-100">
                                            -
                                        </button>
                                        <input type="text"
                                               value="{{ $item['quantity'] }}"
                                               class="w-10 text-center text-sm border-l border-r border-gray-300 focus:outline-none"
                                               readonly>
                                        <button
                                            type="button"
                                            class="px-3 py-1 text-sm hover:bg-gray-100">
                                            +
                                        </button>
                                    </div>
                                </div>

                                {{-- thành tiền --}}
                                <div class="w-full md:w-1/5 text-right text-sm font-bold text-[#ff9b0d]">
                                    {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}₫
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- TÓM TẮT ĐƠN HÀNG --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 md:p-5 h-fit">
                <h2 class="text-lg font-semibold mb-4 text-gray-800 uppercase">
                    Thông tin đơn hàng
                </h2>

                <div class="space-y-2 text-sm text-gray-700">
                    <div class="flex justify-between">
                        <span>Tạm tính</span>
                        <span class="font-medium">
                            {{ number_format($subtotal, 0, ',', '.') }}₫
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span>Phí vận chuyển</span>
                        <span class="font-medium">
                            {{ $ship > 0 ? number_format($ship, 0, ',', '.') . '₫' : '—' }}
                        </span>
                    </div>
                    <div class="border-t border-gray-200 pt-2 mt-2 flex justify-between text-base font-bold">
                        <span>Tổng cộng</span>
                        <span class="text-[#ff9b0d]">
                            {{ number_format($total, 0, ',', '.') }}₫
                        </span>
                    </div>
                </div>

                <p class="mt-3 text-xs text-gray-500">
                    Bằng việc đặt hàng, bạn đồng ý với
                    <a href="#" class="text-[#ff9b0d] hover:underline">Chính sách mua hàng</a>
                    của YODY.
                </p>

                <a href="{{ route('checkout.index') }}">
                    <button
                        class="mt-4 w-full py-3 rounded-full bg-[#ff9b0d] hover:bg-[#f79400] text-white font-semibold text-sm uppercase tracking-wide"
                        type="button">
                        Tiến hành đặt hàng
                    </button>
                </a>

                <a href="{{ url('/') }}"
                   class="mt-2 block text-center text-xs text-gray-500 hover:underline">
                    ← Tiếp tục mua sắm
                </a>
            </div>
        </div>
    </div>
</main>

{{-- FOOTER YODY STYLE --}}
<footer class="bg-white mt-10 border-t border-gray-200">
    <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-sm">
            <div>
                <h3 class="font-semibold mb-2">VỀ YODY</h3>
                <ul class="space-y-1 text-gray-600">
                    <li><a href="#" class="hover:underline">Giới thiệu</a></li>
                    <li><a href="#" class="hover:underline">Tuyển dụng</a></li>
                    <li><a href="#" class="hover:underline">Hệ thống cửa hàng</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold mb-2">HỖ TRỢ KHÁCH HÀNG</h3>
                <ul class="space-y-1 text-gray-600">
                    <li><a href="#" class="hover:underline">Chính sách đổi trả</a></li>
                    <li><a href="#" class="hover:underline">Chính sách vận chuyển</a></li>
                    <li><a href="#" class="hover:underline">Chính sách bảo mật</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold mb-2">LIÊN HỆ</h3>
                <ul class="space-y-1 text-gray-600">
                    <li>Hotline: 1800 2086</li>
                    <li>Email: care@yody.vn</li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold mb-2">KẾT NỐI VỚI YODY</h3>
                <div class="flex space-x-3">
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs">f</a>
                    <a href="#" class="w-8 h-8 rounded-full bg-pink-500 text-white flex items-center justify-center text-xs">IG</a>
                    <a href="#" class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center text-xs">YT</a>
                </div>
            </div>
        </div>

        <div class="mt-6 border-t border-gray-200 pt-4 text-xs text-gray-500 flex flex-wrap justify-between">
            <span>© {{ date('Y') }} YODY. All Rights Reserved.</span>
        </div>
    </div>
</footer>

<script src="/node_modules/flowbite/dist/flowbite.min.js"></script>

<script>
    const btnSearchMobile = document.getElementById('toggle-search-mobile');
    const mobileMenu = document.getElementById('mobile-menu');
    if (btnSearchMobile && mobileMenu) {
        btnSearchMobile.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
</script>
</body>
</html>

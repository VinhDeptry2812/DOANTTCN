<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>@yield('title')</title>

</head>

<style>
    .color-active {
        border-color: #FCAF17 !important;
    }

    .size-active {
        background-color: #FCAF17 !important;
        border-color: #FCAF17 !important;
        color: #000 !important;
    }

    /* Custom scrollbar cho thumbnail */
    .scrollbar-thin::-webkit-scrollbar {
        width: 4px;
    }

    .scrollbar-thumb-gray-300::-webkit-scrollbar-thumb {
        background-color: #d1d5db;
        border-radius: 4px;
    }

    .scrollbar-track-gray-100::-webkit-scrollbar-track {
        background-color: #f3f4f6;
    }
</style>

<body class="bg-gray-100 text-gray-800">
    {{-- HEADER YODY STYLE --}}
    <header class="shadow-sm bg-[#f9d800]">

        {{-- MAIN NAV --}}
        <nav class="fixed top-0 left-0 w-full z-50 bg-[#f9d800] shadow-sm px-4 lg:px-10 py-3">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                {{-- LOGO --}}
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('logo/Screenshot_2025-11-23_184019-removebg-preview.png') }}" alt="YODY Logo"
                        class="h-10 w-auto object-contain">
                    <b class="ml-1">YODY</b>
                </a>

                {{-- SEARCH (PC) --}}
                <form action="#" method="GET"
                    class="hidden lg:flex flex-1 mx-8 max-w-xl bg-white rounded-full overflow-hidden border border-yellow-300">
                    <input type="text" name="q" class="flex-1 px-4 py-2 text-sm focus:outline-none"
                        placeholder="Tìm sản phẩm: áo polo, quần jean, váy, phụ kiện...">
                    <button type="submit" class="px-4 py-2 text-sm font-semibold bg-[#ff9b0d] text-white">
                        Tìm kiếm
                    </button>
                </form>

                {{-- RIGHT ACTIONS --}}
                <div class="flex items-center space-x-3 lg:space-x-6 lg:order-2">
                    {{-- Search icon mobile --}}
                    <button class="lg:hidden p-2 rounded-full bg-white/70 hover:bg-white" id="toggle-search-mobile">
                        🔍
                    </button>

                    {{-- Auth text buttons (PC) --}}
                    @guest
                        <a href="{{ route('login') }}" class="hidden md:inline-block text-sm font-medium hover:underline">
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
                    <a href="{{ route('cart.index') }}" class="relative p-2 rounded-full bg-white/70 hover:bg-white">
                        🛒
                    </a>

                    {{-- Login / Account --}}
                    @guest
                        <a href="{{ route('login') }}"
                            class="p-2 rounded-full bg-white/70 hover:bg-white flex items-center justify-center w-10 h-10">
                            👤
                        </a>
                    @else
                        <div class="relative group">
                            <button
                                class="w-10 h-10 bg-white/80 hover:bg-white rounded-full flex items-center justify-center font-bold text-[#f9a602]">
                                {{ strtoupper(Str::substr(Auth::user()->name, 0, 1)) }}
                            </button>

                            {{-- Dropdown --}}
                            <div
                                class="absolute right-0 mt-2 w-36 bg-white shadow-lg rounded-lg py-2 opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-200 z-50">
                                <a href="#" class="block px-3 py-2 text-sm hover:bg-gray-100">
                                    👤 Tài khoản
                                </a>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100">
                                        🚪 Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest


                    {{-- Mobile menu button --}}
                    <button data-collapse-toggle="mobile-menu" type="button"
                        class="inline-flex items-center p-2 text-sm rounded-lg lg:hidden hover:bg-white/80 focus:outline-none"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Mở menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                            <a href="#section-men" class="hover:underline underline-offset-4">Nam</a>
                        </li>
                        <li class="mr-6">
                            <a href="#section-women" class="hover:underline underline-offset-4">Nữ</a>
                        </li>
                        <li class="mr-6">
                            <a href="#section-kids" class="hover:underline underline-offset-4">Trẻ em</a>
                        </li>
                        <li class="mr-6">
                            <a href="#section-collection" class="hover:underline underline-offset-4">Bộ sưu tập</a>
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
                            <input type="text" name="q" class="flex-1 px-4 py-2 text-sm focus:outline-none"
                                placeholder="Tìm kiếm sản phẩm...">
                            <button type="submit" class="px-4 py-2 text-sm font-semibold bg-[#ff9b0d] text-white">
                                Tìm
                            </button>
                        </div>
                    </form>

                    <ul class="flex flex-col text-sm font-semibold uppercase bg-[#f9d800] rounded-b-md overflow-hidden">
                        <li>
                            <a href="#section-men" class="block px-4 py-2 border-t border-yellow-300">Nam</a>
                        </li>
                        <li>
                            <a href="#section-women" class="block px-4 py-2 border-t border-yellow-300">Nữ</a>
                        </li>
                        <li>
                            <a href="#section-kids" class="block px-4 py-2 border-t border-yellow-300">Trẻ em</a>
                        </li>
                        <li>
                            <a href="#section-collection" class="block px-4 py-2 border-t border-yellow-300">Bộ sưu
                                tập</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 border-t border-yellow-300">Sale</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="pt-15">

        @yield('content')


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
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs">f</a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-pink-500 text-white flex items-center justify-center text-xs">IG</a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center text-xs">YT</a>
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

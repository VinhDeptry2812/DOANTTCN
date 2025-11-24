<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>YODY Shop</title>
</head>

<body class="bg-gray-100 text-gray-800">
    {{-- HEADER YODY STYLE --}}
    <header class="shadow-sm bg-[#f9d800]">

        {{-- MAIN NAV --}}
        <nav class="px-4 lg:px-10 py-3">
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
                    <a href="#"
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
                            <a href="#section-men" class="block px-4 py-2 border-t border-yellow-300">Nam</a>
                        </li>
                        <li>
                            <a href="#section-women" class="block px-4 py-2 border-t border-yellow-300">Nữ</a>
                        </li>
                        <li>
                            <a href="#section-kids" class="block px-4 py-2 border-t border-yellow-300">Trẻ em</a>
                        </li>
                        <li>
                            <a href="#section-collection" class="block px-4 py-2 border-t border-yellow-300">Bộ sưu tập</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 border-t border-yellow-300">Sale</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

{{-- MAIN CONTENT: code luôn, KHÔNG banner nhỏ, KHÔNG thanh danh mục --}}
    <main class="min-h-[60vh]">

    {{-- 1. HERO BANNER LỚN --}}
    <section class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-6">
            <div class="relative overflow-hidden rounded-2xl">
                <img src="{{ asset('banner/main-banner.jpg') }}"
                     alt="YODY Banner"
                     class="w-full h-full object-cover max-h-[380px]">
                <div class="absolute inset-0 bg-black/25"></div>
                <div class="absolute inset-0 flex flex-col justify-center px-6 lg:px-10 text-white">
                    <p class="text-xs lg:text-sm uppercase tracking-widest">
                        BST THU ĐÔNG 2025
                    </p>
                    <h1 class="mt-2 text-2xl lg:text-4xl font-bold leading-snug">
                        LOOK GOOD – FEEL GOOD<br>
                        Thời trang cho cả gia đình
                    </h1>
                    <p class="mt-3 text-xs lg:text-sm max-w-md">
                        Áo phao, áo giữ nhiệt, áo gió… chất liệu cao cấp, giữ ấm tốt, thoải mái suốt mùa đông.
                    </p>
                    <div class="mt-4 flex flex-wrap gap-3">
                        <a href="#section-men"
                           class="px-4 py-2 bg-[#ff9b0d] rounded-full text-sm font-semibold">
                            Mua sắm ngay
                        </a>
                        <a href="#section-collection"
                           class="px-4 py-2 bg-white/90 text-gray-800 rounded-full text-sm font-semibold">
                            Xem bộ sưu tập
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. BLOCK SẢN PHẨM NAM --}}
    <section id="section-men" class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-6">
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-lg md:text-xl font-bold uppercase">Nam</h2>
                <a href="#" class="text-xs md:text-sm text-blue-600 hover:underline">Xem tất cả</a>
            </div>

            <div class="grid grid-cols-2 grid-cols-4 grid-cols-5 gap-3 gap-4">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="bg-white rounded-xl border border-gray-100 hover:shadow-sm overflow-hidden group">
                        <a href="#">
                            <div class="relative">
                                <img src="{{ asset('products/nam_'.$i.'.jpg') }}"
                                     alt="Sản phẩm nam {{ $i }}"
                                     class="w-full aspect-[3/4] object-cover">
                                <span class="absolute left-2 top-2 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded">
                                    -20%
                                </span>
                            </div>
                            <div class="px-2 py-2">
                                <p class="text-[11px] text-gray-500 uppercase mb-1">ÁO PHAO NAM</p>
                                <h3 class="text-xs md:text-sm font-semibold line-clamp-2">
                                    Áo khoác nam giữ nhiệt siêu ấm {{ $i }}
                                </h3>
                                <div class="mt-1 flex items-center gap-2">
                                    <span class="text-sm md:text-base font-bold text-red-600">599.000đ</span>
                                    <span class="text-[11px] text-gray-400 line-through">799.000đ</span>
                                </div>
                                <p class="mt-1 text-[11px] text-green-600">Freeship đơn từ 498K</p>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- 3. BLOCK SẢN PHẨM NỮ --}}
    <section id="section-women" class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-6">
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-lg md:text-xl font-bold uppercase">Nữ</h2>
                <a href="#" class="text-xs md:text-sm text-blue-600 hover:underline">Xem tất cả</a>
            </div>

            <div class="grid grid-cols-2 grid-cols-4 grid-cols-5 gap-3 gap-4">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="bg-white rounded-xl border border-gray-100 hover:shadow-sm overflow-hidden group">
                        <a href="#">
                            <div class="relative">
                                <img src="{{ asset('products/nu_'.$i.'.jpg') }}"
                                     alt="Sản phẩm nữ {{ $i }}"
                                     class="w-full aspect-[3/4] object-cover">
                                <span class="absolute left-2 top-2 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded">
                                    -30%
                                </span>
                            </div>
                            <div class="px-2 py-2">
                                <p class="text-[11px] text-gray-500 uppercase mb-1">ÁO KHOÁC NỮ</p>
                                <h3 class="text-xs md:text-sm font-semibold line-clamp-2">
                                    Áo khoác nữ dáng dài thời thượng {{ $i }}
                                </h3>
                                <div class="mt-1 flex items-center gap-2">
                                    <span class="text-sm md:text-base font-bold text-red-600">699.000đ</span>
                                    <span class="text-[11px] text-gray-400 line-through">999.000đ</span>
                                </div>
                                <p class="mt-1 text-[11px] text-green-600">Giảm thêm 5% cho HĐ thành viên</p>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- 4. BLOCK TRẺ EM --}}
    <section id="section-kids" class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-6">
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-lg md:text-xl font-bold uppercase">Trẻ em</h2>
                <a href="#" class="text-xs md:text-sm text-blue-600 hover:underline">Xem tất cả</a>
            </div>

            <div class="grid grid-cols-2 grid-cols-4 grid-cols-5 gap-3 gap-4">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="bg-white rounded-xl border border-gray-100 hover:shadow-sm overflow-hidden group">
                        <a href="#">
                            <div class="relative">
                                <img src="{{ asset('products/kids_'.$i.'.jpg') }}"
                                     alt="Sản phẩm trẻ em {{ $i }}"
                                     class="w-full aspect-[3/4] object-cover">
                            </div>
                            <div class="px-2 py-2">
                                <p class="text-[11px] text-gray-500 uppercase mb-1">YODY KIDS</p>
                                <h3 class="text-xs md:text-sm font-semibold line-clamp-2">
                                    Áo phao bé trai/bé gái ấm áp {{ $i }}
                                </h3>
                                <div class="mt-1 flex items-center gap-2">
                                    <span class="text-sm md:text-base font-bold text-red-600">499.000đ</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- 5. BỘ SƯU TẬP GIA ĐÌNH --}}
    <section id="section-collection" class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-8">
            <div class="grid md:grid-cols-2 gap-4 items-center">
                <div>
                    <h2 class="text-lg md:text-2xl font-bold uppercase">Bộ sưu tập gia đình</h2>
                    <p class="mt-3 text-sm text-gray-600">
                        Set đồ gia đình đồng điệu, chất liệu mềm mại, phù hợp cho du lịch, sự kiện,
                        chụp kỷ niệm... Thiết kế trẻ trung, năng động đúng style YODY.
                    </p>
                    <ul class="mt-3 text-sm text-gray-600 space-y-1">
                        <li>• Chất liệu co giãn thoải mái</li>
                        <li>• Bảng size đầy đủ cho cả gia đình</li>
                        <li>• Màu sắc tươi sáng, trẻ trung</li>
                    </ul>
                    <div class="mt-4">
                        <a href="#" class="inline-block px-5 py-2 rounded-full bg-[#ff9b0d] text-white text-sm font-semibold">
                            Xem bộ sưu tập
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <img src="{{ asset('collection/family1.jpg') }}"
                         class="rounded-2xl w-full h-full object-cover" alt="">
                    <img src="{{ asset('collection/family2.jpg') }}"
                         class="rounded-2xl w-full h-full object-cover" alt="">
                </div>
            </div>
        </div>
    </section>

    {{-- 6. BLOG / TIN TỨC --}}
    <section class="bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-8">
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-lg md:text-xl font-bold uppercase">Tin tức & Cẩm nang mặc đẹp</h2>
                <a href="#" class="text-xs md:text-sm text-blue-600 hover:underline">Xem tất cả</a>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                @for ($i = 1; $i <= 3; $i++)
                    <article class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-sm">
                        <a href="#">
                            <img src="{{ asset('blog/blog_'.$i.'.jpg') }}"
                                 alt="Bài viết {{ $i }}"
                                 class="w-full h-40 object-cover">
                            <div class="p-3">
                                <p class="text-[11px] text-gray-400 uppercase mb-1">Mẹo mặc đẹp</p>
                                <h3 class="text-sm md:text-base font-semibold line-clamp-2">
                                    10+ cách phối đồ giữ ấm mà vẫn thời trang mùa đông {{ $i }}
                                </h3>
                                <p class="mt-1 text-xs text-gray-500 line-clamp-2">
                                    Gợi ý phối áo phao, áo giữ nhiệt, quần jean... giúp bạn tự tin xuống phố những ngày lạnh.
                                </p>
                                <p class="mt-2 text-[11px] text-gray-400">Ngày đăng: 24/11/2025</p>
                            </div>
                        </a>
                    </article>
                @endfor
            </div>
        </div>
    </section>

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

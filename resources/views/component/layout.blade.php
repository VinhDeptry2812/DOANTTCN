@extends('component.mainlayout')
@section('title', 'YODY Shop')
@section('content')
    {{-- BANNER LỚN --}}
    <section class="bg-white">
        <div id="indicators-carousel" class="relative w-full" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-base md:h-96">
                @forelse($carouselBanners as $index => $bn)
                    <div class="hiden duration-700 ease-in-out"
                        data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset($bn->image) }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="Banner {{ $index + 1 }}">
                    </div>
                @empty
                    <p>No banners</p>
                @endforelse
            </div>
            {{-- <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
                <button type="button" class="w-3 h-3 rounded-base" aria-current="true" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 4"
                    data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 5"
                    data-carousel-slide-to="4"></button>
            </div> --}}
            <!-- Slider controls -->
            <!-- Nút Previous -->
            <button type="button"
                class="absolute left-4 top-1/2 -translate-y-1/2 z-30 flex items-center justify-center 
                w-12 h-12 rounded-full bg-white/40 backdrop-blur-md shadow-lg
                hover:bg-white/70 transition-all duration-300 cursor-pointer"
                data-carousel-prev>
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Nút Next -->
            <button type="button"
                class="absolute right-4 top-1/2 -translate-y-1/2 z-30 flex items-center justify-center 
                w-12 h-12 rounded-full bg-white/40 backdrop-blur-md shadow-lg
                hover:bg-white/70 transition-all duration-300 cursor-pointer"
                data-carousel-next>
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" />
                </svg>
            </button>

        </div>
    </section>

    {{-- BLOCK SẢN PHẨM NAM --}}
    <section id="section-men" class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-6">
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-lg md:text-xl font-bold uppercase">Nam</h2>
                <a href="#" class="text-xs md:text-sm text-blue-600 hover:underline">Xem tất cả</a>
            </div>

            <div class="grid grid-cols-2 grid-cols-4 grid-cols-5 gap-3 gap-4">

                @forelse($products_nam as $product)
                    <div class="bg-white rounded-xl border border-gray-100 hover:shadow-sm overflow-hidden group">
                        <a href="{{route('productdetail',['id'=>$product->id])}}">
                            <div class="relative">
                                @if ($product->image)
                                    <img class="w-full aspect-[3/4] object-cover"
                                        src="{{ asset($product->image) }}" alt="Product Image" />
                                @endif

                                <span
                                    class="absolute left-2 top-2 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded">
                                    -20%
                                </span>
                            </div>
                            <div class="px-2 py-2">
                                <p class="text-[11px] text-gray-500 uppercase mb-1">{{ $product->name }}</p>
                                <h3 class="text-xs md:text-sm font-semibold line-clamp-2">
                                    {{ $product->description }}
                                </h3>
                                <div class="mt-1 flex items-center gap-2">
                                    <span
                                        class="text-sm md:text-base font-bold text-red-600">{{ format_price($product->discount_price) }}</span>
                                    <span
                                        class="text-[11px] text-gray-400 line-through">{{ format_price($product->price) }}</span>
                                </div>
                                <p class="mt-1 text-[11px] text-green-600">Freeship đơn từ 498K</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Không có sản phẩm</p>
                @endforelse
    </section>

    {{-- BANNER 1 --}}
    <section class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 pb-2">
            <div class="relative overflow-hidden rounded-2xl">
                @forelse($banner1 as $bn)
                    <img src="{{ asset($bn->image) }}" alt="Banner 1"
                        class="w-full h-full object-cover max-h-[260px]">
                @empty
                    <img src="#" alt="Banner 1" class="w-full h-full object-cover max-h-[260px]">
                @endforelse

            </div>
        </div>
    </section>


    {{-- BLOCK SẢN PHẨM NỮ --}}
    <section id="section-women" class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-6">
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-lg md:text-xl font-bold uppercase">Nữ</h2>
                <a href="#" class="text-xs md:text-sm text-blue-600 hover:underline">Xem tất cả</a>
            </div>

            <div class="grid grid-cols-2 grid-cols-4 grid-cols-5 gap-3 gap-4">
                @forelse($products_nu as $product)
                    <div class="bg-white rounded-xl border border-gray-100 hover:shadow-sm overflow-hidden group">
                        <a href="{{route('productdetail',['id'=>$product->id])}}">
                            <div class="relative">
                                @if ($product->image)
                                    <img class="w-full aspect-[3/4] object-cover"
                                        src="{{ asset($product->image) }}" alt="Product Image" />
                                @endif

                                <span
                                    class="absolute left-2 top-2 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded">
                                    -20%
                                </span>
                            </div>
                            <div class="px-2 py-2">
                                <p class="text-[11px] text-gray-500 uppercase mb-1">{{ $product->name }}</p>
                                <h3 class="text-xs md:text-sm font-semibold line-clamp-2">
                                    {{ $product->description }}
                                </h3>
                                <div class="mt-1 flex items-center gap-2">
                                    <span
                                        class="text-sm md:text-base font-bold text-red-600">{{ format_price($product->discount_price) }}</span>
                                    <span
                                        class="text-[11px] text-gray-400 line-through">{{ format_price($product->price) }}</span>
                                </div>
                                <p class="mt-1 text-[11px] text-green-600">Freeship đơn từ 498K</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Không có sản phẩm</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- BANNER 2 --}}
    <section class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 pb-2">
            <div class="relative overflow-hidden rounded-2xl">
                @forelse($banner2 as $bn)
                    <img src="{{ asset($bn->image) }}" alt="Banner 2"
                        class="w-full h-full object-cover max-h-[260px]">
                @empty
                    <img src="#" alt="Banner 2" class="w-full h-full object-cover max-h-[260px]">
                @endforelse

            </div>
        </div>
    </section>

    {{-- BLOCK TRẺ EM --}}
    <section id="section-kids" class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-6">
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-lg md:text-xl font-bold uppercase">Trẻ em</h2>
                <a href="#" class="text-xs md:text-sm text-blue-600 hover:underline">Xem tất cả</a>
            </div>

            <div class="grid grid-cols-2 grid-cols-4 grid-cols-5 gap-3 gap-4">
                @forelse($products_treem as $product)
                    <div class="bg-white rounded-xl border border-gray-100 hover:shadow-sm overflow-hidden group">
                        <a href="{{route('productdetail',['id'=>$product->id])}}">
                            <div class="relative">
                                @if ($product->image)
                                    <img class="w-full aspect-[3/4] object-cover"
                                        src="{{ asset($product->image) }}" alt="Product Image" />
                                @endif

                                <span
                                    class="absolute left-2 top-2 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded">
                                    -20%
                                </span>
                            </div>
                            <div class="px-2 py-2">
                                <p class="text-[11px] text-gray-500 uppercase mb-1">{{ $product->name }}</p>
                                <h3 class="text-xs md:text-sm font-semibold line-clamp-2">
                                    {{ $product->description }}
                                </h3>
                                <div class="mt-1 flex items-center gap-2">
                                    <span
                                        class="text-sm md:text-base font-bold text-red-600">{{ format_price($product->discount_price) }}</span>
                                    <span
                                        class="text-[11px] text-gray-400 line-through">{{ format_price($product->price) }}</span>
                                </div>
                                <p class="mt-1 text-[11px] text-green-600">Freeship đơn từ 498K</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Không có sản phẩm</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- BANNER 3 --}}
    <section class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 pb-2">
            <div class="relative overflow-hidden rounded-2xl">
                @forelse($banner3 as $bn)
                    <img src="{{ asset($bn->image) }}" alt="Banner 3"
                        class="w-full h-full object-cover max-h-[260px]">
                @empty
                    <img src="#" alt="Banner 3" class="w-full h-full object-cover max-h-[260px]">
                @endforelse

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
                        <a href="#"
                            class="inline-block px-5 py-2 rounded-full bg-[#ff9b0d] text-white text-sm font-semibold">
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
                            <img src="{{ asset('blog/blog_' . $i . '.jpg') }}"
                                alt="Bài viết {{ $i }}" class="w-full h-40 object-cover">
                            <div class="p-3">
                                <p class="text-[11px] text-gray-400 uppercase mb-1">Mẹo mặc đẹp</p>
                                <h3 class="text-sm md:text-base font-semibold line-clamp-2">
                                    10+ cách phối đồ giữ ấm mà vẫn thời trang mùa đông {{ $i }}
                                </h3>
                                <p class="mt-1 text-xs text-gray-500 line-clamp-2">
                                    Gợi ý phối áo phao, áo giữ nhiệt, quần jean... giúp bạn tự tin xuống phố những
                                    ngày lạnh.
                                </p>
                                <p class="mt-2 text-[11px] text-gray-400">Ngày đăng: 24/11/2025</p>
                            </div>
                        </a>
                    </article>
                @endfor
            </div>
        </div>
    </section>
@endsection
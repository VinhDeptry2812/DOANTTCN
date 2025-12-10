@extends('component.mainlayout')
@section('title', 'YODY Shop')
@section('content')
    {{-- BANNER LỚN --}}
    <section class="bg-white">
        <div id="indicators-carousel" class="relative w-full" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-base md:h-96">
                @forelse($carouselBanners as $index => $bn)
                    <div class="hiden duration-700 ease-in-out" data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset($bn->image) }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="Banner {{ $index + 1 }}">
                    </div>
                @empty
                    <p>No banners</p>
                @endforelse
            </div>
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

    {{-- BANNER 3 --}}
    <section class="bg-white">
        <div class="max-w-screen-xl mx-auto py-6 px-4 lg:px-10 pb-2">
            <div class="relative overflow-hidden rounded-2xl">
                @forelse($banner3 as $bn)
                    <img src="{{ asset($bn->image) }}" alt="Banner 3" class="w-full h-full object-cover max-h-[260px]">
                @empty
                    <img src="#" alt="Banner 3" class="w-full h-full object-cover max-h-[260px]">
                @endforelse

            </div>
        </div>
    </section>

    {{-- BLOCK SẢN PHẨM NAM --}}
    <section id="section-men" class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-6">
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-lg md:text-xl font-bold uppercase">Nam</h2>
                <a href="{{ route('product.all') }}" class="text-xs md:text-sm text-blue-600 hover:underline">Xem tất cả</a>
            </div>

            <div class="grid grid-cols-2 grid-cols-4 grid-cols-5 gap-3 gap-4">

                @forelse($products_nam as $product)
                    <div class="bg-white rounded-xl border border-gray-100 hover:shadow-sm overflow-hidden group">
                        <a href="{{ route('productdetail', ['id' => $product->id]) }}">
                            <div class="relative">
                                @if ($product->image)
                                    <img class="w-full aspect-[3/4] object-cover" src="{{ asset($product->image) }}"
                                        alt="Product Image" />
                                @endif

                                <span class="absolute left-2 top-2 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded">
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
                    <img src="{{ asset($bn->image) }}" alt="Banner 1" class="w-full h-full object-cover max-h-[260px]">
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
                <a href="{{ route('product.all') }}" class="text-xs md:text-sm text-blue-600 hover:underline">Xem tất
                    cả</a>
            </div>

            <div class="grid grid-cols-2 grid-cols-4 grid-cols-5 gap-3 gap-4">
                @forelse($products_nu as $product)
                    <div class="bg-white rounded-xl border border-gray-100 hover:shadow-sm overflow-hidden group">
                        <a href="{{ route('productdetail', ['id' => $product->id]) }}">
                            <div class="relative">
                                @if ($product->image)
                                    <img class="w-full aspect-[3/4] object-cover" src="{{ asset($product->image) }}"
                                        alt="Product Image" />
                                @endif

                                <span class="absolute left-2 top-2 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded">
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
                    <img src="{{ asset($bn->image) }}" alt="Banner 2" class="w-full h-full object-cover max-h-[260px]">
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
                <a href="{{ route('product.all') }}" class="text-xs md:text-sm text-blue-600 hover:underline">Xem tất
                    cả</a>
            </div>

            <div class="grid grid-cols-2 grid-cols-4 grid-cols-5 gap-3 gap-4">
                @forelse($products_treem as $product)
                    <div class="bg-white rounded-xl border border-gray-100 hover:shadow-sm overflow-hidden group">
                        <a href="{{ route('productdetail', ['id' => $product->id]) }}">
                            <div class="relative">
                                @if ($product->image)
                                    <img class="w-full aspect-[3/4] object-cover" src="{{ asset($product->image) }}"
                                        alt="Product Image" />
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



    {{-- 6. BLOG / TIN TỨC --}}
    <!-- Blog Section -->
    <section class="bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-8">

            <div class="flex justify-between items-center mb-3">
                <h2 class="text-lg md:text-xl font-bold uppercase">Blog yody</h2>
                <a href="#" class="text-xs md:text-sm text-blue-600 hover:underline">Xem tất cả</a>
            </div>

            @if ($blogs->count() > 3)

                <div class="swiper myBlogSwiper">
                    <div class="swiper-wrapper">

                        @foreach ($blogs as $blog)
                            <div class="swiper-slide">
                                <article class="bg-white rounded-xl overflow-hidden border border-gray-100">
                                    <a href="#" class="block">
                                        <img src="{{ asset($blog->thumbnail) }}" class="w-full h-44 object-cover">

                                        <div class="p-4 space-y-2">
                                            <h3 class="text-base font-semibold text-gray-900 line-clamp-2">
                                                {{ $blog->title }}
                                            </h3>

                                            <p class="text-xs text-gray-400">
                                                {{ $blog->created_at->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </a>
                                </article>
                            </div>
                        @endforeach

                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            @else
                <div class="grid md:grid-cols-3 gap-4">
                    @foreach ($blogs as $blog)
                        <article class="bg-white rounded-xl overflow-hidden border border-gray-100">
                            <a href="#" class="block">
                                <img src="{{ asset($blog->thumbnail) }}" class="w-full h-44 object-cover">

                                <div class="p-4 space-y-2">
                                    <h3 class="text-base font-semibold text-gray-900 line-clamp-2">
                                        {{ $blog->title }}
                                    </h3>

                                    <p class="text-xs text-gray-400">
                                        {{ $blog->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    <!-- SWIPER JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        new Swiper(".myBlogSwiper", {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },

            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                640: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
            }
        });
    </script>


@endsection

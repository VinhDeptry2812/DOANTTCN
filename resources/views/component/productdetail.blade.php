@extends('component.mainlayout')
@section('title', $product_info->name)
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Left: Product Images -->
            <div class="flex gap-3">
                <!-- Thumbnails -->
                <div id="thumbnailContainer"
                    class="flex flex-col gap-2 w-20 max-h-[520px] overflow-y-auto scroll-smooth scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                    @if ($product_info->image)
                        <img onclick="changeMainImage(0, this)"
                            class="thumbnail-img w-full h-24 object-cover rounded cursor-pointer border-2 border-yellow-500 hover:opacity-80 transition flex-shrink-0"
                            src="{{ asset($product_info->image) }}" alt="Product Image" />
                    @endif

                    @forelse($product_info->images as $index => $item)
                        <img src="{{ asset($item->url_image) }}" onclick="changeMainImage({{ $index + 1 }}, this)"
                            class="thumbnail-img w-full h-24 object-cover rounded cursor-pointer border-2 border-gray-200 hover:opacity-80 transition flex-shrink-0"
                            alt="Thumb {{ $index + 1 }}">
                    @empty
                    @endforelse
                </div>

                <!-- Main Image -->
                <div class="flex-1 relative">
                    <div class="sticky top-24">
                        <div class="relative overflow-hidden rounded-lg group">
                            <div id="imageSlider" class="flex transition-transform duration-500 ease-in-out">
                                @if ($product_info->image)
                                    <img src="{{ asset($product_info->image) }}"
                                        class="w-full flex-shrink-0 aspect-[3/4] object-cover" alt="Main Product">
                                @endif

                                @forelse($product_info->images as $index => $item)
                                    <img src="{{ asset($item->url_image) }}"
                                        class="w-full flex-shrink-0 aspect-[3/4] object-cover"
                                        alt="Slide {{ $index + 1 }}">
                                @empty
                                @endforelse
                            </div>

                            <!-- Previous Button -->
                            <button onclick="previousImage()"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/90 hover:bg-white rounded-full shadow-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>

                            <!-- Next Button -->
                            <button onclick="nextImage()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/90 hover:bg-white rounded-full shadow-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-2 text-center text-sm text-gray-500">
                            <span id="imageCounter">1</span>/<span
                                id="totalCounter">{{ 1 + $product_info->images->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="space-y-5">
                <!-- Title -->
                <h1 class="text-2xl font-bold text-gray-900 leading-tight">
                    {{ $product_info->name }}
                </h1>

                <!-- Price -->
                <div class="flex items-center gap-3">
                    <span class="text-3xl font-bold text-red-600">
                        {{ format_price($product_info->discount_price) }}
                    </span>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200"></div>

                <!-- Color Selection -->
                <div class="space-y-3">
                    <span class="font-medium text-gray-900">Màu sắc:</span>
                    <div class="flex gap-2">
                        <button onclick="selectColor(this, 'Đen 006')"
                            class="color-active w-10 h-10 rounded-full bg-black border-2 hover:scale-110 transition">
                        </button>
                        <button onclick="selectColor(this, 'Trắng 001')"
                            class="w-10 h-10 rounded-full bg-white border-2 border-gray-300 hover:scale-110 transition">
                        </button>
                        <button onclick="selectColor(this, 'Xanh Navy')"
                            class="w-10 h-10 rounded-full bg-blue-900 border-2 border-gray-300 hover:scale-110 transition">
                        </button>
                        <button onclick="selectColor(this, 'Nâu 018')"
                            class="w-10 h-10 rounded-full bg-amber-800 border-2 border-gray-300 hover:scale-110 transition">
                        </button>
                    </div>
                </div>

                <!-- Size Selection -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="font-medium text-gray-900">Kích thước:</span>
                            <span id="selectedSize" class="text-gray-600">S</span>
                        </div>
                        <a href="#" class="text-sm text-blue-600 hover:underline">Hướng dẫn chọn size</a>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="selectSize(this, 'S')"
                            class="size-active px-5 py-2 border-2 rounded font-medium hover:border-yellow-500 transition">
                            S
                        </button>
                        <button onclick="selectSize(this, 'M')"
                            class="px-5 py-2 border-2 border-gray-300 rounded font-medium hover:border-yellow-500 transition">
                            M
                        </button>
                        <button onclick="selectSize(this, 'L')"
                            class="px-5 py-2 border-2 border-gray-300 rounded font-medium hover:border-yellow-500 transition">
                            L
                        </button>
                        <button onclick="selectSize(this, 'XL')"
                            class="px-5 py-2 border-2 border-gray-300 rounded font-medium hover:border-yellow-500 transition">
                            XL
                        </button>
                        <button onclick="selectSize(this, 'XXL')"
                            class="px-5 py-2 border-2 border-gray-300 rounded font-medium hover:border-yellow-500 transition">
                            XXL
                        </button>
                    </div>
                </div>

                <!-- Quantity -->
                <div class="space-y-3">
                    <span class="font-medium text-gray-900">Số lượng:</span>
                    <div class="inline-flex items-center border border-gray-300 rounded-lg overflow-hidden">
                        <button onclick="decreaseQty()"
                            class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 transition text-gray-600 font-medium">
                            -
                        </button>
                        <input id="quantity" type="text" value="1" readonly
                            class="w-14 h-10 text-center border-x border-gray-300 font-medium text-gray-900 bg-white">
                        <button onclick="increaseQty()"
                            class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 transition text-gray-600 font-medium">
                            +
                        </button>
                        <input type="hidden" id="selectedQty" value="1">

                    </div>
                </div>

                <!-- Add to Cart Button -->
                <button data-id="{{ $product_info->id }}"
                    class="add-to-cart w-full bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-4 rounded text-lg transition">
                    Thêm vào giỏ
                </button>

                <!-- Divider -->
                <div class="border-t border-gray-200"></div>

                <!-- Commitment Section -->
                <div class="bg-gray-50 rounded-lg p-5 space-y-4">
                    <h3 class="font-bold text-gray-900">YODY cam kết</h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Giao trong 3-5 ngày và freeship đơn từ 498k</span>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <div>
                                <p class="text-gray-700">Đổi trả trong vòng 30 ngày</p>
                                <a href="#" class="text-blue-600 hover:underline text-xs">Xem chính sách</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Cam kết bảo mật thông tin khách hàng</span>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <div>
                                <p class="text-gray-700">Cần tư vấn thêm? Chat ngay!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="mt-12 border-t border-gray-200 pt-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Chi tiết sản phẩm</h2>

            <div class="space-y-6">
                {{ $product_info->decription }}
            </div>
        </div>
    </div>





    <script>
        let currentImageIndex = 0;
        const totalImages = {{ 1 + $product_info->images->count() }};

        function updateSlider() {
            const slider = document.getElementById('imageSlider');
            slider.style.transform = `translateX(-${currentImageIndex * 100}%)`;
            document.getElementById('imageCounter').textContent = currentImageIndex + 1;

            // Update thumbnails
            const thumbs = document.querySelectorAll('.thumbnail-img');
            thumbs.forEach((thumb, index) => {
                if (index === currentImageIndex) {
                    thumb.classList.add('border-yellow-500');
                    thumb.classList.remove('border-gray-200');

                    // Auto scroll thumbnail vào view
                    const container = document.getElementById('thumbnailContainer');
                    const thumbHeight = 104; // 96px (h-24) + 8px (gap-2)
                    const containerHeight = container.clientHeight;
                    const scrollPosition = (index * thumbHeight) - (containerHeight / 2) + (thumbHeight / 2);

                    container.scrollTo({
                        top: scrollPosition,
                        behavior: 'smooth'
                    });
                } else {
                    thumb.classList.remove('border-yellow-500');
                    thumb.classList.add('border-gray-200');
                }
            });
        }

        function changeMainImage(index, thumb) {
            currentImageIndex = index;
            updateSlider();
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % totalImages;
            updateSlider();
        }

        function previousImage() {
            currentImageIndex = (currentImageIndex - 1 + totalImages) % totalImages;
            updateSlider();
        }

        function selectColor(btn, colorName) {
            document.querySelectorAll('[onclick^="selectColor"]').forEach(b => {
                b.classList.remove('color-active');
                b.classList.add('border-gray-300');
            });

            btn.classList.add('color-active');
            btn.classList.remove('border-gray-300');
        }

        function selectSize(btn, size) {
            document.getElementById('selectedSize').textContent = size;

            document.querySelectorAll('[onclick^="selectSize"]').forEach(b => {
                b.classList.remove('size-active');
            });

            btn.classList.add('size-active');
        }

        function increaseQty() {
            let q = parseInt(document.getElementById("quantity").value);
            q++;
            document.getElementById("quantity").value = q;
            document.getElementById("selectedQty").value = q;
        }

        function decreaseQty() {
            let q = parseInt(document.getElementById("quantity").value);
            if (q > 1) q--;
            document.getElementById("quantity").value = q;
            document.getElementById("selectedQty").value = q;
        }
    </script>

    {{-- Script them gio hang --}}
    <script>
        document.querySelector('.add-to-cart').addEventListener('click', function() {
            let id = this.dataset.id; // lấy id từ nút

            fetch("{{ route('cart.add') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id: id,
                        quantity: document.getElementById("selectedQty").value
                    })
                })
                .then(res => res.json())
                .then(data => {
                    alert("Đã thêm vào giỏ!");
                });
        });
    </script>










@endsection

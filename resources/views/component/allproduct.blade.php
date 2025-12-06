@extends('component.mainlayout')
@section('title', 'Sản phẩm')
@section('content')

    <div class="max-w-7xl mx-auto p-6">
        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-500 dark:text-gray-400 mb-4" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex items-center space-x-2">
                <li>
                    <a href="{{ route('homepage') }}" class="hover:underline">Trang chủ</a>
                    <span class="mx-2">/</span>
                </li>
                <li>
                    <span class="text-gray-700 dark:text-gray-300">Sản phẩm</span>
                </li>
                @if ($currentCategory)
                    <span class="mx-2">/</span>
                    <span class="text-gray-700 dark:text-gray-300">{{ $currentCategory->name }}</span>
                @endif
            </ol>
        </nav>

        {{-- Filter tags --}}
        <div class="flex flex-wrap gap-2 mb-6">
            {{-- Tất cả --}}
            <a href="{{ route('product.all') }}"
                class="px-3 py-1 rounded-full border border-gray-300
                {{ request('category') ? 'text-gray-600 hover:bg-gray-100' : 'bg-yellow-400 text-white font-semibold' }}
                transition">
                Tất cả
            </a>

            {{-- Categories --}}
            @foreach ($categories as $tag)
                <a href="{{ route('product.all', ['category' => $tag->id]) }}"
                    class="px-3 py-1 rounded-full border border-gray-300
           {{ request('category') == $tag->id ? 'bg-yellow-400 text-white font-semibold' : 'text-gray-600 hover:bg-gray-100' }}
           transition">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
        {{-- Grid sản phẩm --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @forelse($products as $product)
                <div class="bg-white rounded-xl border border-gray-100 hover:shadow-sm overflow-hidden group">
                    <a href="{{ route('productdetail', ['id' => $product->id]) }}">
                        <div class="relative">
                            @if ($product->image)
                                <img class="w-full aspect-[3/4] object-cover" src="{{ asset($product->image) }}"
                                    alt="Product Image" />
                            @endif

                            @if ($product->discount_price < $product->price)
                                <span class="absolute left-2 top-2 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded">
                                    -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                </span>
                            @endif
                        </div>
                        <div class="px-2 py-2">
                            <p class="text-[11px] text-gray-500 uppercase mb-1">{{ $product->name }}</p>
                            <h3 class="text-xs md:text-sm font-semibold line-clamp-2">
                                {{ $product->description }}
                            </h3>
                            <div class="mt-1 flex items-center gap-2">
                                <span
                                    class="text-sm md:text-base font-bold text-red-600">{{ format_price($product->discount_price) }}</span>
                                @if ($product->discount_price < $product->price)
                                    <span
                                        class="text-[11px] text-gray-400 line-through">{{ format_price($product->price) }}</span>
                                @endif
                            </div>
                            <p class="mt-1 text-[11px] text-green-600">Freeship đơn từ 498K</p>
                        </div>
                    </a>
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-500 py-10">Chưa có sản phẩm nào</p>
            @endforelse
        </div>



    </div>

@endsection

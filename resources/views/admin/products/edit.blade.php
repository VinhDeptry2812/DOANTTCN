@extends('admin.dashboard')

@section('contents')
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto px-5 lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update a product</h2>
            <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                    {{-- Ten san pham --}}
                    <div class="sm:col-span-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                            Name</label>
                        <input type="text" name="name" id="name" value="{{ $product->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type category name" required="">
                        @error('name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- So luong --}}
                    <div class="sm:col-span-1">
                        <label for="stock"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ $product->stock }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="10" required="">
                        @error('stock')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Gia --}}
                    <div class="sm:col-span-1">
                        <label for="price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="number" name="price" id="stock" value="{{ $product->price }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="100000" required="">
                        @error('price')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Gia giam --}}
                    <div class="sm:col-span-1">
                        <label for="discount_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giá
                            giảm</label>
                        <input type="number" name="discount_price" id="discount_price"
                            value="{{ $product->discount_price }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="10" required="">
                        @error('discount_price')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Danh muc --}}
                    <div class="sm:col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a
                            category</label>
                        <select id="category" name="category_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a category</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @empty
                                <option>Categories empty</option>
                            @endforelse
                        </select>

                    </div>
                    {{-- Mo ta --}}
                    <div class="sm:col-span-4">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Decription</label>
                        <textarea id="description" name="decription" rows="8" value="{{ $product->decription }}"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your description here"></textarea>
                        @error('description')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Anh chinh --}}
                    <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ảnh Chính</span>
                    <div class="flex items-center sm:col-span-4 justify-center w-full">
                        <label for="dropzone-file"
                            class="relative flex items-center justify-center w-full h-64 bg-neutral-secondary-medium border border-dashed border-default-strong rounded-base cursor-pointer hover:bg-neutral-tertiary-medium overflow-hidden">
                            <!-- Nội dung mặc định -->
                            <div id="dropzone-preview"
                                class="flex flex-col items-center justify-center text-body pt-5 pb-6 absolute inset-0">
                                @if ($product->image)
                                    {{-- Hiển thị ảnh cũ  --}}
                                    <img src="{{ asset($product->image) }}"
                                        class="absolute inset-0 w-full h-full object-contain bg-white" />
                                @else
                                    <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24" id="dropzone-icon">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or drag and
                                        drop
                                    </p>
                                    <p class="text-xs">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                @endif
                            </div>

                            <input id="dropzone-file" type="file" name ="image" class="hidden" accept="image/*" />
                        </label>
                    </div>


                    <div class="sm:col-span-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Các ảnh phụ
                        </label>

                        {{-- VÙNG HIỂN THỊ ẢNH + DROPZONE --}}
                        <div id="gallery-wrapper" class="flex flex-col gap-2">

                            {{-- ẢNH CŨ --}}
                            @if ($product->images && $product->images->count() > 0)
                                <div id="old-gallery"
                                    class="flex gap-2 overflow-x-auto p-1 border rounded border-gray-200">
                                    @foreach ($product->images as $img)
                                        <div class="relative w-24 h-24 flex-shrink-0 border rounded overflow-hidden">
                                            <img src="{{ asset($img->url_image) }}" class="w-full h-full object-cover">

                                            {{-- NÚT XÓA --}}
                                            <button type="button"
                                                class="delete-old absolute top-1 right-1 bg-white w-6 h-6 flex items-center justify-center rounded-full text-xs shadow"
                                                data-id="{{ $img->id }}">
                                                &times;
                                            </button>

                                            {{-- input hidden để gửi id ảnh cần xoá --}}
                                            <input type="hidden" name="old_gallery[]" class="delete-input"
                                                value="{{ $img->id }}">


                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- DROPZONE MỚI MẶC ĐỊNH --}}
                            <label for="gallery-input"
                                class="w-full h-32 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center cursor-pointer hover:border-gray-500 hover:bg-gray-50 transition">

                                <input type="file" name="new_gallery[]" id="gallery-input" multiple class="hidden">

                                <div class="flex flex-col items-center justify-center text-center text-gray-500">
                                    <svg class="w-8 h-8 mb-1 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 19V10m0 0l-2 2m2-2 2 2m-9 3h3a3 3 0 010-6h.025a5.5 5.5 0 1110.975.5H17a3 3 0 010 6h-2" />
                                    </svg>
                                    <p class="text-xs">Click để thêm ảnh</p>
                                </div>
                            </label>

                            {{-- Container preview ảnh mới --}}
                            <div id="gallery-preview"
                                class="flex gap-2 overflow-x-auto p-1 border rounded border-gray-200"></div>
                        </div>

                        @error('gallery.*')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>



                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Update Product
                    </button>
            </form>
        </div>
    </section>
@endsection

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
                    <div class="sm:col-span-1">
                        <div class="sm:col-span-2">
                            <div class="mt-2">
                                @if ($product->image)
                                    <img src="{{ asset($product->image) && $oldImage = $product->image }}"
                                        alt="Current Image" class="w-24 h-24 object-cover rounded-lg border" />
                                @else
                                    <p class="text-gray-500 text-sm">Chưa có hình ảnh</p>
                                @endif
                            </div>
                        </div>
                        <label class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">Ảnh chính</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input" name="image" type="file">

                        @error('image')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror



                    </div>
                    {{-- Anh gallery --}}
                    <div class="sm:col-span-4">
                        <div class="sm:col-span-2">
                            <div class="mt-2 flex">
                                @if ($product->images && $product->images->count() > 0)
                                    @foreach ($product->images as $img)
                                        <img src="{{ asset($img->url_image) }}" alt="Gallery Image"
                                            class="w-24 h-24 object-cover rounded-lg border ml-2" />
                                    @endforeach
                                @else
                                    <p class="text-gray-500 text-sm">Chưa có hình ảnh</p>
                                @endif
                            </div>
                        </div>
                        <label class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_inputl">Các ảnh phụ</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_inputl" name="gallery[]" type="file" multiple>

                        @error('gallery[]')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror



                    </div>

                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Update Product
                </button>

                <a href="{{ route('product.index') }}"
                    class="text-red-600 hover:cursor-pointer inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">

                    Back
                </a>
            </form>
        </div>
    </section>
@endsection

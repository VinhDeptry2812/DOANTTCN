@extends('admin.dashboard')

@section('contents')
    <section class="bg-gray-50 dark:bg-gray-900 p-4 sm:p-6">
        <div class="mx-auto max-w-screen-xl">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg overflow-hidden">
                <!-- Header: Search + Add Product + Actions -->
                <div class="flex flex-col md:flex-row items-center justify-between p-4 space-y-3 md:space-y-0 md:space-x-4">
                    <!-- Search -->
                    <div class="w-fit md:w-1/2">
                        <form class="relative w-full">
                            <input type="text" placeholder="Search"
                                class="w-full pl-10 pr-3 py-2 text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-1 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" />
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </form>
                    </div>

                    <!-- Add Product + Dropdowns -->
                    <div
                        class="flex flex-col md:flex-row items-stretch md:items-center space-y-2 md:space-y-0 md:space-x-3 w-full md:w-auto">
                        <a href="{{ route('product.create') }}"
                            class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-primary-700 hover:bg-primary-800 rounded-lg focus:ring-2 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Add Product
                        </a>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Image</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Price</th>
                                <th class="px-4 py-3">Stock</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr
                                    class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-3">
                                        @if ($product->image)
                                            <img class="w-16 h-16 object-cover rounded-md shadow-sm"
                                                src="{{ asset($product->image) }}" alt="Product Image" />
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-100">{{ $product->name }}
                                    </td>
                                    <td class="px-4 py-3">{{ $product->category_id ? $product->category->name : 'Chưa có' }}
                                    </td>
                                    <td class="px-4 py-3">{{ number_format($product->price) }}</td>
                                    <td class="px-4 py-3">{{ $product->stock }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-semibold {{ $product->status == 0 ? 'bg-red-100 text-red-800' : ($product->status == 2 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                            {{ $product->status == 0 ? 'Out of stock' : ($product->status == 2 ? 'Low stock' : 'Available') }}
                                        </span>
                                    </td>

                                    <!-- Actions: Icon click popup -->
                                    <td class="px-4 py-3 relative" x-data="{ open: false }">
                                        <button @click="open=!open"
                                            class="w-8 h-8 cursor-pointer flex items-center justify-center text-gray-500 hover:text-blue-600 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14M5 12h14M5 17h10" />
                                            </svg>
                                        </button>

                                        <div x-show="open" @click.outside="open=false" x-transition
                                            class="absolute top-[-30px] left-[-50px] -translate-x-1/2 mt-1 w-36 bg-white dark:bg-gray-700 rounded-md shadow-lg z-10">
                                            <a href="#"
                                                class="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 dark:hover:bg-gray-600">View</a>
                                            <a href="{{ route('product.edit', ['id' => $product->id]) }}"
                                                class="block px-4 py-2 text-sm text-amber-600 hover:bg-amber-50 dark:hover:bg-gray-600">Edit</a>
                                            <form action="{{ route('product.delete', ['id' => $product->id]) }}"
                                                method="POST" onsubmit="return confirm('Bạn chắc chưa?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-gray-600">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-gray-500">No products found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4 p-4">
                        {{ $products->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

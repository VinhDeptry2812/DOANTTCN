@extends('admin.dashboard')

@section('contents')
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

                <!-- TOP BAR -->
                <div class="flex flex-col md:flex-row items-center justify-between p-4 gap-3">

                    <!-- Search -->
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" method="GET">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg pl-10 p-2 w-full 
                                dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Search blog...">
                            </div>
                        </form>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('blog.create') }}"
                            class="flex items-center text-white bg-primary-700 hover:bg-primary-800 px-4 py-2 rounded-lg text-sm">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Thêm Blog
                        </a>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto p-4">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="px-6 py-3">Ảnh</th>
                                <th class="px-6 py-3">Tiêu đề</th>
                                <th class="px-6 py-3">Danh mục</th>
                                <th class="px-6 py-3">Trạng thái</th>
                                <th class="px-6 py-3">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($blogs as $blog)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">

                                    <!-- Thumbnail -->
                                    <td class="px-6 py-4">
                                        <img src="{{ asset($blog->thumbnail) }}"
                                            class="w-20 h-14 object-cover rounded shadow">
                                    </td>

                                    <!-- Title -->
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ Str::limit($blog->title, 40) }}
                                    </td>

                                    <!-- Category -->
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-300
                                        px-2 py-1 rounded-md text-xs font-medium">
                                            {{ $blog->category->name ?? 'Không có' }}
                                        </span>
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $blog->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $blog->status ? 'Hiện' : 'Ẩn' }}
                                        </span>
                                    </td>

                                    <!-- Dropdown Actions -->
                                    <td class="px-6 py-4 relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="text-gray-500 hover:text-blue-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14M5 12h14M5 17h10" />
                                            </svg>
                                        </button>

                                        <div x-show="open" @click.outside="open = false" x-transition
                                            class="absolute top-[-40px] left-0 mt-1 w-32 bg-white dark:bg-gray-700 rounded-md shadow-lg">

                                            <a href="#"
                                                class="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 dark:hover:bg-gray-600">
                                                Xem
                                            </a>

                                            <a href="{{route('blog.edit',$blog->id)}}"
                                                class="block px-4 py-2 text-sm text-amber-600 hover:bg-amber-50 dark:hover:bg-gray-600">
                                                Sửa
                                            </a>

                                            <form action="{{route('blog.delete',$blog->id)}}" method="POST"
                                                onsubmit="return confirm('Xóa blog này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-gray-600">
                                                    Xóa
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-gray-500">
                                        Chưa có bài viết nào
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    {{-- <div class="p-4">
                        {{ $blogs->links() }}
                    </div> --}}

                </div>
            </div>

        </div>
    </section>
@endsection

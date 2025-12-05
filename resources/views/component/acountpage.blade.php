@extends('component.mainlayout')
@section('title', 'Giỏ hàng')
@section('content')
    <div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg mt-10">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Thông tin tài khoản</h1>

        <div class="flex flex-col md:flex-row gap-8">
            {{-- Left: Avatar & Summary --}}
            <div class="md:w-1/3 flex flex-col items-center text-center">
                <img src="{{ asset('avartar/tải xuống.jpg') }}" alt="Avatar"
                    class="w-32 h-32 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600 mb-4">

                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500 dark:text-gray-300">{{ Auth::user()->email }}</p>

                <div class="mt-4 space-y-2 w-full">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Vai trò: <span class="font-medium">{{ ucfirst(Auth::user()->role) }}</span>
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Tham gia: {{ Auth::user()->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            {{-- Right: Edit Form --}}
            <div class="md:w-2/3">
                <form action="{{route('acount.update_info')}}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Họ và tên --}}
                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Họ và tên</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                            @if (Auth::user()->role === 'admin') disabled @endif
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 
                       @if (Auth::user()->role === 'admin') bg-gray-100 text-gray-400 cursor-not-allowed @else bg-white text-gray-900 @endif
                       focus:outline-none focus:ring-2 focus:ring-[#f9a602]">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}"
                            @if (Auth::user()->role === 'admin') disabled @endif
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2
                       @if (Auth::user()->role === 'admin') bg-gray-100 text-gray-400 cursor-not-allowed @else bg-white text-gray-900 @endif">
                    </div>

                    {{-- Mật khẩu mới --}}
                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Mật khẩu mới (tùy
                            chọn)</label>
                        <input type="password" name="password" placeholder="Nhập mật khẩu mới nếu muốn đổi"
                            @if (Auth::user()->role === 'admin') disabled @endif
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 
                       @if (Auth::user()->role === 'admin') bg-gray-100 text-gray-400 cursor-not-allowed @else bg-white text-gray-900 @endif
                       focus:outline-none focus:ring-2 focus:ring-[#f9a602]">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 rounded-full bg-[#f9a602] hover:bg-[#f7a600] text-white font-semibold transition">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>


@endsection

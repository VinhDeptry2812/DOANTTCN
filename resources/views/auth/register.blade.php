<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Đăng ký tài khoản</title>
</head>

<body class="bg-[#FFF9E6] min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">
            Tạo tài khoản mới
        </h1>

        <form method="POST" action="{{ route('postRegister') }}" class="space-y-5">
            @csrf

            {{-- NAME --}}
            <div>
                <label for="name" class="block mb-2 text-sm font-semibold text-gray-700">
                    Họ và tên
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       class="w-full p-3 border border-gray-300 rounded-xl focus:ring-[#FF9B00] focus:border-[#FF9B00]"
                       placeholder="Nhập họ và tên"
                       required>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div>
                <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">
                    Email
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       class="w-full p-3 border border-gray-300 rounded-xl focus:ring-[#FF9B00] focus:border-[#FF9B00]"
                       placeholder="Nhập email"
                       required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div>
                <label for="password" class="block mb-2 text-sm font-semibold text-gray-700">
                    Mật khẩu
                </label>
                <input type="password" id="password" name="password"
                       class="w-full p-3 border border-gray-300 rounded-xl focus:ring-[#FF9B00] focus:border-[#FF9B00]"
                       placeholder="Nhập mật khẩu"
                       required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-semibold text-gray-700">
                    Xác nhận mật khẩu
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="w-full p-3 border border-gray-300 rounded-xl focus:ring-[#FF9B00] focus:border-[#FF9B00]"
                       placeholder="Nhập lại mật khẩu"
                       required>
                @error('password_confirmation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                    class="w-full py-3 text-white rounded-full bg-[#FF9B00] hover:bg-[#f48a00] font-semibold text-lg shadow">
                Tạo tài khoản
            </button>

            <p class="text-center text-gray-600 text-sm">
                Đã có tài khoản?
                <a href="{{ route('login') }}" class="text-[#FF9B00] font-semibold hover:underline">
                    Đăng nhập ngay
                </a>
            </p>
        </form>

    </div>

</body>

</html>

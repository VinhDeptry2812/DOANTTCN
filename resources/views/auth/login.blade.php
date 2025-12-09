<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/resources/css/app.css">
    <script src="/resources/js/app.js"></script>
    <title>Đăng nhập | YODY Style</title>
</head>

<body class="bg-[#FFF9E6] flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">
            Đăng nhập tài khoản
        </h1>

        <form method="POST" action="{{ route('postLogin') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">
                    Email
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full p-3 border border-gray-300 rounded-xl focus:border-[#FF9B00] focus:ring-[#FF9B00]"
                    placeholder="Nhập email..." required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block mb-2 text-sm font-semibold text-gray-700">
                    Mật khẩu
                </label>
                <input type="password" name="password" id="password"
                    class="w-full p-3 border border-gray-300 rounded-xl focus:border-[#FF9B00] focus:ring-[#FF9B00]"
                    placeholder="Nhập mật khẩu..." required>
            </div>

            <div class="flex justify-end">
                <a href="#" class="text-sm text-[#FF9B00] font-medium hover:underline">
                    Quên mật khẩu ?
                </a>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-3 rounded-full bg-[#FF9B00] hover:bg-[#f48a00] text-white font-semibold text-lg shadow">
                Đăng nhập
            </button>

            <p class="text-center text-gray-600 text-sm">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" class="text-[#FF9B00] font-semibold hover:underline">
                    Đăng ký ngay
                </a>
            </p>
        </form>
    </div>

</body>

</html>

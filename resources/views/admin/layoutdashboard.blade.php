<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>@yield('title')</title>
    <title>Register</title>
</head>

<body class="bg-gray-50 m-0 p-0 h-screen">
    <!-- Toast Message -->
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
            class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded shadow-lg z-50 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="ml-2 text-white hover:text-gray-200">&times;</button>
        </div>
    @endif

    @yield('content')
    <!-- ⚡ Import script Flowbite -->
    <script src="node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    {{-- script de review ảnh khi up từ input dropzone --}}
    <script>
        const input = document.getElementById('dropzone-file');
        const previewContainer = document.getElementById('dropzone-preview');

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                // Xóa nội dung cũ
                previewContainer.innerHTML = '';

                // Tạo ảnh
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'absolute top-0 left-0 w-full h-full object-contain';
                // object-contain: ảnh vừa khung, không crop, sẽ có khoảng trống nếu tỉ lệ khác

                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>

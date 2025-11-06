<!-- resources/views/welcome.blade.php -->
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

<body>
    <main class="h-screen">
        @yield('content')
    </main>
    <!-- ⚡ Import script Flowbite -->
    <script src="node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>

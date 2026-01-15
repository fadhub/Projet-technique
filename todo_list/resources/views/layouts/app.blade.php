<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>Todo Admin</title>
    <!-- Preline & Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/preline@latest/dist/preline.js"></script>
    <script src="{{ asset('js/tasks.js') }}" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-6">

    @yield('content')

    @vite(['resources/js/tasks.js'])
</body>
</html>

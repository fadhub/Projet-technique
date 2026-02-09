<!DOCTYPE html>
<html lang="fr" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Todo List') }} - Admin</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/preline/dist/preline.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#2563eb', // Standard Blue
                            600: '#2563eb', // Requested Blue
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-active {
            background-color: #eff6ff;
            color: #2563eb;
        }
    </style>
    
    @vite(['resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">

    <!-- Content -->
    <div class="w-full">
        <!-- Header -->
        <header class="flex w-full bg-white py-4 border-b border-gray-100">
            <nav class="w-full mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                <div>
                    <a href="{{ route('tasks.index') }}" class="inline-flex items-center gap-x-2 text-sm font-semibold text-gray-500 hover:text-blue-600 transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        Voir le site public
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="relative inline-flex" x-data="{ open: false }" @click.outside="open = false">
                            <button @click="open = !open" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors flex items-center gap-x-1">
                                <span class="size-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold mr-1">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                                {{ Auth::user()->name }}
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            <div x-show="open" x-cloak class="absolute right-0 top-full mt-2 w-48 bg-white border border-gray-100 rounded-lg shadow-lg py-1 z-[100]">
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </nav>
        </header>

        <!-- Main Content Area -->
        <main class="p-4 sm:p-6 lg:p-10">
            @if(session('success'))
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-xl p-4 flex items-center gap-x-3">
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-800 text-sm rounded-xl p-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Preline JS -->
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.min.js"></script>
    
    @yield('scripts')
</body>
</html>


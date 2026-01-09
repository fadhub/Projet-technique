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
    
    @yield('styles')
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">

    <!-- Navigation Toggle -->
    <button type="button" class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 focus:outline-none" data-hs-overlay="#sidebar" aria-controls="sidebar" aria-label="Toggle navigation">
        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform fixed top-0 start-0 bottom-0 z-[60] w-64 bg-white border-e border-gray-200 lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 overflow-y-auto">
        <div class="px-6 py-4">
            <a class="flex-none text-2xl font-bold flex items-center gap-x-2 text-primary-600" href="{{ route('admin.tasks.index') }}" aria-label="Brand">
                <svg class="w-8 h-8 rounded-lg bg-primary-600 text-white p-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                TodoHub
            </a>
        </div>

        <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
            <ul class="space-y-1.5">
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm font-semibold rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.tasks.*') ? 'sidebar-active' : 'text-gray-500' }}" href="{{ route('admin.tasks.index') }}">
                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m9 12 2 2 4-4"/></svg>
                        Tasks
                    </a>
                </li>

                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm font-semibold text-gray-500 rounded-lg hover:bg-gray-100" href="/">
                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        Public Site
                    </a>
                </li>
            </ul>
        </nav>
    </div>


    <!-- Content -->
    <div class="lg:ps-64">
        <!-- Header -->
        <header class="sticky top-0 z-40 flex w-full bg-white border-b border-gray-200 py-2.5 sm:py-4">
            <nav class="w-full mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                <div class="flex items-center gap-x-3">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="flex-shrink-0 w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </div>
                        <input type="text" id="globalSearchInput" class="py-2.5 ps-10 pe-4 block w-64 md:w-96 border-0 focus:ring-0 text-sm placeholder-gray-400" placeholder="Rechercher...">
                    </div>
                </div>

                <div class="flex items-center gap-x-3">
                    <img src="https://images.unsplash.com/photo-1531927557220-a9e23c1e4794?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=300&h=300&q=80" alt="Avatar" class="w-8 h-8 rounded-full">
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

            @yield('content')
        </main>
    </div>

    <!-- Preline JS -->
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.min.js"></script>
    
    @yield('scripts')
</body>
</html>


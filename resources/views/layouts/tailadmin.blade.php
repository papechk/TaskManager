<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', sidebarOpen: false }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TaskManager') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 dark:bg-boxdark-2 min-h-screen">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="absolute left-0 top-0 z-50 flex h-screen w-72 flex-col overflow-y-hidden bg-boxdark duration-300 ease-linear lg:static lg:translate-x-0"
            @click.away="sidebarOpen = false"
        >
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between gap-2 px-6 py-5 lg:py-6 border-b border-strokedark">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary-500">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </span>
                    <span class="text-xl font-bold text-white">TaskManager</span>
                </a>
                <button @click="sidebarOpen = false" class="block lg:hidden text-gray-400 hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Sidebar Menu -->
            <nav class="flex flex-col overflow-y-auto px-4 py-4">
                <div>
                    <h3 class="mb-4 ml-4 text-xs font-semibold uppercase text-sidebar-menu">Menu</h3>
                    <ul class="mb-6 flex flex-col gap-1">
                        <li>
                            <a href="{{ route('home') }}" class="group flex items-center gap-2.5 rounded-md px-4 py-2 font-medium text-sidebar-menu hover:bg-white/10 hover:text-white {{ request()->routeIs('home') ? 'bg-white/10 text-white' : '' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tasks.index') }}" class="group flex items-center gap-2.5 rounded-md px-4 py-2 font-medium text-sidebar-menu hover:bg-white/10 hover:text-white {{ request()->routeIs('tasks.index') ? 'bg-white/10 text-white' : '' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Toutes les tâches
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tasks.MyTask') }}" class="group flex items-center gap-2.5 rounded-md px-4 py-2 font-medium text-sidebar-menu hover:bg-white/10 hover:text-white {{ request()->routeIs('tasks.MyTask') ? 'bg-white/10 text-white' : '' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Mes tâches
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tasks.create') }}" class="group flex items-center gap-2.5 rounded-md px-4 py-2 font-medium text-sidebar-menu hover:bg-white/10 hover:text-white {{ request()->routeIs('tasks.create') ? 'bg-white/10 text-white' : '' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Nouvelle tâche
                            </a>
                        </li>
                    </ul>
                </div>

                @if(Auth::user()->hasRole('admin'))
                <div>
                    <h3 class="mb-4 ml-4 text-xs font-semibold uppercase text-sidebar-menu">Administration</h3>
                    <ul class="mb-6 flex flex-col gap-1">
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-2.5 rounded-md px-4 py-2 font-medium text-sidebar-menu hover:bg-white/10 hover:text-white {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white' : '' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                                Utilisateurs
                            </a>
                        </li>
                    </ul>
                </div>
                @endif
            </nav>
        </aside>

        <!-- Content Area -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">

            <!-- Header -->
            <header class="sticky top-0 z-40 flex w-full bg-white dark:bg-boxdark border-b border-stroke dark:border-strokedark">
                <div class="flex flex-grow items-center justify-between py-4 px-4 shadow-sm md:px-6 2xl:px-11">
                    <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
                        <!-- Mobile Menu Button -->
                        <button @click="sidebarOpen = !sidebarOpen" class="z-50 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm dark:border-strokedark dark:bg-boxdark lg:hidden">
                            <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>

                    <div class="hidden sm:block">
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">@yield('title', 'Dashboard')</h1>
                    </div>

                    <div class="flex items-center gap-3 2xsm:gap-7">
                        <!-- Dark Mode Toggle -->
                        <button @click="darkMode = !darkMode" class="flex h-9 w-9 items-center justify-center rounded-full border border-stroke bg-gray-50 hover:bg-gray-100 dark:border-strokedark dark:bg-boxdark-2 dark:hover:bg-boxdark">
                            <svg x-show="!darkMode" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg x-show="darkMode" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </button>

                        <!-- User Dropdown -->
                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-4">
                                <span class="hidden text-right lg:block">
                                    <span class="block text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                                    <span class="block text-xs text-gray-500">{{ Auth::user()->email }}</span>
                                </span>
                                <span class="h-10 w-10 rounded-full bg-primary-500 flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </span>
                                <svg class="hidden fill-current sm:block" width="12" height="8" viewBox="0 0 12 8" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z" fill="currentColor"/>
                                </svg>
                            </button>

                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-4 flex w-62 flex-col rounded-lg border border-stroke bg-white shadow-card dark:border-strokedark dark:bg-boxdark"
                                 style="display: none;">
                                <ul class="flex flex-col gap-5 border-b border-stroke px-6 py-5 dark:border-strokedark">
                                    <li>
                                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3.5 text-sm font-medium text-gray-600 hover:text-primary-500 dark:text-gray-300 dark:hover:text-primary-400">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Mon Profil
                                        </a>
                                    </li>
                                </ul>
                                <div class="px-6 py-4">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-3.5 text-sm font-medium text-gray-600 hover:text-danger-500 dark:text-gray-300 dark:hover:text-danger-400">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Déconnexion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="mx-auto w-full max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                @if(session('success'))
                    <div class="mb-4 rounded-lg bg-success-100 px-4 py-3 text-sm text-success-600 dark:bg-success-500/20 dark:text-success-500">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 rounded-lg bg-danger-100 px-4 py-3 text-sm text-danger-600 dark:bg-danger-500/20 dark:text-danger-500">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

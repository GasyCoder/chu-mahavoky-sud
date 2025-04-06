<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - CHU Mahavoky</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset ('assets/super.png')}}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-poppins bg-gray-light text-dark">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 shadow-lg bg-purple">
            <div class="p-6">
                <h2 class="text-xl font-bold text-white">Admin Panel</h2>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="mr-3 fas fa-tachometer-alt"></i> Tableau de bord
                </a>

                <!-- Menu déroulant pour les services -->
                <div x-data="{ open: false }" class="relative">
                    <!-- Bouton du menu déroulant -->
                    <button @click="open = !open" class="flex items-center justify-between w-full px-6 py-3 text-white hover:bg-purple-light focus:outline-none">
                        <div class="flex items-center">
                            <i class="mr-3 fas fa-concierge-bell"></i> Services
                        </div>
                        <i class="transition-transform fas fa-chevron-down" :class="{'transform rotate-180': open}"></i>
                    </button>

                    <!-- Contenu du menu déroulant -->
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="bg-purple-dark">

                        <a href="{{ route('admin.services.medical') }}" class="flex items-center py-2 pl-10 pr-6 text-white hover:bg-purple-light">
                            <i class="mr-3 fas fa-stethoscope"></i> Service technique
                        </a>

                        <a href="{{ route('admin.services.administration') }}" class="flex items-center py-2 pl-10 pr-6 text-white hover:bg-purple-light">
                            <i class="mr-3 fas fa-user-tie"></i> Administrations
                        </a>
                    </div>
                </div>

                <a href="{{ route('admin.news') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="mr-3 fas fa-newspaper"></i> Actualités
                </a>

                <a href="{{ route('profile.edit') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="mr-3 fas fa-user"></i> Profile
                </a>

                <a href="{{ route('admin.setting') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="mr-3 fas fa-cog"></i> Paramètres
                </a>

                <a href="/" target="_blank" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="mr-3 fas fa-globe"></i> Site web
                </a>

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="mr-3 fas fa-sign-out-alt"></i> Déconnexion
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1">
            <!-- Header -->
            <header class="flex items-center justify-between p-4 bg-white shadow">
                <h2 class="text-xl font-semibold">Tableau de bord</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-dark">{{ auth()->user()->name }}</span>
                    <i class="text-2xl fas fa-user-circle text-purple"></i>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/b50fc748ca.js" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>

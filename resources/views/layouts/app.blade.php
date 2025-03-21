<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - CHU Mahavoky</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset ('assets/super.png')}}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins bg-gray-light text-dark">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-purple shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-bold text-white">Admin Panel</h2>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="fas fa-tachometer-alt mr-3"></i> Tableau de bord
                </a>
                <a href="{{ route('admin.services') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="fas fa-concierge-bell mr-3"></i> Services
                </a>
                <a href="{{ route('admin.news') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="fas fa-newspaper mr-3"></i> Actualités
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="fas fa-user mr-3"></i> Profile
                </a>
                <a href="{{ route('admin.setting') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="fas fa-cog mr-3"></i> Paramètres
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center px-6 py-3 text-white hover:bg-purple-light">
                    <i class="fas fa-sign-out-alt mr-3"></i> Déconnexion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold">Tableau de bord</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-dark">{{ auth()->user()->name }}</span>
                    <i class="fas fa-user-circle text-2xl text-purple"></i>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/b50fc748ca.js" crossorigin="anonymous"></script>
</body>
</html>

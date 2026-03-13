<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CHU Mahavoky Atsimo') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans text-slate-900 antialiased selection:bg-primary/10 selection:text-primary">
        <div class="min-h-screen flex flex-col justify-center items-center bg-slate-100 p-4 relative overflow-hidden">
            <!-- Background Decorative Elements (Tailwind only) -->
            <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-primary/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-secondary/5 rounded-full blur-3xl"></div>

            <div class="w-full sm:max-w-md z-10 flex flex-col items-center">
                <!-- Logo Centered (x-application-logo already has an <a>) -->
                <div class="mb-8 transition-transform duration-500 hover:scale-105">
                    <x-application-logo class="w-auto h-16 drop-shadow-sm flex flex-col items-center gap-4" />
                </div>

                <!-- Login Card -->
                <div class="w-full bg-white shadow-xl shadow-slate-200/50 border border-slate-200 overflow-hidden rounded-[2rem] p-8 sm:p-10">
                    {{ $slot }}
                </div>
                
                <p class="mt-8 text-center text-slate-400 text-[10px] font-bold tracking-widest uppercase">
                    &copy; {{ date('Y') }} CHU Mahavoky Atsimo
                </p>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/b50fc748ca.js" crossorigin="anonymous"></script>
    </body>
</html>

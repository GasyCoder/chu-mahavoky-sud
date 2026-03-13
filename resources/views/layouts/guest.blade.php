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
        
        <style>
            .login-bg {
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
                position: relative;
                overflow: hidden;
            }
            .login-bg::before {
                content: '';
                position: absolute;
                top: -10%;
                right: -10%;
                width: 40%;
                height: 40%;
                background: radial-gradient(circle, rgba(0, 85, 164, 0.05) 0%, transparent 70%);
                border-radius: 50%;
                z-index: 0;
            }
            .login-bg::after {
                content: '';
                position: absolute;
                bottom: -10%;
                left: -10%;
                width: 40%;
                height: 40%;
                background: radial-gradient(circle, rgba(0, 161, 157, 0.05) 0%, transparent 70%);
                border-radius: 50%;
                z-index: 0;
            }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased selection:bg-primary/10 selection:text-primary">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 login-bg p-4">
            <div class="z-10 transition-transform duration-500 hover:scale-105 mb-8">
                <a href="/" class="flex flex-col items-center">
                    <x-application-logo class="w-24 h-24 drop-shadow-sm" />
                </a>
            </div>

            <div class="w-full sm:max-w-md z-10">
                <div class="bg-white/80 backdrop-blur-xl shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-white/50 overflow-hidden rounded-[2rem] p-8 sm:p-10">
                    {{ $slot }}
                </div>
                
                <p class="mt-8 text-center text-slate-400 text-xs font-medium tracking-wide uppercase">
                    &copy; {{ date('Y') }} CHU Mahavoky Atsimo. Tous droits réservés.
                </p>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/b50fc748ca.js" crossorigin="anonymous"></script>
    </body>
</html>

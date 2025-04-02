<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Métadonnées SEO dynamiques -->
    <title>{{ $title ?? $settings['site_name'] }}</title>
    <meta name="description" content="{{ $description ?? $settings['site_description'] }}">
    @if(isset($settings['seo']['keywords']) && !empty($settings['seo']['keywords']))
    <meta name="keywords" content="{{ $settings['seo']['keywords'] }}">
    @endif
    <!-- Favicon dynamique -->
    @if(isset($settings['favicon']) && $settings['favicon'])
    <link rel="icon" type="image/x-icon" href="{{ $settings['favicon'] }}">
    @else
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/logo.png') }}">
    @endif
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles supplémentaires -->
    @stack('styles')
</head>
<body>
    @include('layouts.partials.topnavbar')
    @include('layouts.partials.navbar')

    <!-- Page Content -->
    <div class="w-screen overflow-x-hidden">
        {{ $slot }}

        <!-- Bouton retour en haut -->
        <button id="backToTop" class="fixed bottom-8 right-8 z-50 hidden h-12 w-12 rounded-full bg-purple shadow-lg transition-all duration-300 hover:bg-turquoise">
            <i class="fa fa-arrow-up text-white"></i>
        </button>

        @include('layouts.partials.footer')
    </div>

    <script src="https://kit.fontawesome.com/b50fc748ca.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/lenis@1.1.5/dist/lenis.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts supplémentaires -->
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title inertia>{{ $title ?? $settings['site_name'] ?? 'CHU Mahavoky' }}</title>
    
    <meta name="description" content="{{ $description ?? $settings['site_description'] ?? '' }}">
    @if(isset($settings['seo']['keywords']) && !empty($settings['seo']['keywords']))
    <meta name="keywords" content="{{ $settings['seo']['keywords'] }}">
    @endif
    
    <link rel="icon" type="image/x-icon" href="{{ $settings['favicon'] ?? asset('assets/logo.png') }}">
    
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @inertiaHead
</head>
<body class="font-sans antialiased">
    @inertia
    
    <script src="https://kit.fontawesome.com/b50fc748ca.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/lenis@1.1.5/dist/lenis.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Configuration globale pour les pages
        window.flashMessages = @json(session()->all());
    </script>
</body>
</html>

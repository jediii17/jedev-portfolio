<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="lenis lenis-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="favicon.ico" sizes="any">

    <title>{{ $title ?? 'Jedidia Lemuel B. Cruz | Software Engineer' }}</title>
    <meta name="description" content="{{ $description ?? 'Portfolio of Jedidia Lemuel B. Cruz, a Software Engineer specializing in Laravel, Vue.js, and backend development.' }}">
    <meta name="theme-color" content="#0a0a0a" media="(prefers-color-scheme: dark)">
    <meta name="theme-color" content="#fafafa" media="(prefers-color-scheme: light)">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Jedidia Lemuel B. Cruz | Software Engineer' }}">
    <meta property="og:description" content="{{ $description ?? 'Portfolio of Jedidia Lemuel B. Cruz, a Software Engineer specializing in Laravel, Vue.js, and backend development.' }}">
    <meta property="og:image" content="{{ asset('images/profile.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $title ?? 'Jedidia Lemuel B. Cruz | Software Engineer' }}">
    <meta property="twitter:description" content="{{ $description ?? 'Portfolio of Jedidia Lemuel B. Cruz, a Software Engineer specializing in Laravel, Vue.js, and backend development.' }}">
    <meta property="twitter:image" content="{{ asset('images/profile.png') }}">

    <!-- DNS Prefetch for external resources -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://images.unsplash.com">

    <!-- Fonts - Modern Typography (preconnect + swap) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&family=Inter:wght@300;400;500;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-page text-main antialiased"
    x-data
    x-bind:class="$store.theme.isDark ? 'dark' : ''">

    <x-loader />

    {{-- Main Content - No max-width constraint for parallax sections --}}
    <div class="flex min-h-screen flex-col" id="smooth-wrapper">
        <x-nav />

        <main class="flex-1" id="smooth-content">
            {{ $slot }}
        </main>

        <x-footer />
    </div>

    <x-chatbot />
    <x-custom-cursor />
    @stack('scripts')
</body>

</html>
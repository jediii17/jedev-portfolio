<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Jedidia Lemuel B. Cruz | Software Engineer' }}</title>
    <meta name="description" content="{{ $description ?? 'Portfolio of Jedidia Lemuel B. Cruz, a Software Engineer specializing in Laravel, Vue.js, and backend development.' }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Jedidia Lemuel B. Cruz | Software Engineer' }}">
    <meta property="og:description" content="{{ $description ?? 'Portfolio of Jedidia Lemuel B. Cruz, a Software Engineer specializing in Laravel, Vue.js, and backend development.' }}">
    <meta property="og:image" content="{{ asset('images/jed.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $title ?? 'Jedidia Lemuel B. Cruz | Software Engineer' }}">
    <meta property="twitter:description" content="{{ $description ?? 'Portfolio of Jedidia Lemuel B. Cruz, a Software Engineer specializing in Laravel, Vue.js, and backend development.' }}">
    <meta property="twitter:image" content="{{ asset('images/jed.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-page text-main antialiased transition-colors duration-300"
    x-data
    x-bind:class="$store.theme.isDark ? 'dark' : ''">

    <x-loader />

    <div class="flex min-h-screen flex-col">
        <x-nav />

        <main class="flex-1 w-full max-w-[900px] mx-auto px-6 py-12 md:py-12 animate-fade-in">
            {{ $slot }}
        </main>

        <x-footer />
    </div>

    <x-custom-cursor />
    @stack('scripts')
</body>

</html>
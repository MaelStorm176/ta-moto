<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <meta name="description" content="{{ setting('site.description') }}">
    <meta name="keywords" content="moto, vente, en ligne, occasion, neuve">
    <meta name="author" content="Ta moto">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="google" content="nositelinkssearchbox">
    <meta name="google" content="notranslate">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png', true) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png', true) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png', true) }}">
    <link rel="manifest" href="{{ asset('site.webmanifest', true) }}">

    <title>{{ setting('site.title') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/chatbot/main.css', 'resources/js/app.js', 'resources/js/chatbot/main.js'])

    @auth
        @vite('resources/js/notification/get_notifications.js')
    @endauth

    @yield('scripts')

    @vite('resources/js/alpine.js')
</head>

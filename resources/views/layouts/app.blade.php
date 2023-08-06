<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @stack('styles')
    @stack('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div>
        <div class="p-3">
            <h1 class="text-5xl text-blue-700 first-letter:text-7xl font-extrabold">Amenagement territoriale Ambatoloana</h1>
        </div>
        <main>
            {{ $slot }}
        </main>
        <div class="flex justify-end px-3">
            <div class="text-sm flex gap-5">
                <span class="font-semibold">Laravel 10</span>
                <span class="font-semibold">PostgreSql</span>
                <span class="font-semibold">PostGis</span>
                <span class="font-semibold">OpenLayers</span>
                <span class="font-semibold">OpenStreetMap</span>
                <span class="font-semibold">Geoserver</span>
            </div>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>

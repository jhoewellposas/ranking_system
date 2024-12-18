@props(['title' => 'Login Form']) <!-- Define $title with a default value -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FSUU Ranking System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <!-- Logo and Header Section -->
            <div class="flex flex-col items-center space-y-2 mb-6">
                <a href="/" class="flex items-center space-x-4">
                    <img src="{{ asset('FSUU_Logo/fsuu2_1.png') }}" alt="FSUU Logo" class="w-16 h-16 sm:w-20 sm:h-20">
                    <div class="text-left">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 leading-tight">
                            FSUU
                        </h1>
                        <p class="text-lg sm:text-xl font-semibold text-gray-600">
                            Ranking System
                        </p>
                    </div>
                </a>
            </div>

            <!-- Content Container -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <h1 class="text-xl font-bold mb-4 text-center">{{ $title }}</h1>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

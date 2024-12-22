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
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        <style>
            body::-webkit-scrollbar {
              display: none; /* Hides scrollbar for WebKit browsers */
            }
          </style>
    </head>
    <body class="main-display font-sans antialiased overflow-auto">
        <div class="min-h-screen bg-white">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <footer class="bg-white shadow mt-8">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center print:hidden">
                &copy; {{ date('Y') }} FSUU Ranking System. All rights reserved.
            </div>
        </footer>
    </body>
</html>

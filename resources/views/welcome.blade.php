<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('FSUU_Logo/fsuu2_1.png') }}" type="image/png">
    <title>FSUU Ranking System</title>
    @vite(['resources/css/app.css']) <!-- Include your compiled CSS -->
</head>
<body style="background-image: url('{{ asset('FSUU_Logo/FSUU.jpg') }}'); background-size: cover; background-position: center;" class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-6 max-w-lg bg-white shadow-lg rounded-lg bg-opacity-90">
        <div class="text-center">
            <img class="mx-auto w-24 h-24" src="{{ asset('FSUU_Logo/fsuu2_1.png') }}" alt="FSUU Logo">
            <h1 class="text-2xl font-bold text-gray-800 mt-4">Welcome to FSUU Ranking System</h1>
            <p class="text-gray-600 mt-2">
                Ranking System for Father Saturnino Urios University Faculty
            </p>
            <div class="mt-6 flex justify-center space-x-4">
                <a href="{{ route('login') }}" 
                   class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                   Login
                </a>
                <a href="{{ route('register') }}" 
                   class="px-6 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                   Register
                </a>
            </div>
        </div>
    </div>
</body>
</html>

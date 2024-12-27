<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="container mx-auto text-center px-4 py-6">
        <h2 class="text-2xl font-semibold text-gray-800">Welcome, {{ auth()->user()->name }}</h2>
    
        <div class="mt-4">
            <!-- Apply for Ranking Button -->
            <a href="{{ route('user.createApplication') }}"
               class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition duration-300">
                Apply for Ranking
            </a>
        </div>
    </div>    

</x-app-layout>

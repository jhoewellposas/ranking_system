<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="container text-center">
    <h2>Welcome, {{ auth()->user()->name }}</h2>

    <div class="mt-4">
        <!-- Apply for Ranking Button -->
        <a href="{{ route('user.createApplication') }}" class="btn btn-primary">
            Apply for Ranking
        </a>
    </div>
</div>

    </div>
</x-app-layout>

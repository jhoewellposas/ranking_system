<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as User!") }}
                </div>
            </div>
        </div>
    </div>

    
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

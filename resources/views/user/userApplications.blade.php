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

    <div class="container">
    <h2>Your Ranking Applications</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($applications->count() > 0)
        @foreach ($applications as $application)
            <div class="card mt-3">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h5>Name: {{ auth()->user()->name }}</h5>
                        <p>Date of application: {{ $application->created_at->format('m/d/Y') }}</p>
                        <p>Status: {{ ucfirst($application->status) }}</p>
                    </div>
                    <div>
                        <h5>Ranking Application no: {{ $application->id }}</h5>
                        <a href="{{ route('user.viewApplication', $application->id) }}" class="btn btn-primary mt-2">
                            Open
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="mt-4">You have not submitted any applications yet.</p>
    @endif

    </div>
</x-app-layout>
</div>
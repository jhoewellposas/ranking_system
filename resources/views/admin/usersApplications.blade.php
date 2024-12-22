<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">All Ranking Applications</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Applications Grid -->
        @if ($applications->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($applications as $application)
                    <div class="bg-white shadow-md rounded-lg p-4 flex flex-col justify-between">
                        <div>
                            <h5 class="text-lg font-bold text-gray-800">User: {{ $application->user->name }}</h5>
                            <p class="text-sm text-gray-600">Email: {{ $application->user->email }}</p>
                            <p class="text-sm text-gray-600">Date of application: {{ $application->created_at->format('m/d/Y') }}</p>
                            <p class="text-sm text-gray-600">Status: 
                                <span class="font-medium text-gray-800">{{ ucfirst($application->status) }}</span>
                            </p>
                        </div>
                        <div class="mt-4">
                            <h5 class="text-sm font-medium text-gray-600">Ranking Application No: {{ $application->id }}</h5>
                            <a href="{{ route('admin.viewApplication', $application->id) }}" class="block bg-blue-500 text-white text-center px-4 py-2 rounded mt-2 hover:bg-blue-600">
                                Open
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- No Applications Message -->
            <p class="text-gray-600 mt-6">No applications have been submitted yet.</p>
        @endif
    </div>
</x-app-layout>

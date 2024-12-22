<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Faculty Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="p-6 text-gray-900 text-lg font-medium">
                    {{ __("You're logged in as User!") }}
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Ranking Applications Section -->
<div class="w-full px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Your Ranking Applications</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Applications -->
        @if ($applications->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($applications as $application)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Name: {{ auth()->user()->name }}</h3>
                                <p class="text-gray-600">Date of application: {{ $application->created_at->format('m/d/Y') }}</p>
                                <p class="text-gray-600">
                                    Status: <span class="font-semibold capitalize text-{{ $application->status === 'approved' ? 'green-600' : ($application->status === 'pending' ? 'yellow-600' : 'red-600') }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <h5 class="text-sm text-gray-500">Ranking Application No: {{ $application->id }}</h5>
                                <a href="{{ route('user.viewApplication', $application->id) }}" 
                                   class="inline-block px-4 py-2 mt-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700">
                                    Open
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 mt-4">You have not submitted any applications yet.</p>
        @endif
    </div>
</div>

</x-app-layout>

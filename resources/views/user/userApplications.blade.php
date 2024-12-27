<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Faculty Dashboard') }}
        </h2>
    </x-slot> --}}

    <!-- Ranking Applications Section -->
    <div class="flex flex-col items-center justify-center min-h-screen">
        <div class="w-full max-w-4xl px-4 py-6 bg-white rounded-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">My Ranking Applications</h2>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Applications -->
            @if ($applications->count() > 0)
                <div class="flex flex-col gap-4">
                    @foreach ($applications as $application)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex flex-col lg:flex-row justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">User: {{ $application->user->name }}</h3>
                                    <p class="text-gray-600">Email: {{ $application->user->email }}</p>
                                    <p class="text-gray-600">Date of application: {{ $application->created_at->format('m/d/Y') }}</p>
                                    <p class="text-gray-600">
                                        Status: <span class="font-semibold capitalize text-{{ $application->status === 'approved' ? 'green-600' : ($application->status === 'pending' ? 'yellow-600' : 'red-600') }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="mt-4 lg:mt-0">
                                    <h5 class="text-sm text-gray-500">Ranking Application No: {{ $application->id }}</h5>
                                    <a href="{{ route('user.viewApplication', $application->id) }}" 
                                       class="inline-block px-8 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700">
                                        Open
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center">You have not submitted any applications yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot> --}}

    <!-- Container for centering the content -->
    <div class="flex flex-col items-center justify-center min-h-screen">
        <div class="w-full max-w-4xl px-4 py-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">All Ranking Applications</h2>

            <!-- Search Form -->
        <form method="GET" action="{{ route('admin.usersApplications') }}" class="flex items-center space-x-2 mb-4">
            <input type="text" name="query" value="{{ request('query')}}" placeholder="Search" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        </form>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Applications Content -->
            @if ($applications->count() > 0)
                <div class="space-y-4">
                    @foreach ($applications as $application)
                    <div class="bg-white shadow-md rounded-lg p-4 flex justify-between items-center">
                        <div>
                            <h5 class="text-lg font-bold text-gray-800">User: {{ $application->user->name }}</h5>
                            <p class="text-gray-600">Email: {{ $application->user->email }}</p>
                            <p class="text-gray-600">Date of application: {{ $application->created_at->format('m/d/Y') }}</p>
                            <p class="text-gray-600">Status: 
                                <span class="font-medium text-gray-800">{{ ucfirst($application->status) }}</span>
                            </p>
                        </div>
                        <div>
                            <h5 class="text-sm font-medium text-gray-600">Ranking Application No: {{ $application->id }}</h5>
                            <div class="mt-2">
                                <a href="{{ route('admin.viewApplication', $application->id) }}" 
                                   class="inline-block bg-blue-500 text-white text-center px-6 py-1 rounded hover:bg-blue-600">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>                    
                    @endforeach
                </div>
            @else
                <!-- No Applications Message -->
                <p class="text-gray-600 text-center">No applications being submitted yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>

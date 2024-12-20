<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
    <h2>All Ranking Applications</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($applications->count() > 0)
        @foreach ($applications as $application)
            <div class="card mt-3">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h5>User: {{ $application->user->name }}</h5>
                        <p>Email: {{ $application->user->email }}</p>
                        <p>Date of application: {{ $application->created_at->format('m/d/Y') }}</p>
                        <p>Status: {{ ucfirst($application->status) }}</p>
                    </div>
                    <div>
                        <h5>Ranking Application no: {{ $application->id }}</h5>
                        <a href="{{ route('admin.viewApplication', $application->id) }}" class="btn btn-primary mt-2">
                            Open
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="mt-4">No applications have been submitted yet.</p>
    @endif
</div>
</x-app-layout>

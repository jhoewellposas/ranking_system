<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-start w-full h-screen bg-gray-100 pt-10">
        <div class="w-full max-w-xl p-6 bg-white rounded-lg shadow-lg overflow-hidden">
            <h3 class="text-lg font-semibold text-center text-gray-800 mb-4">Notifications</h3>
            <!-- Set max height to fit exactly two items -->
            <ul class="overflow-auto max-h-64"> <!-- max-h-24 equals 6rem or 96px -->
                @foreach($notifications as $notification)
                    <li class="p-2 hover:bg-gray-50">
                        New application from {{ $notification->data['user_name'] }} - 
                        <a href="{{ route('admin.viewApplication', $notification->data['application_id']) }}" class="text-blue-500 hover:underline">
                            View Application
                        </a>
                        <form action="{{ route('notification.read', $notification->id) }}" method="POST" class="inline">
                            @csrf
                            {{-- <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 rounded px-2 py-1 ml-2">Mark as Read</button> --}}
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>    

</x-app-layout>
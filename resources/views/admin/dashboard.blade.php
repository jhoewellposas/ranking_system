<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="notifications">
        <h3>Notifications</h3>
        <ul>
            @foreach($notifications as $notification)
                <li>
                    New application from {{ $notification->data['user_name'] }} - 
                    <a href="{{ route('admin.viewApplication', $notification->data['application_id']) }}">
                        View Application
                    </a>
                    <form action="{{ route('notification.read', $notification->id) }}" method="POST">
                        @csrf
                        <button type="submit">Mark as Read</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

</x-app-layout>
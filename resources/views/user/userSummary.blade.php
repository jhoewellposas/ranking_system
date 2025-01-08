<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty Dashboard') }}
        </h2>
    </x-slot> --}}

    <!-- User Details -->
    <div class="bg-white shadow-md rounded-lg p-6 flex flex-col">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Teacher Rank and Information</h2>
        <div class="flex flex-col space-y-2">
            <p class="text-gray-700 flex items-center"><strong>Name:</strong> <span class="ml-2">{{ $user->name }}</span></p>
            <p class="text-gray-700 flex items-center"><strong>Academic Attainment:</strong> <span class="ml-2">{{ $user->acad_attainment }}</span></p>
            <p class="text-gray-700 flex items-center"><strong>Date Hired:</strong> <span class="ml-2">{{ $user->date_hired }}</span></p>
            <p class="text-gray-700 flex items-center"><strong>Office:</strong> <span class="ml-2">{{ $user->office }}</span></p>
            <p class="text-gray-700 flex items-center"><strong>Experience:</strong> <span class="ml-2">{{ $user->experienceLabel }}</span></p>
            <p class="text-gray-700 flex items-center"><strong>Rank:</strong> <span class="ml-2">{{ $user->next_rank }}</span></p>
        </div>
    </div>


</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty Dashboard') }}
        </h2>
    </x-slot>

    <!-- User Details -->
    <div class="bg-white shadow-md rounded-lg p-6 flex flex-col">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">User Details</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-grow">
                    <p class="text-gray-700"><strong>Name:</strong> {{ $user->name }}</p>
                    <p class="text-gray-700"><strong>Academic Attainment:</strong> {{ $user->acad_attainment }}</p>
                    <p class="text-gray-700"><strong>Date Hired:</strong> {{ $user->date_hired }}</p>
                    <p class="text-gray-700"><strong>Office:</strong> {{ $user->office }}</p>
                    <p class="text-gray-700"><strong>Experience:</strong> {{ $user->experienceLabel }}</p>
                    <p class="text-gray-700"><strong>Rank:</strong> {{ $user->next_rank }}</p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

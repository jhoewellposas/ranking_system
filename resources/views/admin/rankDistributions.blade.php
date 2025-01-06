<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-5">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Rank Percentage Distribution Table</h1>
        <form action="{{ route('rankDistributions.update') }}" method="POST" class="overflow-x-auto">
            @csrf
            <table class="min-w-full table-auto bg-white rounded-lg shadow-md text-sm text-center text-gray-700">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Rank</th>
                        <th class="px-6 py-3">Productive Scholarship_A (%)</th>
                        <th class="px-6 py-3">Productive Scholarship_B (%)</th>
                        <th class="px-6 py-3">Community Extension Services_A (%)</th>
                        <th class="px-6 py-3">Community Extension Services_B (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rankDistributions as $distribution)
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">
                            <input type="text" name="distributions[{{ $loop->index }}][rank]" value="{{ $distribution->rank }}" readonly class="bg-gray-100 rounded border border-gray-300 p-2 text-gray-700 leading-tight focus:outline-none focus:border-blue-500 w-full text-center">
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" step="0.01" name="distributions[{{ $loop->index }}][productiveGroupAPercentage]" value="{{ $distribution->productiveGroupAPercentage }}" class="rounded border border-gray-300 p-2 text-gray-700 leading-tight focus:outline-none focus:border-blue-500 text-center">
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" step="0.01" name="distributions[{{ $loop->index }}][productiveGroupBPercentage]" value="{{ $distribution->productiveGroupBPercentage }}" class="rounded border border-gray-300 p-2 text-gray-700 leading-tight focus:outline-none focus:border-blue-500 text-center">
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" step="0.01" name="distributions[{{ $loop->index }}][communityGroupAPercentage]" value="{{ $distribution->communityGroupAPercentage }}" class="rounded border border-gray-300 p-2 text-gray-700 leading-tight focus:outline-none focus:border-blue-500 text-center">
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" step="0.01" name="distributions[{{ $loop->index }}][communityGroupBPercentage]" value="{{ $distribution->communityGroupBPercentage }}" class="rounded border border-gray-300 p-2 text-gray-700 leading-tight focus:outline-none focus:border-blue-500 text-center">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="mt-4 px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
                Save Changes
            </button>
        </form>
    </div>    

</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
    <h1>Rank Distribution Table</h1>
    <form action="{{ route('rankDistributions.update') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Productive Scholarship_A (%)</th>
                    <th>Productive Scholarship_B (%)</th>
                    <th>Community Extension Services_A (%)</th>
                    <th>Community Extension Services_B (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankDistributions as $distribution)
                <tr>
                    <td>
                        <input type="text" name="distributions[{{ $loop->index }}][rank]" value="{{ $distribution->rank }}" readonly>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="distributions[{{ $loop->index }}][productiveGroupAPercentage]" value="{{ $distribution->productiveGroupAPercentage }}">
                    </td>
                    <td>
                        <input type="number" step="0.01" name="distributions[{{ $loop->index }}][productiveGroupBPercentage]" value="{{ $distribution->productiveGroupBPercentage }}">
                    </td>
                    <td>
                        <input type="number" step="0.01" name="distributions[{{ $loop->index }}][communityGroupAPercentage]" value="{{ $distribution->communityGroupAPercentage }}">
                    </td>
                    <td>
                        <input type="number" step="0.01" name="distributions[{{ $loop->index }}][communityGroupBPercentage]" value="{{ $distribution->communityGroupBPercentage }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

</x-app-layout>
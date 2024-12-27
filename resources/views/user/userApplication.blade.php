<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty Dashboard') }}
        </h2>
    </x-slot> --}}

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as User!") }}
                </div>
            </div>
        </div>
    </div> --}}

    <div class="w-full px-4 sm:px-6 lg:px-8 py-8">
        <!-- Grid Layout for Application Details and Upload Certificates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Application Details -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Application Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><strong>Status:</strong> <span class="capitalize text-{{ $application->status === 'approved' ? 'green-600' : ($application->status === 'pending' ? 'yellow-600' : 'red-600') }}">{{ ucfirst($application->status) }}</span></p>
                    <p><strong>Total Points:</strong> {{ $application->total_points }}</p>
                    <p><strong>Comments:</strong> {{ $application->comments ?? 'No comments yet' }}</p>
                    <p><strong>Created On:</strong> {{ $application->created_at->format('m/d/Y') }}</p>
                </div>
            </div>
            
            <!-- Upload Certificates Section -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Upload Certificates</h2>
                <form action="{{ route('user.extractCertificateData') }}" method="post" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label for="certificates" class="block text-gray-700 font-medium">Upload Certificate Image:</label>
                        <input type="file" name="certificates[]" id="certificates" accept="image/*" multiple required class="block w-full mt-2 border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <input type="hidden" name="ranking_application_id" value="{{ $application->id }}">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700">Extract Data</button>
                </form>
            </div>
        </div>
        
        <!-- Back to Applications Button -->
        <div class="mt-6">
            <a href="{{ route('user.userApplications') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600">Back to Applications</a>
        </div>
        
        <!-- Certificates Table (Unaffected by Grid Layout) -->
        <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Uploaded Certificates</h3>
            <form method="GET" action="{{ route('user.viewApplication', $application->id) }}" class="mb-4 flex flex-col sm:flex-row gap-4 ml-auto justify-end">
                <input type="text" name="query" value="{{ $query }}" placeholder="Search certificates..." class="block w-1/2 max-w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700">Search</button>
            </form>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr class="border-t border-gray-200 text-center">
                            <!-- <th class="px-4 py-2 text-gray-700 font-medium">Category</th> -->
                            <th class="px-4 py-2 text-gray-700 font-medium">Type</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Title</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Organization/Sponsor</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Designation</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Number of Days</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Inclusive Date</th>
                            {{-- <th class="px-4 py-2 text-gray-700 font-medium w-24">OCR Output</th> --}}
                            <th class="px-4 py-2 text-gray-700 font-medium w-24">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($certificates as $certificate)
                            <tr class="border-t border-gray-200 text-center">
                                <!-- <td class="px-4 py-2">{{ $certificate->category }}</td> -->
                                <td class="px-4 py-2">{{ $certificate->type }}</td>
                                <td class="px-4 py-2">{{ $certificate->title }}</td>
                                <td class="px-4 py-2">{{ $certificate->organization }}</td>
                                <td class="px-4 py-2">{{ $certificate->designation }}</td>
                                <td class="px-4 py-2">{{ $certificate->days }}</td>
                                <td class="px-4 py-2">{{ $certificate->date }}</td>
                                {{-- <td class="px-4 py-2 w-24">
                                    <button type="button" class="px-2 py-1 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 ocr-result-btn" data-ocr="{{ $certificate->raw_text }}">
                                        View OCR Output
                                    </button>
                                </td> --}}
                                <td class="px-4 py-2 w-24">
                                    <div class="flex flex-col space-y-2">
                                        <form action="" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="px-3 py-2.5 bg-green-500 text-white font-semibold w-full rounded hover:bg-green-600 focus:ring focus:ring-green-300">
                                                Update
                                            </button>
                                        </form>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-500 text-white font-semibold w-full rounded hover:bg-red-600 focus:ring focus:ring-red-300">
                                                Delete
                                            </button>
                                        </form>
                                        <button type="button" class="px-3 py-2.5 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:ring focus:ring-blue-300 ocr-result-btn" data-ocr="{{ $certificate->raw_text }}">
                                            OCR Output
                                        </button>
                                    </div>
                                </td>                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-2 text-center text-gray-600">No certificates found for this ranking application.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mt-6 p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mt-6 p-4 text-red-800 bg-red-100 border border-red-200 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
    </div>
    

    <!-- JavaScript -->
    <script src="{{ asset('javascript/popupwindow.js') }}"></script>
    <script src="{{ asset('javascript/buttonConfirmations.js') }}"></script>

    </div>
</x-app-layout>
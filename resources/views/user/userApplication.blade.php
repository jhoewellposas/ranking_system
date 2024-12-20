<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as User!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
    <h2></h2>

    <div class="card mt-4">
        <div class="card-body">
            <p><strong>Status:</strong> {{ ucfirst($application->status) }}</p>
            <p><strong>Total Points:</strong> {{ $application->total_points }}</p>
            <p><strong>Comments:</strong> {{ $application->comments ?? 'No comments yet' }}</p>
            <p><strong>Created On:</strong> {{ $application->created_at->format('m/d/Y') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('user.userApplications') }}" class="btn btn-secondary">Back to Applications</a>
    </div>
    </div>

    <!-- Hidden input for teacher_id -->
    <div class="upload-container">
    <h1>Upload Certificates</h1>

    <form action="{{ route('user.extractCertificateData') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="certificate">Upload Certificate Image:</label>
        <input type="file" name="certificates[]" id="certificates" accept="image/*" multiple required>

         <!-- Hidden input for teacher_id -->
        <input type="hidden" name="ranking_application_id" value="{{ $application->id }}">

        <button type="submit">Extract Data</button>
    </form>
    </div>

    <!-- Display Success or Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


     <!-- Certificates Table -->
     <div class="table-container mt-4">
        <h3>Uploaded Certificates</h3>
        <form method="GET" action="{{ route('user.viewApplication', $application->id) }}">
            <input type="text" name="query" value="{{ $query }}" placeholder="Search certificates...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <table class="table mt-3" border="1">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Organization/Sponsor</th>
                    <th>Designation</th>
                    <th>Number of Days</th>
                    <th>Inclusive Date</th>
                    <th>OCR Output</th>
                   <!-- {{-- <th>Points</th> --}} -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($certificates as $certificate)
                    <tr>
                        <td>{{ $certificate->category }}</td>
                        <td>{{ $certificate->type }}</td>
                        <td>{{ $certificate->title }}</td>
                        <td>{{ $certificate->organization }}</td>
                        <td>{{ $certificate->designation }}</td>
                        <td>{{ $certificate->days }}</td>
                        <td>{{ $certificate->date }}</td>
                        <td>
                            <button type="button" class="btn btn-info ocr-result-btn" data-ocr="{{ $certificate->raw_text }}">
                                View OCR Output
                            </button>
                        </td>
                        <!-- <td>{{ $certificate->points }}</td> -->
                        <td>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning">Update</button>
                            </form>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">No certificates found for this ranking application.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



    </div>
</x-app-layout>
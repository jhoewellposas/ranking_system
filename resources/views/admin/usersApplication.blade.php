<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    
    <!-- Application Details -->
    <div class="container">
    <h2>Ranking Application #{{ $application->id }}</h2>

    <div class="card mt-4">
        <div class="card-body">
            <p><strong>Email</strong> {{ $application->user->email }}</p>
            <p><strong>Application Status:</strong> {{ ucfirst($application->status) }}</p>
            <p><strong>Comments:</strong> {{ $application->comments ?? 'No comments yet' }}</p>
            <p><strong>Created On:</strong> {{ $application->created_at->format('m/d/Y') }}</p>
        </div>
    </div>
    </div>

    <!-- User Details -->
    <div class="container">
    <div class="card mt-4">
        <div class="card-body">
            <p><strong>Academic Attainment:</strong> {{ $user->acad_attainment }}</p>
            <p><strong>Date Hired:</strong> {{ $user->date_hired }}</p>
            <p><strong>Office:</strong> {{ $user->office }}</p>
            <p><strong>Performance:</strong> {{ $user->performance }}</p>
            <p><strong>Experience:</strong> {{ $user->experience }}</p>
            <p><strong>Present Rank:</strong> {{ $user->present_rank }}</p>
            <p><strong>Next Rank:</strong> {{ $user->next_rank }}</p>
        </div>
    </div>

    <div class="user-table-info">
            <div class="teacher-info">
                <h1>USER'S RANKING APPLICATION</h1>
        <!-- Display User's Information -->
        <form action="{{ route('user.update', ['id' => $application->user->id]) }}" method="post">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" required>
            </div>
            <div>
                <label for="acad_attainment">Highest Academic Attainment</label>
                <input type="text" name="acad_attainment" id="acad_attainment" value="{{ $user->acad_attainment }}" required>
            </div>
            <div>
                <label for="date">Date Hired</label>
                <input type="date" name="date" id="date" value="{{ $user->date_hired }}">
            </div>
            <div>
                <label for="office">Office</label>
                <input type="text" name="office" id="office" value="{{ $user->office }}">
            </div>
            <div>
                <label for="performance">Performance</label>
                <input type="number" step="0.01" name="performance" id="performance" value="{{ $user->performance }}">
            </div>
            <div class="side-to-side">
                <label for="experience">Experience</label>
                <select name="experience" id="select-experience">
                    <option>Select Experience</option>
                    <option value="0.83" {{ $user->experience == '0.83' ? 'selected' : '' }}>1 Year</option>
                    <option value="1.666" {{ $user->experience == '1.666' ? 'selected' : '' }}>2 Years</option>
                    <option value="2.499" {{ $user->experience == '2.499' ? 'selected' : '' }}>3 Years</option>
                    <option value="3.332" {{ $user->experience == '3.332' ? 'selected' : '' }}>4 Years</option>
                    <option value="4.165" {{ $user->experience == '4.165' ? 'selected' : '' }}>5 Years</option>
                    <option value="4.998" {{ $user->experience == '4.998' ? 'selected' : '' }}>6 Years</option>
                    <option value="5.831" {{ $user->experience == '5.831' ? 'selected' : '' }}>7 Years</option>
                    <option value="6.664" {{ $user->experience == '6.664' ? 'selected' : '' }}>8 Years</option>
                    <option value="7.497" {{ $user->experience == '7.497' ? 'selected' : '' }}>9 Years</option>
                    <option value="8.33" {{ $user->experience == '8.33' ? 'selected' : '' }}>10 Years</option>
                    <option value="9.163" {{ $user->experience == '9.163' ? 'selected' : '' }}>11 Years</option>
                    <option value="10.00" {{ $user->experience == '10.00' ? 'selected' : '' }}>12 Years</option>
                </select> 
            </div>

            <div>
                <label for="present_rank">Present Rank</label>
                <select name="present_rank" id="present_rank">
                    <option value="Unranked" {{ $user->present_rank == 'Unranked' ? 'selected' : '' }}>Unranked</option>
                    <optgroup label="Basic Education Ranks">
                    <option value="Teacher 1" {{ $user->present_rank == 'Teacher 1' ? 'selected' : '' }}>Teacher 1</option>
                    <option value="Teacher 2" {{ $user->present_rank == 'Teacher 2' ? 'selected' : '' }}>Teacher 2</option>
                    <option value="Teacher 3" {{ $user->present_rank == 'Teacher 3' ? 'selected' : '' }}>Teacher 3</option>
                    <option value="Teacher 4" {{ $user->present_rank == 'Teacher 4' ? 'selected' : '' }}>Teacher 4</option>
                    <option value="Teacher 5" {{ $user->present_rank == 'Teacher 5' ? 'selected' : '' }}>Teacher 5</option>
                    <option value="Senior Teacher 1" {{ $user->present_rank == 'Senior Teacher 1' ? 'selected' : '' }}>Senior Teacher 1</option>
                    <option value="Senior Teacher 2" {{ $user->present_rank == 'Senior Teacher 2' ? 'selected' : '' }}>Senior Teacher 2</option>
                    <option value="Senior Teacher 3" {{ $user->present_rank == 'Senior Teacher 3' ? 'selected' : '' }}>Senior Teacher 3</option>
                    <option value="Senior Teacher 4" {{ $user->present_rank == 'Senior Teacher 4' ? 'selected' : '' }}>Senior Teacher 4</option>
                    <option value="Senior Teacher 5" {{ $user->present_rank == 'Senior Teacher 5' ? 'selected' : '' }}>Senior Teacher 5</option>
                    <option value="Master Teacher 1" {{ $user->present_rank == 'Master Teacher 1' ? 'selected' : '' }}>Master Teacher 1</option>
                    <option value="Master Teacher 2" {{ $user->present_rank == 'Master Teacher 2' ? 'selected' : '' }}>Master Teacher 2</option>
                    <option value="Master Teacher 3" {{ $user->present_rank == 'Master Teacher 3' ? 'selected' : '' }}>Master Teacher 3</option>
                    <option value="Master Teacher 4" {{ $user->present_rank == 'Master Teacher 4' ? 'selected' : '' }}>Master Teacher 4</option>
                    </optgroup>
                    <optgroup label="Higher Education Ranks">
                    <option value="Lecturer 1" {{ $user->present_rank == 'Lecturer 1' ? 'selected' : '' }}>Lecturer 1</option>
                    <option value="Lecturer 2" {{ $user->present_rank == 'Lecturer 2' ? 'selected' : '' }}>Lecturer 2</option>
                    <option value="Lecturer 3" {{ $user->present_rank == 'Lecturer 3' ? 'selected' : '' }}>Lecturer 3</option>
                    <option value="Assistant Instructor" {{ $user->present_rank == 'Assistant Instructor' ? 'selected' : '' }}>Assistant Instructor</option>
                    <option value="Instructor 1" {{ $user->present_rank == 'Instructor 1' ? 'selected' : '' }}>Instructor 1</option>
                    <option value="Instructor 2" {{ $user->present_rank == 'Instructor 2' ? 'selected' : '' }}>Instructor 2</option>
                    <option value="Instructor 3" {{ $user->present_rank == 'Instructor 3' ? 'selected' : '' }}>Instructor 3</option>
                    <option value="Assistant Professor 1" {{ $user->present_rank == 'Assistant Professor 1' ? 'selected' : '' }}>Assistant Professor 1</option>
                    <option value="Assistant Professor 2" {{ $user->present_rank == 'Assistant Professor 2' ? 'selected' : '' }}>Assistant Professor 2</option>
                    <option value="Associate Professor 1" {{ $user->present_rank == 'Associate Professor 1' ? 'selected' : '' }}>Associate Professor 1</option>
                    <option value="Associate Professor 2" {{ $user->present_rank == 'Associate Professor 2' ? 'selected' : '' }}>Associate Professor 2</option>
                    <option value="Full Professor 1" {{ $user->present_rank == 'Full Professor 1' ? 'selected' : '' }}>Full Professor 1</option>
                    <option value="Full Professor 2" {{ $user->present_rank == 'Full Professor 2' ? 'selected' : '' }}>Full Professor 2</option>
                    <option value="Full Professor 3" {{ $user->present_rank == 'Full Professor 3' ? 'selected' : '' }}>Full Professor 3</option>
                    </optgroup>
                </select>
            </div>

            <div class="requirement-table grid-item">
                <table class="table-rank" border="1">
                    <thead>
                        <tr>
                            <th>Next Rank</th>
                            <th>Requirements</th>
                        </tr>
                    </thead>
                <tr>
                <td>
                <select name="next_rank" id="next_rank">
                    <option value="">Select Rank</option>
                    <optgroup label="Basic Education Ranks">
                    <option value="Teacher 1" {{ $user->next_rank == 'Teacher 1' ? 'selected' : '' }}>Teacher 1</option>
                    <option value="Teacher 1 SQ" {{ $user->next_rank == 'Teacher 1 SQ' ? 'selected' : '' }}>Teacher 1 SQ</option>
                    <option value="Teacher 2" {{ $user->next_rank == 'Teacher 2' ? 'selected' : '' }}>Teacher 2</option>
                    <option value="Teacher 2 SQ" {{ $user->next_rank == 'Teacher 2 SQ' ? 'selected' : '' }}>Teacher 2 SQ</option>
                    <option value="Teacher 3" {{ $user->next_rank == 'Teacher 3' ? 'selected' : '' }}>Teacher 3</option>
                    <option value="Teacher 3 SQ" {{ $user->next_rank == 'Teacher 3 SQ' ? 'selected' : '' }}>Teacher 3 SQ</option>
                    <option value="Teacher 4" {{ $user->next_rank == 'Teacher 4' ? 'selected' : '' }}>Teacher 4</option>
                    <option value="Teacher 4 SQ" {{ $user->next_rank == 'Teacher 4 SQ' ? 'selected' : '' }}>Teacher 4 SQ</option>
                    <option value="Teacher 5" {{ $user->next_rank == 'Teacher 5' ? 'selected' : '' }}>Teacher 5</option>
                    <option value="Teacher 5 SQ" {{ $user->next_rank == 'Teacher 5 SQ' ? 'selected' : '' }}>Teacher 5 SQ</option>
                    <option value="Senior Teacher 1" {{ $user->next_rank == 'Senior Teacher 1' ? 'selected' : '' }}>Senior Teacher 1</option>
                    <option value="Senior Teacher 1 SQ" {{ $user->next_rank == 'Senior Teacher 1 SQ' ? 'selected' : '' }}>Senior Teacher SQ</option>
                    <option value="Senior Teacher 2" {{ $user->next_rank == 'Senior Teacher 2' ? 'selected' : '' }}>Senior Teacher 2</option>
                    <option value="Senior Teacher 2 SQ" {{ $user->next_rank == 'Senior Teacher 2 SQ' ? 'selected' : '' }}>Senior Teacher 2 SQ</option>
                    <option value="Senior Teacher 3" {{ $user->next_rank == 'Senior Teacher 3' ? 'selected' : '' }}>Senior Teacher 3</option>
                    <option value="Senior Teacher 3 SQ" {{ $user->next_rank == 'Senior Teacher 3 SQ' ? 'selected' : '' }}>Senior Teacher 3 SQ</option>
                    <option value="Senior Teacher 4" {{ $user->next_rank == 'Senior Teacher 4' ? 'selected' : '' }}>Senior Teacher 4</option>
                    <option value="Senior Teacher 4 SQ" {{ $user->next_rank == 'Senior Teacher 4 SQ' ? 'selected' : '' }}>Senior Teacher 4 SQ</option>
                    <option value="Senior Teacher 5" {{ $user->next_rank == 'Senior Teacher 5' ? 'selected' : '' }}>Senior Teacher 5</option>
                    <option value="Senior Teacher 5 SQ" {{ $user->next_rank == 'Senior Teacher 5 SQ' ? 'selected' : '' }}>Senior Teacher 5 SQ</option>
                    <option value="Master Teacher 1" {{ $user->next_rank == 'Master Teacher 1' ? 'selected' : '' }}>Master Teacher 1</option>
                    <option value="Master Teacher 1 SQ" {{ $user->next_rank == 'Master Teacher 1 SQ' ? 'selected' : '' }}>Master Teacher 1 SQ</option>
                    <option value="Master Teacher 2" {{ $user->next_rank == 'Master Teacher 2' ? 'selected' : '' }}>Master Teacher 2</option>
                    <option value="Master Teacher 2 SQ" {{ $user->next_rank == 'Master Teacher 2 SQ' ? 'selected' : '' }}>Master Teacher 2 SQ</option>
                    <option value="Master Teacher 3" {{ $user->next_rank == 'Master Teacher 3' ? 'selected' : '' }}>Master Teacher 3</option>
                    <option value="Master Teacher 3 SQ" {{ $user->next_rank == 'Master Teacher 3 SQ' ? 'selected' : '' }}>Master Teacher 3 SQ</option>
                    <option value="Master Teacher 4" {{ $user->next_rank == 'Master Teacher 4' ? 'selected' : '' }}>Master Teacher 4</option>
                    <option value="Master Teacher 4 SQ" {{ $user->next_rank == 'Master Teacher 4 SQ' ? 'selected' : '' }}>Master Teacher 4 SQ</option>
                    </optgroup>
                    <optgroup label="Higher Education Ranks">
                    <option value="Lecturer 1" {{ $user->next_rank == 'Lecturer 1' ? 'selected' : '' }}>Lecturer 1</option>
                    <option value="Lecturer 1 SQ" {{ $user->next_rank == 'Lecturer 1 SQ' ? 'selected' : '' }}>Lecturer 1 SQ</option>
                    <option value="Lecturer 2" {{ $user->next_rank == 'Lecturer 2' ? 'selected' : '' }}>Lecturer 2</option>
                    <option value="Lecturer 2 SQ" {{ $user->next_rank == 'Lecturer 2 SQ' ? 'selected' : '' }}>Lecturer 2 SQ</option>
                    <option value="Lecturer 3" {{ $user->next_rank == 'Lecturer 3' ? 'selected' : '' }}>Lecturer 3</option>
                    <option value="Lecturer 3 SQ" {{ $user->next_rank == 'Lecturer 3 SQ' ? 'selected' : '' }}>Lecturer 3 SQ</option>
                    <option value="Assistant Instructor" {{ $user->next_rank == 'Assistant Instructor' ? 'selected' : '' }}>Assistant Instructor</option>
                    <option value="Assistant Instructor SQ" {{ $user->next_rank == 'Assistant Instructor SQ' ? 'selected' : '' }}>Assistant Instructor SQ</option>
                    <option value="Instructor 1" {{ $user->next_rank == 'Instructor 1' ? 'selected' : '' }}>Instructor 1</option>
                    <option value="Instructor 1 SQ" {{ $user->next_rank == 'Instructor 1 SQ' ? 'selected' : '' }}>Instructor 1 SQ</option>
                    <option value="Instructor 2" {{ $user->next_rank == 'Instructor 2' ? 'selected' : '' }}>Instructor 2</option>
                    <option value="Instructor 2 SQ" {{ $user->next_rank == 'Instructor 2 SQ' ? 'selected' : '' }}>Instructor 2 SQ</option>
                    <option value="Instructor 3" {{ $user->next_rank == 'Instructor 3' ? 'selected' : '' }}>Instructor 3</option>
                    <option value="Instructor 3 SQ" {{ $user->next_rank == 'Instructor 3 SQ' ? 'selected' : '' }}>Instructor 3 SQ</option>
                    <option value="Assistant Professor 1" {{ $user->next_rank == 'Assistant Professor 1' ? 'selected' : '' }}>Assistant Professor 1</option>
                    <option value="Assistant Professor 1 SQ" {{ $user->next_rank == 'Assistant Professor 1 SQ' ? 'selected' : '' }}>Assistant Professor 1 SQ</option>
                    <option value="Assistant Professor 2" {{ $user->next_rank == 'Assistant Professor 2' ? 'selected' : '' }}>Assistant Professor 2</option>
                    <option value="Assistant Professor 2 SQ" {{ $user->next_rank == 'Assistant Professor 2 SQ' ? 'selected' : '' }}>Assistant Professor 2 SQ</option>
                    <option value="Associate Professor 1" {{ $user->next_rank == 'Associate Professor 1' ? 'selected' : '' }}>Associate Professor 1</option>
                    <option value="Associate Professor 1 SQ" {{ $user->next_rank == 'Associate Professor 1 SQ' ? 'selected' : '' }}>Associate Professor 1 SQ</option>
                    <option value="Associate Professor 2" {{ $user->next_rank == 'Associate Professor 2' ? 'selected' : '' }}>Associate Professor 2</option>
                    <option value="Associate Professor 2 SQ" {{ $user->next_rank == 'Associate Professor 2 SQ' ? 'selected' : '' }}>Associate Professor 2 SQ</option>
                    <option value="Full Professor 1" {{ $user->next_rank == 'Full Professor 1' ? 'selected' : '' }}>Full Professor 1</option>
                    <option value="Full Professor 1 SQ" {{ $user->next_rank == 'Full Professor 1 SQ' ? 'selected' : '' }}>Full Professor 1 SQ</option>
                    <option value="Full Professor 2" {{ $user->next_rank == 'Full Professor 2' ? 'selected' : '' }}>Full Professor 2</option>
                    <option value="Full Professor 2 SQ" {{ $user->next_rank == 'Full Professor 2 SQ' ? 'selected' : '' }}>Full Professor 2 SQ</option>
                    <option value="Full Professor 3" {{ $user->next_rank == 'Full Professor 3' ? 'selected' : '' }}>Full Professor 3</option>
                    <option value="Full Professor 3 SQ" {{ $user->next_rank == 'Full Professor 3 SQ' ? 'selected' : '' }}>Full Professor 3 SQ</option>
                    </optgroup>
                </select>
                </td>
                <td id="next-requirements">Select a rank</td>
                </tr>
                </table>
            </div>
            <button type="submit" class="update-button">Update User</button>
        </form>
        </div>
    </div>

    
    <!-- Certificates Table -->
    <div class="table-container">
        <h5>Uploaded Certificates</h5>
        <form method="GET" action="{{ route('admin.viewApplication', $application->id) }}">
            <input type="text" name="query" value="{{ $query }}" placeholder="Search certificates..." class="form-control mb-3">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <table class="table table-bordered mt-3" border="1">
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
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allCertificates as $certificate)
                    <tr>
                    <form action="{{ route('certificate.update', $certificate->id) }}" method="POST">
                    @csrf    
                    <td>
                        <select name="category" id="category" required>
                            <option value="">Select a Category</option>
                            <optgroup label="Productive Scholarship">
                            <option value="seminar" {{ $certificate->category == 'seminar' ? 'selected' : '' }}>Seminar</option>
                            <option value="honors_awards" {{ $certificate->category == 'honors_awards' ? 'selected' : '' }}>Honors and Awards</option>
                            <option value="membership" {{ $certificate->category == 'membership' ? 'selected' : '' }}>Membership</option>
                            <option value="scholarship_activities_a" {{ $certificate->category == 'scholarship_activities_a' ? 'selected' : '' }}>Scholarship Activities & Creative Efforts_A</option>
                            <option value="scholarship_activities_b" {{ $certificate->category == 'scholarship_activities_b' ? 'selected' : '' }}>Scholarship Activities & Creative Efforts_B</option>
                            </optgroup>
                            <optgroup label="Community Extension Service">
                            <option value="service_students" {{ $certificate->category == 'service_students' ? 'selected' : '' }}>Service to Students</option>
                            <option value="service_department" {{ $certificate->category == 'service_department' ? 'selected' : '' }}>Service to Department</option>
                            <option value="service_institution" {{ $certificate->category == 'service_institution' ? 'selected' : '' }}>Service to Institution</option>
                            <option value="participation_organizations" {{ $certificate->category == 'participation_organizations' ? 'selected' : '' }}>Active Participation in Different Organizations</option>
                            <option value="involvement_department" {{ $certificate->category == 'involvement_department' ? 'selected' : '' }}>Active Involvement in Department</option>
                            </optgroup>
                            </select>
                            </td>
                        <td><textarea name="type">{{ $certificate->type }}</textarea> </td>
                        <td><textarea name="title">{{ $certificate->title }}</textarea></td>
                        <td><textarea name="organization">{{ $certificate->organization }}</textarea></td>
                        <td><textarea name="designation">{{ $certificate->designation }}</textarea></td>
                        <td><input type="text" name="days" value="{{ $certificate->days }}" required></td>
                        <td><input type="text" name="date" value="{{ $certificate->date }}" required></td>
                        <td><button type="button" class="btn btn-info ocr-result-btn" data-ocr="{{ $certificate->raw_text }}">View OCR Output</button></td>
                        <td><input type="text" name="points" value="{{ $certificate->points }}" required></td>
                        <td>
                            <button type="submit-update">Update</button>
                        </form>
                        <form action="{{ route('certificate.delete', $certificate->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="delete-button">Delete</button>
                        </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No certificates uploaded for this application.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mb-4 view-summary-bottom">
                <a href="" class="btn btn-secondary-bottom">View Summary</a>
            </div>
            <form action="" method="POST" style="margin-top: 20px;">
                @csrf
                @method('DELETE')
                <button type="button" class="delete-all-button">Clear Data</button>
            </form>
    </div>

    <!-- Back Button -->
    <div class="mt-3">
        <a href="{{ route('admin.usersApplications') }}" class="btn btn-secondary">Back to Applications</a>
    </div>

    <!-- JavaScript -->
    {{-- <script src="{{ asset('javascript/autosizing.js') }}"></script> --}}
    <script src="{{ asset('javascript/popupwindow.js') }}"></script>
    <script>
    window.basicRequirements = @json($basicRequirements);
    window.higherRequirements = @json($higherRequirements);
    </script>
    <script src="{{ asset('javascript/rankRequirements.js') }}"></script>
    <script src="{{ asset('javascript/buttonConfirmations.js') }}"></script>
</x-app-layout>
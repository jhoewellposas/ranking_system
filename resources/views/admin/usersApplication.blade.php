<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    
    <!-- View Summary Button -->
    <div class="flex justify-end items-center mt-6 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('admin.viewSummary', ['id' => $application->id]) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">View Summary</a>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
            <!-- Application Details -->
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Ranking Application #{{ $application->id }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-grow">
                    <p class="text-gray-700"><strong>Email:</strong> {{ $application->user->email }}</p>
                    <p class="text-gray-700"><strong>Application Status:</strong> 
                        <span class="capitalize text-{{ $application->status === 'approved' ? 'green-600' : ($application->status === 'pending' ? 'yellow-600' : 'red-600') }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </p>
                    <p class="text-gray-700"><strong>Comments:</strong> {{ $application->comments ?? 'No comments yet' }}</p>
                    <p class="text-gray-700"><strong>Created On:</strong> {{ $application->created_at->format('m/d/Y') }}</p>
                </div>
            </div>            
    
            <!-- User Details -->
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">User Details</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-grow">
                    <p class="text-gray-700"><strong>Academic Attainment:</strong> {{ $user->acad_attainment }}</p>
                    <p class="text-gray-700"><strong>Date Hired:</strong> {{ $user->date_hired }}</p>
                    <p class="text-gray-700"><strong>Office:</strong> {{ $user->office }}</p>
                    <p class="text-gray-700"><strong>Performance:</strong> {{ $user->performance }}</p>
                    <p class="text-gray-700"><strong>Experience:</strong> {{ $user->experience }}</p>
                    <p class="text-gray-700"><strong>Present Rank:</strong> {{ $user->present_rank }}</p>
                    <p class="text-gray-700"><strong>Next Rank:</strong> {{ $user->next_rank }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- User Ranking Application -->
<div class="user-table-info container mx-auto p-4">
    <div class="teacher-info bg-white shadow-md rounded-lg p-6">
        <h1 class="text-xl font-bold mb-6 text-center">USER'S RANKING APPLICATION</h1>
        <!-- Display User's Information -->
        <form action="{{ route('user.update', ['id' => $application->user->id]) }}" method="post" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="text-sm font-semibold block mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" required class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <!-- Academic Attainment -->
            <div>
                <label for="acad_attainment" class="text-sm font-semibold block mb-1">Highest Academic Attainment</label>
                <input type="text" name="acad_attainment" id="acad_attainment" value="{{ $user->acad_attainment }}" required class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <!-- Date Hired -->
            <div>
                <label for="date" class="text-sm font-semibold block mb-1">Date Hired</label>
                <input type="date" name="date" id="date" value="{{ $user->date_hired }}" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <!-- Office -->
            <div>
                <label for="office" class="text-sm font-semibold block mb-1">Office</label>
                <input type="text" name="office" id="office" value="{{ $user->office }}" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <!-- Performance -->
            <div>
                <label for="performance" class="text-sm font-semibold block mb-1">Performance</label>
                <input type="number" step="0.01" name="performance" id="performance" value="{{ $user->performance }}" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <!-- Experience -->
            <div>
                <label for="experience" class="text-sm font-semibold block mb-1">Experience</label>
                <select name="experience" id="select-experience" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300">
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

            <!-- Present Rank -->
            <div>
                <label for="present_rank" class="text-sm font-semibold block mb-1">Present Rank</label>
                <select name="present_rank" id="present_rank" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300">
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

            <!-- Table Section -->
            <div class="sm:col-span-2 lg:col-span-3">
                <table class="table-auto border-collapse w-full bg-white shadow rounded-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border px-4 py-2">Next Rank</th>
                            <th class="border px-4 py-2">Requirements</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="border px-4 py-2">
                                <select name="next_rank" id="next_rank" class="border border-gray-300 rounded p-2 w-full focus:outline-none focus:ring focus:ring-blue-300 text-center">
                                    <option value="">Select Rank</option>
                                    <optgroup label="Basic Education Ranks">
                                        <!-- Repeated ranks from Present Rank -->
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
                                        <!-- Repeated ranks from Present Rank -->
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
                            <td class="border px-4 py-2" id="next-requirements">Select a rank</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Submit Button -->
            <div class="sm:col-span-2 lg:col-span-3 text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>



    
<div class="container mx-auto px-4 py-6">
    <!-- Certificates Table -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h5 class="text-lg font-bold mb-4">Uploaded Certificates</h5>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.viewApplication', $application->id) }}" class="flex items-center space-x-2 mb-4">
            <input type="text" name="query" value="{{ $query }}" placeholder="Search certificates..." class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        </form>

        <!-- Table -->
        <div class="overflow-auto">
            <table class="w-full border-collapse border border-gray-300 text-sm">
                <thead class="bg-gray-200 text-center">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Category</th>
                        <th class="border border-gray-300 px-4 py-2">Type</th>
                        <th class="border border-gray-300 px-4 py-2">Title</th>
                        <th class="border border-gray-300 px-4 py-2">Organization/Sponsor</th>
                        <th class="border border-gray-300 px-4 py-2">Designation</th>
                        <th class="border border-gray-300 px-2 py-2 w-24">Number of Days</th>
                        <th class="border border-gray-300 px-4 py-2">Inclusive Date</th>
                        {{-- <th class="border border-gray-300 px-2 py-2 w-24">OCR Output</th> --}}
                        <th class="border border-gray-300 px-2 py-2 w-20">Points</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allCertificates as $certificate)
                        <tr class="">
                            <form action="{{ route('certificate.update', $certificate->id) }}" method="POST" class="space-y-2">
                                @csrf    
                                <td class="border border-gray-300 px-4 py-2">
                                    <select name="category" id="category" required class="w-full rounded px-2 py-1 border-none focus:outline-none focus:ring focus:ring-blue-300 text-center" onchange="updateTooltip(this)">
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
                                <td class="border border-gray-300 px-4 py-2"><textarea name="type" class="w-full rounded p-1 border-none focus:outline-none focus:ring focus:ring-blue-300 resize-none">{{ $certificate->type }}</textarea></td>
                                <td class="border border-gray-300 px-4 py-2"><textarea name="title" class="w-full rounded p-1 border-none focus:outline-none focus:ring focus:ring-blue-300 resize-none">{{ $certificate->title }}</textarea></td>
                                <td class="border border-gray-300 px-4 py-2"><textarea name="organization" class="w-full rounded p-1 border-none focus:outline-none focus:ring focus:ring-blue-300 resize-none">{{ $certificate->organization }}</textarea></td>
                                <td class="border border-gray-300 px-4 py-2"><textarea name="designation" class="w-full rounded p-1 border-none focus:outline-none focus:ring focus:ring-blue-300 resize-none">{{ $certificate->designation }}</textarea></td>
                                <td class="border border-gray-300 px-2 py-2 w-24">
                                    <input type="text" name="days" value="{{ $certificate->days }}" required class="w-full rounded px-2 py-1 border-none focus:outline-none focus:ring focus:ring-blue-300 text-center">
                                </td>
                                <td class="border border-gray-300 px-4 py-2"><textarea name="designation" class="w-full rounded p-1 border-none focus:outline-none focus:ring focus:ring-blue-300 resize-none">{{ $certificate->date }}</textarea></td>
                                {{-- <td class="border border-gray-300 px-2 py-2 w-24">
                                    <button type="button" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:ring focus:ring-blue-300" data-ocr="{{ $certificate->raw_text }}">View OCR Output</button>
                                </td> --}}
                                <td class="border border-gray-300 px-2 py-2 w-20 ">
                                    <input type="text" name="points" value="{{ $certificate->points }}" required class="w-full rounded px-2 py-1 border-none focus:outline-none focus:ring focus:ring-blue-300 text-center">
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex flex-col space-y-2 items-center">
                                        <button type="submit" class="bg-green-500 text-white px-2 py-2 w-full rounded hover:bg-green-600 focus:ring focus:ring-green-300">Update</button>
                                    </form>
                                    <form action="{{ route('certificate.delete', $certificate->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-8 py-2.5 w-full rounded hover:bg-red-600 focus:ring focus:ring-red-300">Delete</button>
                                    </form>
                                    <button type="button" class="bg-blue-500 text-white px-2 py-2 w-full rounded hover:bg-blue-600 focus:ring focus:ring-blue-300 ocr-result-btn" data-ocr="{{ $certificate->raw_text }}">OCR Output</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-4 text-gray-500">No certificates uploaded for this application.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Buttons -->
            <div class="flex justify-between items-center mt-4">
                <a href="{{ route('admin.viewSummary', ['id' => $application->id]) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">View Summary</a>
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:ring focus:ring-red-300">Clear Data</button>
                </form>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6 flex justify-center">
            <a href="{{ route('admin.usersApplications') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to Applications</a>
        </div>
    </div>
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
    <script>
        function updateTooltip(selectElement) {
            selectElement.title = selectElement.options[selectElement.selectedIndex].text;
        }
    </script>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty Dashboard') }}
        </h2>
    </x-slot>

    <h1 class="sub-header">RANKING SUMMARY</h1>

    <!-- Display Selected Teacher's Information -->
    <div class="teacher-table-info">
        <div class="teacher-info">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Highest Academic Attainment:</strong> {{ $user->acad_attainment }}</p>
            <p><strong>Experience:</strong> {{ $user->experienceLabel }}</p>
            <p><strong>Office:</strong> {{ $user->office }}</p>
            <p><strong>Rank:</strong> {{ $user->next_rank }}</p>
        </div>

            <!-- Table for Ranking Criteria and Points -->
        <div class="table-content">
            <table class="R-C-table" border="1">
                <thead>
                    <tr>
                        <th>Ranking Criteria</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Performance</td>
                        <td>{{ $performance }}</td>
                    </tr>
                    <tr>
                        <td>Productive Scholarship</td>
                        <td>{{ $productiveScholarshipPoints }}</td>
                    </tr>
                    <tr>
                        <td>Experience</td>
                        <td>{{ $experience }}</td>
                    </tr>
                    <tr>
                        <td>Community Extension Services</td>
                        <td>{{ $communityExtensionPoints }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>{{ $totalPoints }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    {{-- Signature Form --}}
    <div class="signature-form">
        <h2 class="title">Signature Form</h2>
        <div class="grid-container">
            <!-- Row 1 -->
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
    
            <!-- Row 2 -->
            <div class="grid-item prepared-by-container">
                <span>Prepared by</span>
                <!-- Line will be added here by CSS -->
            </div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            
    
            <!-- Row 3 -->
            <div class="grid-item"></div>
            <div class="grid-item centered">Verified and Reviewed by Rank and Tenure Committee</div>
            <div class="grid-item"></div>
    
            <!-- Row 4 -->
            <div class="grid-item name-signature1">Name & Signature of Member</div>
            <div class="grid-item"></div>
            <div class="grid-item name-signature2">Name & Signature of Member</div>
             
            <!-- Row 5 -->
            <div class="grid-item"></div>
            <div class="grid-item name-signature3">Name & Signature of Chair</div>
            <div class="grid-item"></div>
    
            <!-- Row 6 -->
            <div class="grid-item approved-container">
                <span>President</span>
                <!-- Line will be added here by CSS -->
            </div>
            <div class="grid-item"></div>
            <div class="grid-item approved-date-container">
                <span>Date</span>
                <!-- Line will be added here by CSS -->
            </div>

            <!-- Row 7 -->
            {{-- <div class="grid-item president">President</div>
            <div class="grid-item"></div>
            <div class="grid-item"></div> --}}
        </div>
    </div>
    

</x-app-layout>
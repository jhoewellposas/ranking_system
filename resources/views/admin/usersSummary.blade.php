<x-app-layout>
    <link rel="stylesheet" type="text/css" href="{{ asset('styling/summary.css')}}">
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot> --}}
    
    <style>
        @media print {
            body {
                margin: 0;
                font-size: 14px;
                color: #000;
            }
            .teacher-info {
                display: block;
            }
            .print:shadow-none {
                box-shadow: none !important;
            }
            .print:border {
                border: 1px solid #000 !important;
            }
            .no-print {
                display: none;
            }
        }
    </style>

    {{-- Logo Header Container --}}
    <div class="fsuu-logo-container">
        <img src="{{ asset('FSUU_Logo/fsuu2_1.png') }}" alt="University Logo" class="logo">
        <div class="logo-title-container">
            <h1 class="main-title">FSUU</h1>
            <h2 class="subtitle">Father Saturnino Urios University</h2>
        </div>
    </div>

    &nbsp;

    <h1 class="sub-header text-3xl font-bold text-center py-4">RANKING SUMMARY</h1>

<!-- Display Selected Teacher's Information -->
<div class="teacher-table-info mt-4 px-4 md:px-10 grid grid-cols-2 gap-6">
    <!-- Teacher Information Block -->
    <div class="teacher-info bg-white p-4 grid grid-cols-2 gap-4">
        <p><strong>Name:</strong> <span>{{ $user->name }}</span></p>
        <p><strong>Highest Academic Attainment:</strong> <span>{{ $user->acad_attainment }}</span></p>
        <p><strong>Experience:</strong> <span>{{ $user->experienceLabel }}</span></p>
        <p><strong>Office:</strong> <span>{{ $user->office }}</span></p>
        <!-- This will make the 'Rank' span across both columns -->
        <p class="col-span-2"><strong>Rank:</strong> <span>{{ $user->next_rank }}</span></p>
    </div>

    

    <!-- Table for Ranking Criteria and Points -->
    <div class="table-content bg-white p-4 col-span-2 md:col-span-1">
        <table class="R-C-table w-full text-left border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border-b border-gray-300">Ranking Criteria</th>
                    <th class="p-2 border-b border-gray-300">Points</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="p-2 border-b border-gray-300">Performance</td>
                    <td class="p-2 border-b border-gray-300">{{ $performance }}</td>
                </tr>
                <tr>
                    <td class="p-2 border-b border-gray-300">Productive Scholarship</td>
                    <td class="p-2 border-b border-gray-300">{{ $productiveScholarshipPoints }}</td>
                </tr>
                <tr>
                    <td class="p-2 border-b border-gray-300">Experience</td>
                    <td class="p-2 border-b border-gray-300">{{ $experience }}</td>
                </tr>
                <tr>
                    <td class="p-2 border-b border-gray-300">Community Extension Services</td>
                    <td class="p-2 border-b border-gray-300">{{ $communityExtensionPoints }}</td>
                </tr>
                <tr>
                    <td class="p-2 font-bold">Total</td>
                    <td class="p-2 font-bold">{{ $totalPoints }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


{{-- Signature Form --}}
<div class="signature-form">
    {{-- <h2 class="title">Signature Form</h2> --}}
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
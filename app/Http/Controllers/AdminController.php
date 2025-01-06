<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\RankingApplication;
use App\Models\RankDistribution;
use App\Models\Certificate;

class AdminController extends Controller
{
    public function dashboard()
    {
        $notifications = auth()->user()->notifications()->latest()->get();

        return view('admin.dashboard', compact('notifications'));
    }

    //Show all ranking applications for all users.
    public function showAllUsersApplications(Request $request)
    {
        // Retrieve the search query
        $query = $request->input('query');
        
        // Retrieve all ranking applications ordered by the latest submission
        $applicationsQuery = RankingApplication::with('user')->latest();

        if ($query) {
            $applicationsQuery->whereHas('user', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%");
            });
        }
    
        $applications = $applicationsQuery->get();

        // Return the view with the applications
        return view('admin.usersApplications', compact('applications', 'query'));
    }

    //View details of a specific ranking application of a specific user. 
    /*
    public function viewApplication($id)
    {
        // Find the ranking application with associated user and certificates
        $application = RankingApplication::with(['user', 'certificates'])->findOrFail($id);

        // Return the view with the application details
        return view('admin.usersApplication', compact('application'));
    }
    */


    //View details of a specific ranking application of a user, including user details and certificates. 
    public function viewApplication($id, Request $request)
    {
        // Find the ranking application with associated user and certificates
        $application = RankingApplication::with(['user', 'certificates'])->findOrFail($id);

        // Search query for filtering certificates
        $query = $request->input('query');
        $certificateQuery = $application->certificates();

        // Filter certificates by search query if provided
        if ($query) {
            $certificateQuery->where(function ($q) use ($query) {
                $q->where('category', 'like', "%{$query}%")
                ->orWhere('type', 'like', "%{$query}%")
                ->orWhere('title', 'like', "%{$query}%")
                ->orWhere('organization', 'like', "%{$query}%")
                ->orWhere('designation', 'like', "%{$query}%")
                ->orWhere('date', 'like', "%{$query}%")
                ->orWhere('raw_text', 'like', "%{$query}%")
                ->orWhere('points', 'like', "%{$query}%");
            });
        }

        // Get filtered certificates
        $allCertificates = $certificateQuery->get();

        // Requirements for ranks
        $basicRequirements = $this->getBasicRequirements();
        $higherRequirements = $this->getHigherRequirements();

        // Return view with application, user, and certificate details
        return view('admin.usersApplication', [
            'application' => $application,
            'allCertificates' => $allCertificates,
            'user' => $application->user,
            'query' => $query,
            'basicRequirements' => $basicRequirements,
            'higherRequirements' => $higherRequirements,
        ]);
    }

    //Get basic education rank requirements.
    private function getBasicRequirements()
    {
        return [
            'Teacher 1' => [
                'Must be a BS degree holder, LET passer (for degree requiring license)',
                'Must have a very good/very satisfactory efficiency rating',
                'Must have passed the three years probationary period',
            ], // Keep requirements here
            'Teacher 2' => [
                'Must have earned 25% of MA academic requirements on his/her specialization',
                'Must have a very good/very satisfactory efficiency rating',
                'At least three (3) years of teaching experience',
                'Must have met all the requirements of Teacher 1',
            ],
            'Teacher 3' => [
                'Must have earned 75% of MA academic requirements on his/her specialization',
                'Must have a very good/very satisfactory efficiency rating',
                'At least three (3) years teaching experience',
                'Must have met all the requirements of Teacher 2',
            ],
            'Teacher 4' => [
                    'Must be a Masters Degree holder',
                    'Must have a very good/very satisfactory efficiency rating',
                    'At least three (3) years teaching experience',
                    'Must have met all the requirements of Teacher 3'
            ],
            'Teacher 5' => [
                    'Must have a very good/very satisfactory efficiency rating',
                    'Must have atleast 4 years teaching experience',
                    'Must have earned atleast one (1) point of productive scholarship',
                    'Must have met all the requirements of Teacher 4'
            ],
            'Senior Teacher 1' => [
                    'Must have a very good/very satisfactory efficiency rating',
                    'Must have atleast 5 years teaching experience',
                    'Must have earned atleast two (2) points of productive scholarship',
                    'Must have met all the requirements of Teacher 5'
                ],
            'Senior Teacher 2' => [
                    'Must have a very good/very satisfactory efficiency rating',
                    'Must have atleast 6 years teaching experience',
                    'Must have earned atleast three (3) points of productive scholarship',
                    'Must have met all the requirements of Senior Teacher 1'
                ],
            'Senior Teacher 3' => [
                    'Must have taken 25% of Doctoral academic requirements in his/her specialization',
                    'Must have a very good/very satisfactory efficiency rating',
                    'Must have atleast 7 years teaching experience',
                    'Must have conducted at least one research approved/recognized by the administration',
                    'Must have met all the requirements of Senior Teacher 2'
            ],
            'Senior Teacher 4' => [
                    'Must have taken 50% of Doctoral academic requirements in his/her specialization',
                    'Must have a very good/very satisfactory efficiency rating',
                    'Must have atleast 8 years teaching experience',
                    'Must have shown consistent interest in conducting & publishing research or articles relevant to his/her field of specialization',
                    'Must have met all the requirements of Senior Teacher 3'
            ],
            'Senior Teacher 5' => [
                    'Must have completed the academic requirements for Doctoral Degree',
                    'Must have a very good/very satisfactory efficiency rating',
                    'Must have atleast 9 years teaching experience',
                    'Must exhibit continued interest in the conduct of researches, innovative and creative efforts',
                    'Must have met all the requirements of Senior Teacher 4'
            ],
            'Master Teacher 1' => [
                    'Must be a Doctoral Degree holder',
                    'Must have a very good/very satisfactory efficiency rating',
                    'Must have atleast 10 years teaching experience',
                    'Must have conducted atleast one (1) research work outside dissertation work and other articles consistent to education or field of specialization in a refereed journal',
                    'Must have met all the requirements of Senior Teacher 5'
            ],
            'Master Teacher 2' => [
                    'Must have a very good/very satisfactory efficiency rating',
                    'Must have atleast 11 years teaching experience',
                    'Must have shown consistent interest in the conduct of researches, and other articles consistent to education or field of specialization in a refereed journal',
                    'Must have met all the requirements of Master Teacher 1'
            ],
            'Master Teacher 3' => [
                    'Must have a very good/very satisfactory efficiency rating',
                    'Must have atleast 12 years teaching experience',
                    'Must have earned general recognition among scholars and educators',
                    'Must have published books, articles in recognized journal or similar scholarships',
                    'Must have participated in the activities of the learned societies',
                    'Must have met all the requirements of Master Teacher 2'
            ],
            'Master Teacher 4' => [
                    'Must have a very good/very satisfactory efficiency rating',
                    'Must have atleast 13 years teaching experience',
                    'Must have met all the requirements of Master Teacher 3'
            ],
            // other ranks...
        ];
    }

    //Get higher education rank requirements.
    private function getHigherRequirements()
    {
        return [
            'Lecturer 1' => [
                    'BS Degree Holder',
                    'Must have a Very Good/Very Satisfactory efficiency rating',
                    'Must have passed three years of probationary period'
            ],
            'Lecturer 2' => [
                    'Must have earned 25% MA units',
                    'Must have a Very Good/Very Satisfactory efficiency rating',
                    'Must have passed three years of probationary period'
            ],
            'Lecturer 3' => [
                    'Must have earned 75% MA units',
                    'Must have a Very Good/Very Satisfactory efficiency rating',
                    'Must have passed three years of probationary period'
            ],
            'Assistant Instructor' => [
                    'Must be a Masters Degree holder',
                    'Must have a Very Good/Very Satisfactory efficiency rating',
                    'Must have passed three years of probationary period'
            ],
            'Instructor 1' => [
                    'Must have a Very Good/ Very Satisfactory efficiency rating',
                    'Must have at least 4 years teaching experience',
                    'Must have earned at least one (1) point of productive scholarship',
                    'Must have met all the requirements of Assistant Instructor'
            ],
            'Instructor 2' => [
                    'Must have a Very Good/ Very Satisfactory efficiency rating',
                    'Must have at least 6 years teaching experience',
                    'Must have earned at least two (2) point of productive scholarship',
                    'Must have met all the requirements of Instructor 1'
            ],
            'Instructor 3' => [
                    'Must have a Very Good/ Very Satisfactory efficiency rating',
                    'Must have at least 6 years teaching experience',
                    'Must have earned at least three (3) point of productive scholarship',
                    'Must have met all the requirements of Instructor 2'
            ],
            'Assistant Professor 1' => [
                    'Must have taken 25% of Doctoral academic requirements in his or her specialization',
                    'Must have a Very Good/ Very Satisfactory efficiency rating',
                    'Must have at least 7 years teaching experience',
                    'Must have conducted at least one research',
                    'Must have met all the requirements of Instructor 3'
            ],
            'Assistant Professor 2' => [
                    'Must have taken 50% of Doctoral academic requirements in his or her specialization',
                    'Must have a Very Good/ Very Satisfactory efficiency rating',
                    'Must have at least 8 years teaching experience',
                    'Must have shown consistent interest in conducting & publishing research or articles relevant to his/her field of specialization',
                    'Must have met all the requirements of Assistant Professor 1'
            ],
            'Associate Professor 1' => [
                    'Must have completed the acedemic requirements for Doctoral Degree',
                    'Must have a Very Good/ Very Satisfactory efficiency rating',
                    'Must have at least 9 years teaching experience',
                    'Must exhibit continued interest in the conduct of researches, innovative and creative efforts',
                    'Must have met all the requirements of Assistant Professor 2'
            ],
            'Associate Professor 2' => [
                    'Must be a Doctoral Degree holder',
                    'Must have a Very Good/ Very Satisfactory efficiency rating',
                    'Must have at least 10 years teaching experience',
                    'Must have conducted atleast one (1) research work outside dissertation work and other articles consistent to education or field of specialization in a refereed journal',
                    'Must have met all the requirements of Associate Professor 1'
            ],
            'Full Professor 1' => [
                    'Must have a Very Good/ Very Satisfactory efficiency rating',
                    'Must have at least 12 years teaching experience',
                    'Must have shown consistent interest in the conduct of researches and other articles consistent to education or field of specialization in a refereed journal',
                    'Must have met all the requirements of Associate Professor 2'
            ],
            'Full Professor 2' => [
                    'Must have a Very Good/ Very Satisfactory efficiency rating',
                    'Must have at least 12 years teaching experience',
                    'Must have earned general recognition among scholars and educators',
                    'Must have published books, articles, researches in recognized journal or similar scholarships',
                    'Must have participated in the activities of the learned societies',
                    'Must have met all the requirements of Full Professor 1'
            ],
            'Full Professor 3' => [
                    'Must have a Very Good/ Very Satisfactory efficiency rating',
                    'Must have atleast 12 years of teaching experience',
                    'Must have published books, articles, researches in international journals',
                    'Must have met all the requirements of Full Professor 2'
            ],
            // other ranks...
        ];
    }

    /*
    //Update user details of a user of a specific ranking application
    public function updateUser(Request $request, $id)
    {
        // Find the user
        $user = User::findOrFail($id);

        // Update user details
        $user->update($request->only('name', 'acad_attainment', 'performance', 'date_hired', 'office', 'experience', 'present_rank', 'next_rank'));

        // Get the ranking application ID from the request
        $rankingApplicationId = $request->input('ranking_application_id');

        // Redirect back to the specific ranking application
        return redirect()->route('admin.viewApplication', ['id' => $rankingApplicationId])
            ->with('success', 'User updated successfully.');
    }
    */

    public function updateUser(Request $request, $id)
    {
    // Validate inputs
    $request->validate([
        'name' => 'required|string|max:255',
        'acad_attainment' => 'nullable|string|max:255',
        'performance' => 'nullable|numeric',
        'date_hired' => 'nullable|date',
        'office' => 'nullable|string|max:255',
        'experience' => 'nullable|numeric',
        'present_rank' => 'nullable|string|max:255',
        'next_rank' => 'nullable|string|max:255',
        'status' => 'required|string|in:pending,approved',
        'comments' => 'nullable|string|max:500',
    ]);

    // Update user details
    $user = User::findOrFail($id);
    $user->update($request->only('name', 'acad_attainment', 'performance', 'date_hired', 'office', 'experience', 'present_rank', 'next_rank'));

    // Update ranking application status and comments
    $rankingApplication = RankingApplication::findOrFail($request->input('ranking_application_id'));
    $rankingApplication->update([
        'status' => $request->input('status'),
        'comments' => $request->input('comments'),
    ]);

    // Redirect back to the specific ranking application
    return redirect()->route('admin.viewApplication', ['id' => $rankingApplication->id])
        ->with('success', 'User and application details updated successfully.');
    }


    //Update certificate data of a specific ranking application
    public function updateCertificate(Request $request, $id)
    {
        // Find the certificate
        $certificate = Certificate::findOrFail($id);

        // Update certificate details
        $certificate->update($request->only('category', 'type', 'name', 'title', 'organization', 'designation', 'days', 'date', 'points'));

        // Redirect back to the specific ranking application
        return redirect()->route('admin.viewApplication', ['id' => $certificate->ranking_application_id])
            ->with('success', 'Certificate updated successfully.');
    }

    //Delete certificate image and certificate data of a specific ranking application
    public function deleteCertificate($id)
    {
        // Find the certificate
        $certificate = Certificate::findOrFail($id);

        // Get the associated ranking application ID before deletion
        $rankingApplicationId = $certificate->ranking_application_id;

        // Delete the certificate
        $certificate->delete();

        // Delete the image
        Storage::disk('public')->delete($certificate->image_path);

        // Redirect back to the specific ranking application
        return redirect()->route('admin.viewApplication', ['id' => $rankingApplicationId])
            ->with('success', 'Certificate deleted successfully.');
    }

/*
//View ranking summary of a specific ranking application of a user
public function viewSummary($teacherId)
    {
    // Find the ranking application with associated user, user details and certificates,
    $teacher = Teacher::with('certificates')->findOrFail($teacherId);
    $rank = $teacher->next_rank ?? 'Unknown';

    // Retrieve the distribution for the rank
    $distributions = RankDistribution::where('rank', $rank)->first([
        'productiveGroupAPercentage',
        'productiveGroupBPercentage',
        'communityGroupAPercentage',
        'communityGroupBPercentage',
    ]) ?? [
        'productiveGroupAPercentage' => 0.8,
        'productiveGroupBPercentage' => 0.2,
        'communityGroupAPercentage' => 0.7,
        'communityGroupBPercentage' => 0.3,
    ];

    // Calculate points for Productive Scholarship categories
    $productiveGroupAPoints = $teacher->certificates
        ->whereIn('category', ['seminar', 'membership', 'scholarship_activities_a'])
        ->sum('points');

    $productiveGroupBPoints = $teacher->certificates
        ->whereIn('category', ['honors_awards', 'scholarship_activities_b'])
        ->sum('points');

    // Scale Productive Scholarship Points to a maximum of 15.0
    $productiveMaxPoints = 15.0;
    $scaledProductiveGroupAPoints = $productiveGroupAPoints * $distributions['productiveGroupAPercentage'];
    $scaledProductiveGroupBPoints = $productiveGroupBPoints * $distributions['productiveGroupBPercentage'];
    $productiveScholarshipPoints = min(
        $productiveMaxPoints,
        $scaledProductiveGroupAPoints + $scaledProductiveGroupBPoints
    );

    // Calculate points for Community Extension Services categories of a User
    $communityGroupAPoints = $teacher->certificates
        ->whereIn('category', ['service_students', 'service_department', 'service_institution'])
        ->sum('points');

    $communityGroupBPoints = $teacher->certificates
        ->whereIn('category', ['participation_organizations', 'involvement_department'])
        ->sum('points');

    // Scale Community Extension Points to a maximum of 10.0
    $communityMaxPoints = 10.0;
    $scaledCommunityGroupAPoints = $communityGroupAPoints * $distributions['communityGroupAPercentage'];
    $scaledCommunityGroupBPoints = $communityGroupBPoints * $distributions['communityGroupBPercentage'];
    $communityExtensionPoints = min(
        $communityMaxPoints,
        $scaledCommunityGroupAPoints + $scaledCommunityGroupBPoints
    );

    // Use User's individual performance and experience
    $performance = $teacher->performance;
    $experience = $teacher->experience;

    // Calculate the total points
    $totalPoints = $performance + $productiveScholarshipPoints + $experience + $communityExtensionPoints;

    // Map experience to descriptive labels
    $experienceLabels = [
        '0.83' => '1 Year',
        '1.666' => '2 Years',
        '2.499' => '3 Years',
        '3.332' => '4 Years',
        '4.165' => '5 Years',
        '4.998' => '6 Years',
        '5.831' => '7 Years',
        '6.664' => '8 Years',
        '7.497' => '9 Years',
        '8.33' => '10 Years',
        '9.163' => '11 Years',
        '10.00' => '12 Years',

        // Add more mappings as needed
    ];
    $teacher->experienceLabel = $experienceLabels[(string)$teacher->experience] ?? 'Unknown';

    // Pass data to the admin\usersSummary.blade.php or admin.viewSummary
    return view('summary', [
        'teacher' => $teacher,
        'performance' => $performance,
        'productiveScholarshipPoints' => $productiveScholarshipPoints,
        'productiveGroupAPoints' => $productiveGroupAPoints,
        'productiveGroupBPoints' => $productiveGroupBPoints,
        'scaledProductiveGroupAPoints' => $scaledProductiveGroupAPoints,
        'scaledProductiveGroupBPoints' => $scaledProductiveGroupBPoints,
        'experience' => $experience,
        'communityExtensionPoints' => $communityExtensionPoints,
        'communityGroupAPoints' => $communityGroupAPoints,
        'communityGroupBPoints' => $communityGroupBPoints,
        'scaledCommunityGroupAPoints' => $scaledCommunityGroupAPoints,
        'scaledCommunityGroupBPoints' => $scaledCommunityGroupBPoints,
        'totalPoints' => $totalPoints,
    ]);
    }
    */

    public function viewSummary($id)
    {
        // Find the ranking application with associated user and certificates
        $application = RankingApplication::with(['user', 'certificates'])->findOrFail($id);
        $user = $application->user;
        $rank = $user->next_rank ?? 'Unknown';

        // Retrieve the distribution for the rank
        $distributions = RankDistribution::where('rank', $rank)->first([
            'productiveGroupAPercentage',
            'productiveGroupBPercentage',
            'communityGroupAPercentage',
            'communityGroupBPercentage',
        ]) ?? [
            'productiveGroupAPercentage' => 0.8,
            'productiveGroupBPercentage' => 0.2,
            'communityGroupAPercentage' => 0.7,
            'communityGroupBPercentage' => 0.3,
        ];

        // Calculate points for Productive Scholarship categories
        $productiveGroupAPoints = $application->certificates
            ->whereIn('category', ['seminar', 'membership', 'scholarship_activities_a'])
            ->sum('points');

        $productiveGroupBPoints = $application->certificates
            ->whereIn('category', ['honors_awards', 'scholarship_activities_b'])
            ->sum('points');

        // Scale Productive Scholarship Points to a maximum of 15.0
        $productiveMaxPoints = 15.0;
        $scaledProductiveGroupAPoints = $productiveGroupAPoints * $distributions['productiveGroupAPercentage'];
        $scaledProductiveGroupBPoints = $productiveGroupBPoints * $distributions['productiveGroupBPercentage'];
        $productiveScholarshipPoints = min(
            $productiveMaxPoints,
            $scaledProductiveGroupAPoints + $scaledProductiveGroupBPoints
        );

        // Calculate points for Community Extension Services categories
        $communityGroupAPoints = $application->certificates
            ->whereIn('category', ['service_students', 'service_department', 'service_institution'])
            ->sum('points');

        $communityGroupBPoints = $application->certificates
            ->whereIn('category', ['participation_organizations', 'involvement_department'])
            ->sum('points');

        // Scale Community Extension Points to a maximum of 10.0
        $communityMaxPoints = 10.0;
        $scaledCommunityGroupAPoints = $communityGroupAPoints * $distributions['communityGroupAPercentage'];
        $scaledCommunityGroupBPoints = $communityGroupBPoints * $distributions['communityGroupBPercentage'];
        $communityExtensionPoints = min(
            $communityMaxPoints,
            $scaledCommunityGroupAPoints + $scaledCommunityGroupBPoints
        );

        // Use user's individual performance and experience
        $performance = $user->performance;
        $experience = $user->experience;

        // Calculate the total points
        $totalPoints = $performance + $productiveScholarshipPoints + $experience + $communityExtensionPoints;

        // Map experience to descriptive labels
        $experienceLabels = [
            '0.83' => '1 Year',
            '1.666' => '2 Years',
            '2.499' => '3 Years',
            '3.332' => '4 Years',
            '4.165' => '5 Years',
            '4.998' => '6 Years',
            '5.831' => '7 Years',
            '6.664' => '8 Years',
            '7.497' => '9 Years',
            '8.33' => '10 Years',
            '9.163' => '11 Years',
            '10.00' => '12 Years',
        ];
        $user->experienceLabel = $experienceLabels[(string)$user->experience] ?? 'Unknown';

        // Pass data to the admin\usersSummary.blade.php
        return view('admin.usersSummary', [
            'user' => $user,
            'application' => $application,
            'performance' => $performance,
            'productiveScholarshipPoints' => $productiveScholarshipPoints,
            'productiveGroupAPoints' => $productiveGroupAPoints,
            'productiveGroupBPoints' => $productiveGroupBPoints,
            'scaledProductiveGroupAPoints' => $scaledProductiveGroupAPoints,
            'scaledProductiveGroupBPoints' => $scaledProductiveGroupBPoints,
            'experience' => $experience,
            'communityExtensionPoints' => $communityExtensionPoints,
            'communityGroupAPoints' => $communityGroupAPoints,
            'communityGroupBPoints' => $communityGroupBPoints,
            'scaledCommunityGroupAPoints' => $scaledCommunityGroupAPoints,
            'scaledCommunityGroupBPoints' => $scaledCommunityGroupBPoints,
            'totalPoints' => $totalPoints,
        ]);
    }

    public function markNotificationAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back();
    }
}
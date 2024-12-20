<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RankingApplication;
use App\Models\Certificate;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show all ranking applications for all users.
     */
public function showAllUsersApplications()
{
    // Retrieve all ranking applications ordered by the latest submission
    $applications = RankingApplication::with('user')->latest()->get();

    // Return the view with the applications
    return view('admin.usersApplications', compact('applications'));
}

    //View details of a specific ranking application.
     
    /*
    public function viewApplication($id)
    {
        $application = auth()->user()->rankingApplications()->findOrFail($id);

        return view('user.userApplication', compact('application'));
    }
    */

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
    //Update the user details of a user in a specific ranking application
    public function updateUser(Request $request, $id)
    {
    $teacher = Teacher::findOrFail($id);
    $teacher->update($request->only('name', 'acad_attainment', 'performance', 'date', 'office', 'experience', 'present_rank', 'next_rank'));

    //Redirect back to the specific ranking application (usersApplication/admin.usersApplication) of a user
    return redirect()->route('profile', ['teacher_id' => $teacher->id])
                     ->with('success', 'Teacher updated successfully.');
    }

    //Update a certificate of the specific ranking application of a user
    public function updateCertificate(Request $request, $id)
    {
    $certificate = Certificate::findOrFail($id);
    $certificate->update($request->only('category', 'type', 'name', 'title', 'organization', 'designation', 'days', 'date', 'points'));

    //Redirect back to the specific ranking application (usersApplication/admin.usersApplication) of a user
    return redirect()->route('profile', ['teacher_id' => $certificate->teacher_id])
                     ->with('success', 'Certificate updated successfully.');
    }

    //Delete a certificate of the specific ranking application of a user
    public function deleteCertificate($id)
    {
    $certificate = Certificate::findOrFail($id);
    $teacherId = $certificate->teacher_id;
    $certificate->delete();

    //Redirect back to the specific ranking application (usersApplication/admin.usersApplication) of a user
    return redirect()->route('profile', ['teacher_id' => $teacherId])
                     ->with('success', 'Certificate deleted successfully.');
    }
    */

    public function updateUser(Request $request, $id)
{
    // Find the user
    $user = User::findOrFail($id);

    // Update user details
    $user->update($request->only('name', 'acad_attainment', 'performance', 'date_hired', 'office', 'experience', 'present_rank', 'next_rank'));

    // Redirect back to the specific ranking application
    $rankingApplication = RankingApplication::where('user_id', $id)->firstOrFail();

    return redirect()->route('admin.viewApplication', ['id' => $rankingApplication->id])
        ->with('success', 'User updated successfully.');
}

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

public function deleteCertificate($id)
{
    // Find the certificate
    $certificate = Certificate::findOrFail($id);

    // Get the associated ranking application ID before deletion
    $rankingApplicationId = $certificate->ranking_application_id;

    // Delete the certificate
    $certificate->delete();

    // Redirect back to the specific ranking application
    return redirect()->route('admin.viewApplication', ['id' => $rankingApplicationId])
        ->with('success', 'Certificate deleted successfully.');
}

}

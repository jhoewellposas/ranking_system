<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\RankingApplication;
use App\Models\Certificate;
use thiagoalessio\TesseractOCR\TesseractOCR;
use OpenAI;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    /**
     * Create a new ranking application for the authenticated user.
     */
    public function createUserApplication()
    {
        $user = auth()->user();

        // Create the new application
        $application = RankingApplication::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_points' => 0,
        ]);

        return redirect()->route('user.userApplications')->with('success', 'New ranking application created.');
    }

    /**
     * Show all ranking applications for the authenticated user.
     */
    public function showAllUserApplications()
    {
        $applications = auth()->user()->rankingApplications()->latest()->get();

        return view('user.userApplications', compact('applications'));
    }

    /**
     * View details of a specific ranking application.
     */
    /*
    public function viewApplication($id)
    {
        $application = auth()->user()->rankingApplications()->findOrFail($id);

        return view('user.userApplication', compact('application'));
    }
    */
    public function viewApplication($id, Request $request)
{
    $application = auth()->user()->rankingApplications()->findOrFail($id);

    // Fetch certificates related to this ranking application
    $query = $request->input('query');
    $certificateQuery = Certificate::where('ranking_application_id', $id);

    // Apply search filter if a query is provided
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

    // Get all certificates related to this ranking application
    $certificates = $certificateQuery->get();

    // Return the view with application and certificate data
    return view('user.userApplication', compact('application', 'certificates', 'query'));
}


    /**
     * Uploads certificates and extracts certificate data.
     */
    /*
    public function extractCertificateData(Request $request)
    {
        // Step 1: Validate and save the uploaded files
        $request->validate([
            'certificates.*' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validate multiple files
            'teacher_id' => 'required|exists:teachers,id', // Validate teacher_id
        ]);
    
        $certificates = $request->file('certificates');
        $teacherId = $request->input('teacher_id');
    
        foreach ($certificates as $certificate) {
            $path = $certificate->store('certificates', 'public');
            $processedImagePath = storage_path("app/public/{$path}");
    
            // Step 2: Perform OCR on the processed image
            $tesseract = new TesseractOCR($processedImagePath);
            $text = $tesseract->run();
    
            if (empty($text)) {
                return back()->with('error', "Failed to extract text from certificate: {$certificate->getClientOriginalName()}");
            }
    
            // Step 3: Use OpenAI API to extract details
            $openaiApiKey = env('OPENAI_API_KEY'); // Add your API key to the .env file
            $openai = OpenAI::client($openaiApiKey);
    
            $response = $openai->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a helpful assistant that extracts structured data from certificate text.',
                    ],
                    [
                        'role' => 'user',
                        'content' => "Extract the following details from this certificate text:\n\nText: {$text}\n\n1. Type of certificate\n2. Name of recipient\n3. Title of event\n4. Name of organization or sponsor\n5. Designation or role of recipient\n6. Count the number of days of the event\n7. Date of the event\n\nReturn the data in JSON format with keys: type, name, title, organization, designation, days and date.",
                    ],
                ],
            ]);
    
            $output = $response['choices'][0]['message']['content'] ?? '';
    
            // Parse OpenAI response
            $parsedData = json_decode($output, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->with('error', "Failed to parse OpenAI response for certificate: {$certificate->getClientOriginalName()}");
            }
    
            // Categorize Certificates
            $category = $this->categorizeCertificate($text);

            // Give Points
            $points = $this->scoreCertificate($category);

            // Step 4: Prepare and save the extracted data
            $data = [
                'type' => $parsedData['type'] ?? 'Unknown',
                'name' => $parsedData['name'] ?? 'Unknown',
                'title' => $parsedData['title'] ?? 'Unknown',
                'organization' => $parsedData['organization'] ?? 'Unknown',
                'designation' => $parsedData['designation'] ?? 'Unknown',
                'days' => is_numeric($parsedData['days']) ? $parsedData['days'] : 0,
                'date' => $parsedData['date'] ?? 'Unknown',
                'category' => $category,
                'points' => $points, 
                'raw_text' => $text,
                'teacher_id' => $teacherId,
            ];
    
            Certificate::create($data);
        }
    
        // Step 5: Redirect to the profile page with success message
        return redirect()->route('profile', ['teacher_id' => $teacherId])
            ->with('success', 'Certificates uploaded and processed successfully.');
    }
    
    private function categorizeCertificate($text)
    {
    $text = strtolower($text);

    if (preg_match('/attendance|completion|conferences|congress|trainings|participation/', $text)) {
        return 'seminar';
    }

    if (preg_match('/runner-up|placer/', $text)) {
        return 'honors_awards';
    }

    if (preg_match('/member|officer/', $text)) {
        return 'membership';
    }

    if (preg_match('/adviser|panelist|workbook/', $text)) {
        return 'scholarship_activities_a';
    }

    if (preg_match('/book|judge|coach|consultant|trainer|facilitator|researcher|speaker/', $text)) {
        return 'scholarship_activities_b';
    }

    if (preg_match('/student service|service to students|organization/', $text)) {
        return 'service_students';
    }

    if (preg_match('/department service|service to department/', $text)) {
        return 'service_department';
    }

    if (preg_match('/institutional service|service to institution|organized by|sponsored by/', $text)) {
        return 'service_institution';
    }

    if (preg_match('/active participation|organizations/', $text)) {
        return 'participation_organizations';
    }

    if (preg_match('/involvement in department|run and row|gk build|bike and plant/', $text)) {
        return 'involvement_department';
    }

    return 'unknown';
    }

    private function scoreCertificate($category)
    {
        $scores = [
            'seminar' => 5.0,
            'honors_awards' => 1.0,
            'membership' => 2.0,
            'scholarship_activities_a' => 2.0,
            'scholarship_activities_b' => 2.0,
            'service_students' => 1.5,
            'service_department' => 2.5,
            'service_institution' => 1.0,
            'participation_organizations' => 2.5,
            'involvement_department' => 2.5,
        ];

        return $scores[$category] ?? 0.0; // Default to 0.0 if the category doesn't match
    }

    */

    /**
 * Uploads certificates and extracts certificate data.
 */
public function extractCertificateData(Request $request)
{
    // Step 1: Validate and save the uploaded files
    $request->validate([
        'certificates.*' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validate multiple files
        'ranking_application_id' => 'required|exists:ranking_applications,id', // Validate application ID
    ]);

    $certificates = $request->file('certificates');
    $applicationId = $request->input('ranking_application_id');

    foreach ($certificates as $certificate) {
        $path = $certificate->store('certificates', 'public');
        $processedImagePath = storage_path("app/public/{$path}");

        // Step 2: Perform OCR on the processed image
        $tesseract = new TesseractOCR($processedImagePath);
        $text = $tesseract->run();

        if (empty($text)) {
            return back()->with('error', "Failed to extract text from certificate: {$certificate->getClientOriginalName()}");
        }

        // Step 3: Use OpenAI API to extract details
        $openaiApiKey = env('OPENAI_API_KEY'); // Add your API key to the .env file
        $openai = OpenAI::client($openaiApiKey);

        $response = $openai->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful assistant that extracts structured data from certificate text.',
                ],
                [
                    'role' => 'user',
                    'content' => "Extract the following details from this certificate text:\n\nText: {$text}\n\n1. Type of certificate\n2. Name of recipient\n3. Title of event\n4. Name of organization or sponsor\n5. Designation or role of recipient\n6. Count the number of days of the event\n7. Date of the event\n\nReturn the data in JSON format with keys: type, name, title, organization, designation, days and date.",
                ],
            ],
        ]);

        $output = $response['choices'][0]['message']['content'] ?? '';

        // Parse OpenAI response
        $parsedData = json_decode($output, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->with('error', "Failed to parse OpenAI response for certificate: {$certificate->getClientOriginalName()}");
        }

        // Categorize Certificates
        //$category = $this->categorizeCertificate($text);

        // Give Points
        //$points = $this->scoreCertificate($category);

        // Step 4: Prepare and save the extracted data
        $data = [
            'type' => $parsedData['type'] ?? 'Unknown',
            'name' => $parsedData['name'] ?? 'Unknown',
            'title' => $parsedData['title'] ?? 'Unknown',
            'organization' => $parsedData['organization'] ?? 'Unknown',
            'designation' => $parsedData['designation'] ?? 'Unknown',
            'days' => is_numeric($parsedData['days']) ? $parsedData['days'] : 0,
            'date' => $parsedData['date'] ?? 'Unknown',
            //'category' => $category,
            //'points' => $points,
            'raw_text' => $text,
            'ranking_application_id' => $applicationId, // Associate with ranking application
        ];

        Certificate::create($data);
    }

    // Step 5: Redirect to the userApplication.blade.php/user.viewApplication page with success message
    return redirect()->route('user.viewApplication', ['id' => $applicationId])
        ->with('success', 'Certificates uploaded and processed successfully.');
}

    public function showCertificates(Request $request)
    {
    $query = $request->input('query');
    $teacherId = $request->input('teacher_id');

    // Initialize the certificate query
    $certificateQuery = Certificate::query();

    // Filter by search query if provided
    if ($query) {
        $certificateQuery->where(function ($q) use ($query) {
            $q->where('id', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->orWhere('type', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->orWhere('organization', 'like', "%{$query}%")
            ->orWhere('designation', 'like', "%{$query}%")
            ->orWhere('date', 'like', "%{$query}%")
            ->orWhere('raw_text', 'like', "%{$query}%")
            ->orWhere('points', 'like', "%{$query}%");
        });
    }

    // Filter by teacher_id if a teacher is selected
    if ($teacherId) {
        $certificateQuery->where('teacher_id', $teacherId);
        $selectedTeacher = Teacher::findOrFail($teacherId); // Get the teacher's details
    } else {
        $selectedTeacher = null;
    }

    // Get certificates of user
    $allCertificates = $certificateQuery->get();

    // Retrieve all teachers for the dropdown
    $allTeachers = Teacher::all();

    // Return view to userApplication.blade.php/user.viewApplication
    return view('profile', [
        'allCertificates' => $allCertificates,
        'allTeachers' => $allTeachers,
        'selectedTeacher' => $selectedTeacher, // Pass selected teacher's details
        'query' => $query,
        'teacher_id' => $teacherId, // Pass teacher_id for default selection
    ]);
    }

    // Displays user details of the current user
    public function viewSummary()
{
    // Get the currently authenticated user
    $user = auth()->user();

    // Retrieve user's next rank
    $rank = $user->next_rank ?? 'Unknown';

    // Use user's individual performance and experience
    $performance = $user->performance;
    $experience = $user->experience;

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

    // Pass data to the user\userSummary.blade.php
    return view('user.userSummary', [
        'user' => $user,
        'performance' => $performance,
        'experience' => $experience,
    ]);
}
}

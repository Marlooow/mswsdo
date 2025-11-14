<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Batch;
use App\Models\Beneficiary;
use App\Models\Program;
use App\Models\User;
use App\Services\BeneficiarySearchService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class SocialWorkerController extends Controller
{
    protected $searchService;

    public function __construct(BeneficiarySearchService $searchService)
    {
        $this->searchService = $searchService;
    }
    public function index(Request $request)
    {
        $programId = auth()->user()->program_id; // Get the current user's program ID

        // Start the query for beneficiaries based on the program
        $query = Beneficiary::query()
            ->where('program_id', $programId)
            ->with(['applications' => function ($query) {
                // Eager load only the most recent application for each beneficiary
                $query->whereIn('id', function ($subQuery) {
                    $subQuery->selectRaw('MAX(id) as id')
                        ->from('applications')
                        ->groupBy('beneficiary_id');
                });
            }]);

        // Improved status filter to ensure only the latest application is considered
        if ($request->has('status') && !empty($request->status)) {
            $query->whereHas('applications', function ($subQuery) use ($request) {
                $subQuery->where('id', function ($latestQuery) {
                    $latestQuery->selectRaw('MAX(id)')
                        ->from('applications')
                        ->whereColumn('beneficiary_id', 'beneficiaries.id');
                })->where('status', $request->status);
            });
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($query) use ($request, $programId) {
                // Search within beneficiary fields
                $query->where('surname', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('middle_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhereHas('socialWorker', function ($q) use ($request, $programId) {
                        $q->where('program_id', $programId) // Ensure social worker is from the current program
                            ->where(function ($q) use ($request) {
                                $q->where('surname', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('first_name', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('middle_name', 'LIKE', '%' . $request->search . '%');
                            });
                    });
            });
        }

        $beneficiaries = $query
            ->withCount('applications')
            ->withCount(['applications as approved_applications' => function ($q) {
                $q->where('status', 'approved');
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $program = Program::find($programId);

        // Return the view with beneficiaries and program data
        return view('dashboards.social_worker', compact('beneficiaries', 'program'));
    }

    public function create(Request $request, $program_name, $beneficiary_id = null)
    {
        /**
         * ------------------------------------------
         * TESTING MODE
         * ------------------------------------------
         * When TRUE → waiting period is bypassed
         * When FALSE → real 3-month waiting period enforced
         */
        $testingMode = true; // change to false in production

        // Mock time only to bypass waiting — do NOT affect DB
        if ($testingMode) {
            \Carbon\Carbon::setTestNow(\Carbon\Carbon::now()->addMonths(3)->addDay());
        }

        /**
         * ------------------------------------------
         * Resolve program & authorization
         * ------------------------------------------
         */
        $decodedProgramName = str_replace('-', ' ', $program_name);

        $selectedProgram = Program::where('name', $decodedProgramName)->firstOrFail();
        $program_id = $selectedProgram->id;

        if (auth()->user()->program_id != $program_id) {
            $message = 'Unauthorized access to this form';
            return $request->ajax()
                ? redirect()->route('error.route')->with('error', $message)
                : back()->with('error', $message);
        }

        /**
         * ------------------------------------------
         * Prefill variables
         * ------------------------------------------
         */
        $beneficiary = null;
        $formData = null;
        $canApply = true;
        $errorMessage = '';

        /**
         * ------------------------------------------
         * Beneficiary application eligibility logic
         * ------------------------------------------
         */
        if ($beneficiary_id) {
            $beneficiary = Beneficiary::findOrFail($beneficiary_id);

            $latestApplication = $beneficiary->applications()
                ->where('program_id', $program_id)
                ->latest('created_at')
                ->first();

            if ($latestApplication) {

                /**
                 * 1. Application must be approved before reapplying
                 */
                if ($latestApplication->status !== 'approved') {
                    $canApply = false;
                    $errorMessage = 'Previous application for this program must be approved before applying again.';
                }

                /**
                 * 2. Enforce real waiting period (skip in Testing Mode)
                 */
                if (!$testingMode) {
                    $threeMonthsLater = $latestApplication->created_at->copy()->addMonths(3);

                    if (now()->lessThan($threeMonthsLater)) {
                        $canApply = false;

                        $remainingDays = now()->diffInDays($threeMonthsLater);
                        $months = floor($remainingDays / 30);
                        $days = $remainingDays % 30;

                        $errorMessage = "You must wait at least {$months} months and {$days} days before reapplying to this program.";
                    }
                }

                /**
                 * 3. Prefill form with last application data
                 */
                $formData = json_decode($latestApplication->form_data, true)
                    ?? $this->prepareBasicBeneficiaryData($beneficiary);
            } else {
                // No previous application — fill basic data
                $formData = $this->prepareBasicBeneficiaryData($beneficiary);
            }
        }

        /**
         * ------------------------------------------
         * AJAX handling
         * ------------------------------------------
         */
        if ($request->ajax()) {
            return $canApply
                ? redirect()->route('social_worker.form', [$program_name, $beneficiary_id])
                : redirect()->route('social_worker.form', [$program_name, $beneficiary_id])->with('error', $errorMessage);
        }

        /**
         * ------------------------------------------
         * Resolve view based on program
         * ------------------------------------------
         */
        $viewPath = match ($selectedProgram->name) {
            'Senior Citizen' => 'social_worker.forms.senior_citizen',
            'Solo Parent' => 'social_worker.forms.solo_parent',
            'Educational Assistance' => 'social_worker.forms.educational_assistance',
            'AIFCS' => 'social_worker.forms.aifcs',
            default => abort(404, 'Form not found for this program'),
        };

        /**
         * ------------------------------------------
         * Clear mocked time
         * ------------------------------------------
         */
        if ($testingMode) {
            \Carbon\Carbon::setTestNow();
        }

        return view($viewPath, compact('selectedProgram', 'formData', 'beneficiary_id', 'canApply'));
    }





    // Helper method to prepare basic beneficiary data
    private function prepareBasicBeneficiaryData(Beneficiary $beneficiary)
    {
        return [
            'surname' => $beneficiary->surname,
            'first_name' => $beneficiary->first_name,
            'middle_name' => $beneficiary->middle_name,
            'address' => $beneficiary->address,
            'sex' => $beneficiary->sex,
            'civil_status' => $beneficiary->civil_status,
            'phone_number' => $beneficiary->phone_number,
            'name_extension' => $beneficiary->name_extension,
            'place_of_birth' => $beneficiary->place_of_birth,
            'dob' => $beneficiary->dob ? $beneficiary->dob->format('Y-m-d') : null,
            'age' => $beneficiary->dob ? $beneficiary->dob->age : null,
            'occupation' => $beneficiary->occupation,
        ];
    }


    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $this->validateBeneficiary($request);

        // Get program details
        $program = Program::findOrFail(auth()->user()->program->id);
        $programNameSlug = Str::slug($program->name);
        $fullName = $this->generateFullName($programNameSlug, $validatedData['form_data']);

        try {
            // Check for existing beneficiary within THIS specific program
            $existingBeneficiary = Beneficiary::where('program_id', $program->id)
                ->where('first_name', $validatedData['form_data']['first_name'])
                ->where('middle_name', $validatedData['form_data']['middle_name'])
                ->where('surname', $validatedData['form_data']['surname'])
                ->first();

            if ($existingBeneficiary) {
                // Check eligibility
                $latestProgramApplication = $existingBeneficiary->applications()
                    ->where('program_id', $program->id)
                    ->latest()
                    ->first();

                if ($latestProgramApplication) {
                    $threeMonthsLater = $latestProgramApplication->created_at->copy()->addMonths(3);

                    if (
                        now()->lessThan($threeMonthsLater) ||
                        $latestProgramApplication->status === 'pending'
                    ) {
                        return redirect()->route('social_worker.create', [
                            'program_name' => $programNameSlug,
                            'beneficiary_id' => $existingBeneficiary->id
                        ])->with('error', 'Not eligible for a new application in this program. Please check the status or date of the application.');
                    }
                }

                // Create new application
                $application = $existingBeneficiary->applications()->create([
                    'program' => $program->name,
                    'program_id' => $program->id,
                    'social_worker_id' => auth()->id(),
                    'status' => 'pending',
                    'form_data' => json_encode($validatedData['form_data'])
                ]);
            } else {
                // Create new beneficiary + application
                $beneficiary = Beneficiary::create([
                    'social_worker_id' => auth()->id(),
                    'program' => $program->name,
                    'program_id' => $program->id,
                    'status' => 'pending',
                    'first_name' => $validatedData['form_data']['first_name'],
                    'surname' => $validatedData['form_data']['surname'],
                    'middle_name' => $validatedData['form_data']['middle_name'] ?? null,
                    'dob' => $validatedData['form_data']['dob'],
                    'sex' => $validatedData['form_data']['sex'],
                    'address' => $validatedData['form_data']['address'],
                    'name_extension' => $validatedData['form_data']['name_extension'] ?? 'N/A',
                    'place_of_birth' => $validatedData['form_data']['place_of_birth'],
                    'phone_number' => $validatedData['form_data']['phone_number'] ?? 'N/A',
                    'civil_status' => $validatedData['form_data']['civil_status']
                ]);

                $application = $beneficiary->applications()->create([
                    'program' => $program->name,
                    'program_id' => $program->id,
                    'social_worker_id' => auth()->id(),
                    'status' => 'pending',
                    'form_data' => json_encode($validatedData['form_data'])
                ]);
            }

            return redirect()->route('social_worker.index')
                ->with('success', "{$fullName}'s Application Created Successfully.");
        } catch (Exception $e) {
            Log::error('Error creating application: ' . $e->getMessage());

            return redirect()->route('social_worker.create', [
                'program_name' => $programNameSlug
            ])->with('error', 'Failed to create beneficiary application. Please try again.');
        }
    }


    // private function isReapplyingTooSoon(Beneficiary $beneficiary, $programId)
    // {
    //     $latestApplication = $beneficiary->applications()
    //         ->where('program_id', $programId)
    //         ->latest('created_at')
    //         ->first();

    //     if ($latestApplication) {
    //         $threeMonthsLater = $latestApplication->created_at->copy()->addMonths(3);

    //         if (now()->lessThan($threeMonthsLater)) {
    //             $totalDays = now()->diffInDays($threeMonthsLater);

    //             $months = floor($totalDays / 30);
    //             $days = $totalDays % 30;

    //             // Format the remaining time
    //             $remainingTime = '';
    //             if ($months > 0) {
    //                 $remainingTime .= $months . ' month' . ($months > 1 ? 's' : '');
    //             }
    //             if ($days > 0) {
    //                 $remainingTime .= ($remainingTime ? ' and ' : '') . $days . ' day' . ($days > 1 ? 's' : '');
    //             }

    //             return $remainingTime;
    //         }
    //     }
    //     return false;
    // }

    // New method for search functionality
    public function searchBeneficiaries(Request $request, $program_id)
    {
        $request->validate([
            'search_term' => 'required|string|min:2'
        ]);

        $beneficiaries = Beneficiary::where(function ($query) use ($request) {
            $query->where('surname', 'LIKE', '%' . $request->search_term . '%')
                ->orWhere('first_name', 'LIKE', '%' . $request->search_term . '%')
                ->orWhere('middle_name', 'LIKE', '%' . $request->search_term . '%');
        })
            ->select('surname', 'first_name', 'middle_name')
            ->selectRaw('MAX(id) as id')
            ->groupBy('surname', 'first_name', 'middle_name')
            ->limit(10)
            ->get();

        return response()->json([
            'beneficiaries' => $beneficiaries->map(function ($beneficiary) {
                return [
                    'id' => $beneficiary->id,
                    'name' => "{$beneficiary->surname}, {$beneficiary->first_name} " .
                        ($beneficiary->middle_name ? $beneficiary->middle_name : '')
                ];
            }),
            'status' => 'success'
        ]);
    }

    public function getBeneficiaryDetails(Request $request, $program_id, $beneficiary_id)
    {
        $beneficiary = Beneficiary::findOrFail($beneficiary_id);

        // Get the beneficiary's date of birth
        $dob = Carbon::parse($beneficiary->dob);

        // Calculate the age by comparing DOB with the current date
        $age = $dob->age;

        // Basic details to return
        $details = [
            'surname' => $beneficiary->surname,
            'first_name' => $beneficiary->first_name,
            'middle_name' => $beneficiary->middle_name,
            'name_extension' => $beneficiary->name_extension,
            'address' => $beneficiary->address,
            'dob' => $beneficiary->dob,
            'place_of_birth' => $beneficiary->place_of_birth,
            'sex' => $beneficiary->sex,
            'phone_number' => $beneficiary->phone_number,
            'age' => $age,
            'civil_status' => $beneficiary->civil_status
        ];

        return response()->json($details);
    }


    private function generateFullName($programName, $formData)
    {
        // Normalize program name (convert slug to readable text)
        $normalizedProgram = Str::of($programName)
            ->lower()
            ->replace('-', ' ')
            ->title();

        // Fetch all valid program names from the database
        $validPrograms = Program::pluck('name')->toArray();

        // Validate
        if (!in_array($normalizedProgram, $validPrograms)) {
            throw new \Exception("Invalid program name: {$programName}");
        }

        // Proceed with using $normalizedProgram or $programName as needed
        return $formData['surname'] . ', ' . $formData['first_name'] . ' ' . $formData['middle_name'];
    }

    private function validateBeneficiary(Request $request)
    {
        $program = Program::findOrFail(auth()->user()->program->id);
        $programName = strtolower(str_replace(' ', '', $program->name));

        $signaturiesAdmin = User::getAdminForProgram($program->id);

        //MGA COMMON FIELDS FOR EACH PROGRAMS
        //PARA DILI NA MAG BALIK2 UG HIMO SA FORMS
        $rules = [
            'form_data' => 'required|array',
            'form_data.surname' => 'required|string|max:255',
            'form_data.first_name' => 'required|string|max:255',
            'form_data.middle_name' => 'required|string|max:255',
            'form_data.name_extension' => 'nullable|string|max:255',
            'form_data.sex' => 'required|string|max:255',
            'form_data.place_of_birth' => 'nullable|string|max:255',
            'form_data.civil_status' => 'required|string|max:255',
            'form_data.educational_attainment' => 'required|string|max:255',
            'form_data.occupation' => 'required|string|max:255',
            'form_data.address' => 'required|string|max:255',
            'form_data.dob' => 'required|date',
            'form_data.phone_number' => 'nullable|string|max:13',
            'form_data.age' => 'nullable|numeric|min:0',
            'form_data.certification' => 'accepted',
            'program_id' => 'required|exists:programs,id',

        ];

        if ($programName == 'seniorcitizen') { // Senior Citizen

            $rules['form_data.annual_income'] = 'required|numeric|min:0';
            $rules['form_data.other_skills'] = 'nullable|string|max:255';

            $rules['form_data.family_composition'] = 'nullable|array';
            $rules['form_data.family_composition.*.name'] = 'required|string|max:255';
            $rules['form_data.family_composition.*.age'] = 'required|integer|min:0';
            $rules['form_data.family_composition.*.relation'] = 'required|string|max:255';
            $rules['form_data.family_composition.*.civil_status'] = 'required|string|max:255';
            $rules['form_data.family_composition.*.occupation'] = 'required|string|max:255';
            $rules['form_data.family_composition.*.income'] = 'required|numeric|min:0';

            // $rules['form_data.name_of_association'] = 'nullable|string|max:255';
            // $rules['form_data.address_of_association'] = 'nullable|string|max:255';

            // $rules['form_data.date_of_membership'] = 'nullable|date';
            // $rules['form_data.officer_details'] = 'nullable|array';
            // $rules['form_data.officer_details.*.date_elected'] = 'nullable|date';
            // $rules['form_data.officer_details.*.position'] = 'nullable|string|max:255';
            // $rules[form_data.certification'] = 'accepted' ;
            $request->merge([
                'form_data' => array_merge($request->input('form_data', []), [
                    'org_president' => $signaturiesAdmin->name ?? null,
                ])
            ]);

            //required document
            $rules['form_data.seniorid'] = 'nullable|boolean';
        }

        if ($programName == 'educationalassistance') { // Educational Assistance

            //required document
            $rules['form_data.referral_slip'] = 'required|boolean';
            $rules['form_data.study_load'] = 'required|boolean';
            $rules['form_data.student_id'] = 'required|boolean';
            $rules['form_data.certificate_of_no_scholarship'] = 'required|boolean';
            $rules['form_data.brgy_cert'] = 'required|boolean';
            $rules['form_data.cert_ass_off'] = 'required|boolean';
        }
        if ($programName == 'soloparent') { // Solo Parent
            $rules['form_data.religion'] = 'nullable|string|max:255';
            $rules['form_data.company_agency'] = 'nullable|string|max:255';
            $rules['form_data.monthly_income'] = 'nullable|string|max:255';
            $rules['form_data.employment_status'] = 'required|string|max:255';
            $rules['form_data.pantawid_beneficiary'] = 'nullable|boolean';
            $rules['form_data.indigenous_person'] = 'nullable|boolean';
            $rules['form_data.lgbtq_plus'] = 'nullable|boolean';
            $rules['form_data.family_composition'] = 'required|array'; // NAKA ARRAY PARA IF INCASE DAGHAN FAMILY MEMBERS PWEDE RA MAKA ADD UG NEW ROW
            $rules['form_data.family_composition.*.name'] = 'required|string|max:255';
            $rules['form_data.family_composition.*.relationship'] = 'required|string|max:255';
            $rules['form_data.family_composition.*.age'] = 'required|integer|min:0';
            $rules['form_data.family_composition.*.birthdate'] = 'required|date';
            $rules['form_data.family_composition.*.civil_status'] = 'required|string|max:255';
            $rules['form_data.family_composition.*.educational_attainment'] = 'required|string|max:255';
            $rules['form_data.family_composition.*.occupation'] = 'required|string|max:255';
            $rules['form_data.family_composition.*.monthly_income'] = 'required|numeric|min:0';
            $rules['form_data.classification_circumstances'] = 'required|string|max:255';
            $rules['form_data.needs_problems'] = 'required|string|max:255';
            $rules['form_data.emergency_contact.name'] = 'nullable|string|max:255';
            $rules['form_data.emergency_contact.relationship'] = 'nullable|string|max:255';
            $rules['form_data.emergency_contact.address'] = 'nullable|string|max:255';
            $rules['form_data.emergency_contact_number'] = 'required|string|max:13';
            $rules['form_data.child_birth_cert'] = 'required|boolean';
            $rules['form_data.parent_id'] = 'required|boolean';
            $rules['form_data.brgy_clearance'] = 'required|boolean';
        }
        if ($programName == 'aifcs') { // AIFCS
            $rules['form_data.certificate_date'] = 'required|date'; // Date field for the certificate
            $rules['form_data.financial_assistance'] = 'required|string|max:255'; // Financial Assistance field
            $rules['form_data.assistance_type'] = 'required|string|max:255'; // Amount field
            $rules['form_data.assistance_amount'] = 'required|string|max:255'; // Amount field

            // Checkboxes for required documents
            $rules['form_data.brgy_certification'] = 'nullable|boolean';
            $rules['form_data.death_certificate'] = 'nullable|boolean';
            $rules['form_data.valid_id_presented'] = 'nullable|boolean';
            $rules['form_data.medical_certificate'] = 'nullable|boolean';
            $rules['form_data.lab_request'] = 'nullable|boolean';
            $rules['form_data.quotation'] = 'nullable|boolean';
            $rules['form_data.charge_slip'] = 'nullable|boolean';
            $rules['form_data.medical_prescription'] = 'nullable|boolean';
            $rules['form_data.statement_of_account'] = 'nullable|boolean';
            $rules['form_data.discharge_summary'] = 'nullable|boolean';
            $rules['form_data.vaccination'] = 'nullable|boolean';
            $rules['form_data.treatment_protocol'] = 'nullable|boolean';

            // Signature and approver fields
            $rules['form_data.client_signature_date'] = 'nullable|date'; // Date of client signature
            $rules['form_data.approved_by'] = 'nullable|string|max:255'; // Approver's name
            $rules['form_data.approver_license'] = 'nullable|string|max:255'; // Approver's license number
        }

        return $request->validate($rules);
    }



    public function show($beneficiary_id, $application_id = null)
    {
        // Retrieve the beneficiary
        $beneficiary = Beneficiary::with(['applications' => function ($query) {
            $query->where('program_id', auth()->user()->program_id)
                ->orderBy('created_at', 'desc');
        }])->findOrFail($beneficiary_id);

        // List of applications for this beneficiary (program-filtered)
        $applications = $beneficiary->applications;

        // Get the selected application (fetch independently, not filtered)
        if ($application_id) {
            $selectedApplication = Application::find($application_id);

            // Ensure the application belongs to this beneficiary
            if (!$selectedApplication || $selectedApplication->beneficiary_id != $beneficiary->id) {
                abort(404);
            }
        } else {
            $selectedApplication = $applications->first(); // fallback to latest in program
        }

        // Get approved applications with approver names
        $approverName = null;
        if ($selectedApplication && $selectedApplication->admin_id) {
            $approverName = $selectedApplication->admin?->name;
            // fallback if not eager loaded
            if (!$approverName) {
                $approverName = User::where('id', $selectedApplication->admin_id)->value('name');
            }
        }

        Log::info($approverName);
        // Retrieve form data and the view for the selected application
        $formData = $view = null;
        if ($selectedApplication) {
            $formData = json_decode($selectedApplication->form_data, true);
            $view = $this->getViewForProgram($selectedApplication->program);
        }

        // Determine user roles
        $user = auth()->user();
        $isAdmin = $user ? $user->isAdmin() : false;
        $isSocialWorker = $user ? $user->isSocialWorker() : false;

        // Get latest application to check if new application can be added
        $latestApplication = $beneficiary->applications->first(); // already ordered by created_at desc
        $canApply = true;

        if ($latestApplication && $latestApplication->status === 'pending') {
            $canApply = false;
        } else {
            $latestApplicationDate = $beneficiary->applications->max('created_at');
            if ($latestApplicationDate && $latestApplicationDate->diffInMonths(now()) <= 3) {
                $canApply = false;
            }
        }

        return view('social_worker.beneficiary_show', compact(
            'beneficiary',
            'applications',
            'selectedApplication',
            'formData',
            'isAdmin',
            'view',
            'isSocialWorker',
            'canApply',
            'approverName'
        ));
    }



    public function getViewForProgram($program)
    {
        $program = Program::findOrFail(auth()->user()->program->id);
        $programName = strtolower(str_replace(' ', '', $program->name));

        switch ($programName) {
            case 'seniorcitizen':
                return 'partials.senior_citizen_partial_view';
            case 'soloparent':
                return 'partials.solo_parent_partial_view';
            case 'educationalassistance':
                return 'partials.educational_assistance_partial_view';
            default:
                return 'partials.aifcs_partial_view';
        }
    }

    public function getCurrentProgram($id)
    {
        $program = Program::findOrFail($id);
        $programName = strtolower(str_replace(' ', '', $program->name));

        return $programName;
    }

    public function update(Request $request, Beneficiary $beneficiary)
    {
        $validatedData = $this->validateBeneficiary($request);

        $beneficiary->update($validatedData);

        return redirect()->route('social_worker.show', $beneficiary->id)->with('success', 'Beneficiary details updated successfully');
    }

    public function sendToAdmin(Beneficiary $beneficiary)
    {
        // Logic to send the application to the admin
        $beneficiary->status = 'pending';
        $beneficiary->save();

        return redirect()->route('social_worker.index')->with('success', 'Application sent to admin');
    }

    public function generateReport(Request $request)
    {
        $request->validate([
            'status' => 'required|in:approved,disapproved,pending',
            'month' => 'nullable|integer|min:1|max:12',
            'year' => 'nullable|integer|min:2000|max:2100',
        ]);

        $query = Beneficiary::where('program_id', auth()->user()->program_id)
            ->where('status', $request->status);

        // Filter by month and year if provided
        if ($request->month) {
            $query->whereMonth('created_at', $request->month);
        }
        if ($request->year) {
            $query->whereYear('created_at', $request->year);
        }

        $beneficiaries = $query->get();

        return view('social_worker.report', compact('beneficiaries', 'request'));
    }
}


    //RELEASE FEATURE:
//     public function showBatchRelease(Request $request)
//     {
//         // Get the program assigned to the logged-in social worker
//         $socialWorkerProgramId = auth()->user()->program_id; // Assuming this field exists

//         // Retrieve unbatched applications
//         $unbatchedApplications = Application::whereNull('batch_id')
//             ->where('status', 'approved')
//             ->where('claim_status', '!=', 'Claimed')
//             ->whereHas('program', function ($query) use ($socialWorkerProgramId) {
//                 $query->where('id', $socialWorkerProgramId);
//             })
//             ->with(['program', 'beneficiary'])
//             ->get();

//         // Retrieve batch-released applications
//         $batchReleasedApplications = Application::whereNotNull('batch_id')
//             ->whereHas('program', function ($query) use ($socialWorkerProgramId) {
//                 $query->where('id', $socialWorkerProgramId);
//             })
//             ->with(['program', 'beneficiary', 'batch'])
//             ->get();

//         // Retrieve individually released applications
//         $individuallyReleasedApplications = Application::whereNull('batch_id')
//             ->where('claim_status', 'Claimed')
//             ->whereHas('program', function ($query) use ($socialWorkerProgramId) {
//                 $query->where('id', $socialWorkerProgramId);
//             })
//             ->with(['program', 'beneficiary'])
//             ->get();

//         // Summary statistics
//         $totalApplications = Application::whereHas('program', function ($query) use ($socialWorkerProgramId) {
//             $query->where('id', $socialWorkerProgramId);
//         })->count();

//         $unclaimedApplications = Application::where('claim_status', '!=', 'Claimed')
//             ->whereHas('program', function ($query) use ($socialWorkerProgramId) {
//                 $query->where('id', $socialWorkerProgramId);
//             })
//             ->count();

//         $claimedApplications = Application::where('claim_status', 'Claimed')
//             ->whereHas('program', function ($query) use ($socialWorkerProgramId) {
//                 $query->where('id', $socialWorkerProgramId);
//             })
//             ->count();

//         $totalReleasedAmount = Application::where('claim_status', 'Claimed')
//             ->whereHas('program', function ($query) use ($socialWorkerProgramId) {
//                 $query->where('id', $socialWorkerProgramId);
//             })
//             ->sum('claimed_amount');

//         return view('social_worker.batches.index', compact(
//             'unbatchedApplications',
//             'batchReleasedApplications',
//             'individuallyReleasedApplications',
//             'totalApplications',
//             'unclaimedApplications',
//             'claimedApplications',
//             'totalReleasedAmount'
//         ));
//     }


//     public function manageRelease(Request $request)
//     {
//         $data = $request->validate([
//             'name' => 'required|unique:batches',
//             'social_worker_id' => 'required|exists:users,id',
//             'release_date' => 'required|date',
//             'remarks' => 'nullable|string',
//             'selected_beneficiaries' => 'required|array', // Beneficiaries must be selected
//             'selected_beneficiaries.*' => 'exists:applications,id',
//         ]);

//         DB::beginTransaction();
//         try {
//             $batch = Batch::create([
//                 'name' => $data['name'],
//                 'social_worker_id' => $data['social_worker_id'],
//                 'release_date' => $data['release_date'],
//                 'remarks' => $data['remarks'],
//                 'status' => 'Pending'
//             ]);

//             Application::whereIn('id', $data['selected_beneficiaries'])
//                 ->update(['batch_id' => $batch->id]);

//             DB::commit();
//             return redirect()->route('social_worker.showBatchRelease')->with('success', 'Batch created successfully.');
//         } catch (\Exception $e) {
//             DB::rollBack();
//             return back()->with('error', 'Failed to create batch. ' . $e->getMessage());
//         }
//     }


//     public function releaseBatch(Request $request, Batch $batch)
//     {
//         $data = $request->validate([
//             'selected_beneficiaries' => 'array',
//             'selected_beneficiaries.*' => 'exists:applications,id',
//         ]);

//         // Use selected beneficiaries if provided, otherwise release all in the batch
//         $beneficiaries = $data['selected_beneficiaries'] ?? $batch->applications->pluck('id')->toArray();

//         // Process each selected application
//         foreach ($batch->applications as $application) {
//             if (in_array($application->id, $beneficiaries)) {
//                 $application->load('program');
//                 $programType = is_object($application->program) ? $application->program->program_type : null;

//                 $updateData = [
//                     'claim_status' => 'Claimed',
//                     'claim_date' => now(),
//                 ];

//                 if ($programType === 'financial') {
//                     $updateData['claimed_amount'] = $batch->amount
//                         ? $batch->amount / count($beneficiaries)
//                         : 0;
//                 }

//                 $application->update($updateData);
//             }
//         }

//         // Update the batch status
//         $this->updateBatchStatus($batch->id);

//         return redirect()->route('social_worker.showBatchRelease')
//             ->with('success', 'Batch released successfully.');
//     }

//     public function updateClaimStatus(Request $request, $applicationId)
//     {
//         $application = Application::with('batch')->findOrFail($applicationId);

//         // Check if the application belongs to a released batch
//         if ($application->batch && $application->batch->status === 'Released') {
//             return redirect()->back()->with('error', 'Cannot update beneficiaries in a released batch.');
//         }

//         $data = $request->validate([
//             'claim_status' => 'required|in:Claimed,Unclaimed',
//             'claimed_amount' => 'nullable|numeric|min:0|required_if:claim_status,Claimed',
//         ]);

//         $application->load('program');
//         $programType = is_object($application->program) ? $application->program->program_type : null;

//         $updateData = [
//             'claim_status' => $data['claim_status'],
//             'claim_date' => $data['claim_status'] === 'Claimed' ? now() : null,
//         ];

//         if ($programType === 'financial') {
//             $updateData['claimed_amount'] = $data['claim_status'] === 'Claimed'
//                 ? ($data['claimed_amount'] ?? 0)
//                 : null;
//         }

//         $application->update($updateData);

//         // Update batch status if applicable
//         if ($application->batch_id) {
//             $this->updateBatchStatus($application->batch_id);
//         }

//         return redirect()->back()->with('success', 'Application status updated successfully.');
//     }

//     //SPECIFIC UPDATE OF RELEASE DEPENDING ON THE PROGRAM TYPE
//     public function updateBeneficiaryRelease(Request $request, $beneficiaryId)
//     {
//         $data = $request->validate([
//             'claim_status' => 'required|in:Claimed,Unclaimed',
//             'application_ids' => 'required|array',
//             'application_ids.*' => 'exists:applications,id',
//             'claimed_amount' => 'required_if:program_type,financial|nullable|numeric',
//         ]);

//         try {
//             DB::beginTransaction();

//             $applications = Application::where('beneficiary_id', $beneficiaryId)
//                 ->whereIn('id', $data['application_ids'])
//                 ->get();

//             foreach ($applications as $application) {
//                 if ($application->batch && $application->batch->status === 'Released') {
//                     continue; // Skip updates for released batches
//                 }

//                 $updateData = [
//                     'claim_status' => $data['claim_status'],
//                     'claim_date' => $data['claim_status'] === 'Claimed' ? now() : null,
//                     'claimed_amount' => $data['claim_status'] === 'Claimed' ? ($data['claimed_amount'] ?? 0) : null,
//                 ];

//                 $application->update($updateData);

//                 if ($application->batch_id) {
//                     $this->updateBatchStatus($application->batch_id);
//                 }
//             }

//             DB::commit();
//             return redirect()->back()->with('success', 'Beneficiary release status updated successfully.');
//         } catch (\Exception $e) {
//             DB::rollBack();
//             return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
//         }
//     }
//     private function updateBatchStatus($batchId)
//     {
//         $batch = Batch::find($batchId);
//         if (!$batch) return;

//         $totalApplications = $batch->applications()->count();
//         $claimedApplications = $batch->applications()
//             ->where('claim_status', 'Claimed')
//             ->count();

//         // Update batch status based on claims
//         if ($claimedApplications === 0) {
//             $status = 'Pending';
//         } elseif ($claimedApplications === $totalApplications) {
//             $status = 'Released';
//         } else {
//             $status = 'In Progress'; // Use a distinct status for partially claimed batches
//         }

//         $batch->update(['status' => $status]);
//     }
//     public function releaseBeneficiary(Request $request, $applicationId)
//     {
//         $application = Application::findOrFail($applicationId);

//         // Prevent updates for released applications
//         if ($application->claim_status === 'Claimed') {
//             return back()->with('error', 'This application is already claimed.');
//         }

//         $data = $request->validate([
//             'claimed_amount' => 'nullable|numeric|min:0|required_if:program_type,financial',
//         ]);

//         $application->claim_status = 'Claimed';
//         $application->claim_date = now();

//         if ($application->program->program_type === 'financial') {
//             $application->claimed_amount = $data['claimed_amount'] ?? 0;
//         }

//         $application->save();

//         return back()->with('success', 'Beneficiary released successfully.');
//     }
// }

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\Beneficiary;
use App\Models\Program;
use App\Models\User;
use App\Services\BeneficiarySearchService;
use App\Services\ViewResolverService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{
    protected $searchService;
    protected $viewResolverService;

    public function __construct(BeneficiarySearchService $searchService, ViewResolverService $viewResolverService)
    {
        $this->searchService = $searchService;
        $this->viewResolverService = $viewResolverService;
    }

    public function index(Request $request)
    {
        $programId = auth()->user()->program_id;

        // Start the query on the Beneficiary model
        $query = Beneficiary::query()
            ->where('program_id', $programId)
            ->with('socialWorker');

        if ($request->has('status') && !empty($request->status)) {
            $query->whereHas('applications', function ($q) use ($request) {
                $q->where('status', $request->status)
                    ->whereIn('id', function ($q) {
                        $q->selectRaw('MAX(id)')
                            ->from('applications')
                            ->whereColumn('beneficiary_id', 'beneficiaries.id'); // Ensure we're comparing the latest application of each beneficiary
                    });
            });
        }

        // Filter by search query on beneficiary's name or social worker's name
        if ($request->has('search') && !empty($request->search)) {
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('surname', 'LIKE', $search)
                    ->orWhere('first_name', 'LIKE', $search)
                    ->orWhere('middle_name', 'LIKE', $search)
                    ->orWhereHas('socialWorker', function ($q) use ($search) {
                        $q->where('surname', 'LIKE', $search)
                            ->orWhere('first_name', 'LIKE', $search)
                            ->orWhere('middle_name', 'LIKE', $search);
                    });
            });
        }


        // Include application counts and approved application count
        $beneficiaries = $query
            ->withCount('applications')
            ->withCount(['applications as approved_applications' => function ($q) {
                $q->where('status', 'approved');
            }])
            ->orderBy('created_at', 'desc')  // Order beneficiaries by creation date (can be customized)
            ->paginate(5);  // Paginate results (adjust per page if needed)

        // Retrieve program and application statistics
        $program = Program::find($programId);
        $totalApplications = Application::where('program_id', $programId)->count();
        $pendingApplications = Application::where('program_id', $programId)->where('status', 'pending')->count();
        $approvedApplications = Application::where('program_id', $programId)->where('status', 'approved')->count();
        $disapprovedApplications = Application::where('program_id', $programId)->where('status', 'disapproved')->count();

        // Return the view with the necessary data
        return view('dashboards.admin', compact('beneficiaries', 'program', 'totalApplications', 'pendingApplications', 'disapprovedApplications', 'approvedApplications'));
    }


    public function show($id, $applicationId = null)
    {
        $beneficiary = Beneficiary::with(['applications' => function ($query) {
            $query->where('program_id', auth()->user()->program_id)
                ->with('admin')
                ->orderBy('created_at', 'desc');
        }])->findOrFail($id);



        // Get all applications for this beneficiary
        $applications = $beneficiary->applications;

        // Set the selected application based on the applicationId parameter or default to the latest
        $selectedApplication = $applicationId
            ? $applications->firstWhere('id', $applicationId) // Ensuring the application ID matches
            : $applications->first();  // If no applicationId, select the most recent application

        // Retrieve form data and the view for the selected application
        $formData = $view = null;
        if ($selectedApplication) {
            $formData = json_decode($selectedApplication->form_data, true);  // Decode the form data
            $view = $this->getViewForProgram($selectedApplication->program);  // Get the form view
        }

        // Determine if the user is an admin or social worker
        $user = User::find(auth()->id());

        $isAdmin = $user ? $user->isAdmin() : false;
        $isSocialWorker = $user ? $user->isSocialWorker() : false;
        // Get the latest application to check its status
        $latestApplication = $applications->first();  // Since we ordered by 'created_at' desc
        $canApply = true;

        // Disable 'Add New Application' button if the latest application is 'pending'
        if ($latestApplication && $latestApplication->status === 'pending') {
            $canApply = false;
        } else {
            // Check if the latest application date exceeds 3 months
            $latestApplicationDate = $applications->max('created_at');
            if ($latestApplicationDate && $latestApplicationDate->diffInMonths(now()) <= 3) {
                $canApply = false;  // Disable if 3 months rule is still in effect
            }
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

        $roleId = $user->role_id;

        // Return the view
        return view('admin.beneficiary_show', compact(
            'beneficiary',
            'applications',
            'selectedApplication',
            'formData',
            'isAdmin',
            'view',
            'isSocialWorker',
            'canApply',
            'roleId',
            'approverName'
        ));
    }

    public function superadmin_show($id, $program_id, $applicationId = null)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $user = User::find(auth()->id());
        $isAdmin = $user ? $user->isAdmin() : false;

        $applications = $beneficiary->applications()
            ->where('program_id', $program_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $selectedApplication = $applicationId
            ? $applications->where('id', $applicationId)->first()
            : $applications->first();


        $approverName = null;
        if ($selectedApplication && $selectedApplication->admin_id) {
            $approverName = $selectedApplication->admin?->name;
            if (!$approverName) {
                $approverName = User::where('id', $selectedApplication->admin_id)->value('name');
            }
        }

        $latestApplication = $applications->first();
        if ($latestApplication && $beneficiary->status !== $latestApplication->status) {
            $beneficiary->status = $latestApplication->status;
            $beneficiary->save();
        }
        $formData = $selectedApplication ? json_decode($selectedApplication->form_data, true) : null;
        $view = $selectedApplication ? $this->getViewForProgramSuperAdmin($selectedApplication->program, $program_id) : null;

        return view('superadmin.beneficiary_show', [
            'beneficiary' => $beneficiary,
            'applications' => $applications,
            'selectedApplication' => $selectedApplication,
            'formData' => $formData,
            'view' => $view,
            'roleId' => auth()->user()->role_id,
            'isAdmin' => $isAdmin,
            'approverName' => $approverName
        ]);
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

    public function getViewForProgramSuperAdmin($program, $program_id)
    {
        $program = Program::findOrFail($program_id);
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

    public function updateBeneficiaryStatus(Request $request, $beneficiaryId, $applicationId)
    {
        $beneficiary = Beneficiary::findOrFail($beneficiaryId);
        $application = Application::where('beneficiary_id', $beneficiaryId)
            ->where('id', $applicationId)
            ->firstOrFail();

        $program = Program::find(auth()->user()->program_id);
        $programName = strtolower(str_replace(' ', '', $program->name));

        $validatedData = $request->validate([
            'approval_status' => $this->getApprovalStatusRules($programName),
            'program' => 'required|in:aifcs,seniorcitizen,educationalassistance,soloparent',
            'remarks' => 'nullable|string|max:500',
        ]);

        $approvalStatus = is_array($validatedData['approval_status'])
            ? $validatedData['approval_status']['value']
            : $validatedData['approval_status'];

        DB::beginTransaction();

        try {
            $application->status = ucfirst($approvalStatus);
            $application->remarks = $request->remarks;
            $application->updated_by = auth()->id();

            $this->updateBeneficiaryProgramStatus(
                $beneficiary,
                $application,
                $validatedData['program'],
                $approvalStatus
            );

            $application->admin_id = auth()->id();
            $application->approved_date = now();

            $application->save();
            $beneficiary->save();

            DB::commit();

            return redirect()
                ->route('admin.beneficiary.show', [
                    'id' => $beneficiary->id,
                    'application_id' => $application->id
                ])
                ->with('success', "{$beneficiary->surname}, {$beneficiary->first_name} {$beneficiary->middle_name}'s application status has been updated successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update status: ' . $e->getMessage());
        }
    }
    private function updateBeneficiaryProgramStatus(
        Beneficiary $beneficiary,
        Application $application,
        string $program,
        string $approvalStatus
    ) {
        $programStatusMap = [
            'seniorcitizen' => [
                'approved' => ['application_status' => 'approved', 'approval_date' => now()],
                'disapproved' => ['application_status' => 'disapproved'],
                'pending' => ['application_status' => 'pending']
            ],
            'soloparent' => [
                'approved' => ['application_status' => 'approved', 'approval_date' => now()],
                'new' => ['application_status' => 'new'],
                'renew' => ['application_status' => 'renew'],
                'disapproved' => ['application_status' => 'disapproved']
            ],
            'educationalassistance' => [
                'approved' => ['application_status' => 'approved', 'approval_date' => now()],
                'disapproved' => ['application_status' => 'disapproved'],
                'pending' => ['application_status' => 'pending']
            ],
            'aifcs' => [
                'approved' => ['application_status' => 'approved', 'approval_date' => now()],
                'disapproved' => ['application_status' => 'disapproved'],
                'pending' => ['application_status' => 'pending']
            ]
        ];

        $programStatus = $programStatusMap[strtolower($program)][strtolower($approvalStatus)] ?? null;

        if ($programStatus) {
            // Only update the application status
            $application->status = $programStatus['application_status'];
            Log::info($application->status);
            if (array_key_exists('approval_date', $programStatus)) {
                Log::info('Approval date: ' . $application->approval_date);
                $application->approval_date = $programStatus['approval_date'];
            }
        } else {
            throw new \InvalidArgumentException("Invalid status for {$program} program: {$approvalStatus}");
        }
    }

    public function updateDateReleased(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'application_id' => 'required|exists:applications,id',  // Assuming you want to validate application_id
            'date_released' => 'required|date',  // Validate the date_released
        ]);

        // Find the application to update
        $application = Application::find($validated['application_id']);
        $application->date_released = $validated['date_released'];  // Use the date passed
        $application->save();

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Date Released updated successfully.',
        ]);
    }


    private function getApprovalStatusRules($programName)
    {
        switch (strtolower($programName)) {
            case 'seniorcitizen':
                return ['required', 'in:pending,approved,disapproved'];

            case 'soloparent':
                return ['required', 'in:approved,new,renew,disapproved'];

            case 'educationalassistance':
                return ['required', 'in:pending,approved,disapproved'];

            case 'aifcs':
                return ['required', 'in:pending,approved,disapproved'];

            default:
                return ['required', 'in:pending,approved,disapproved']; // Default validation rules
        }
    }

    public function printSoloParentForm($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $formData = $this->getFormData($beneficiary);

        return view('print-solo-parent-form', compact('beneficiary', 'formData'));
    }


    private function getFormData($beneficiary)
    {
        // Customize this logic to fetch and structure your form data
        return [
            'first_name' => $beneficiary->first_name,
            'middle_name' => $beneficiary->middle_name,
            'surname' => $beneficiary->surname,
            'name_extension' => $beneficiary->name_extension,
            'age' => $beneficiary->age,
            'sex' => $beneficiary->sex,
            'dob' => $beneficiary->dob,
            'place_of_birth' => $beneficiary->place_of_birth,
            'address' => $beneficiary->address,
            'educational_attainment' => $beneficiary->educational_attainment,
            'civil_status' => $beneficiary->civil_status,
            'occupation' => $beneficiary->occupation,
            'religion' => $beneficiary->religion,
            'company_agency' => $beneficiary->company_agency,
            'monthly_income' => $beneficiary->monthly_income,
            'employment_status' => $beneficiary->employment_status,
            'phone_number' => $beneficiary->phone_number,
            'pantawid_beneficiary' => $beneficiary->pantawid_beneficiary,
            'indigenous_person' => $beneficiary->indigenous_person,
            'lgbtq_plus' => $beneficiary->lgbtq_plus,
            'family_composition' => $beneficiary->familyComposition, // Adjust if necessary
            'classification_circumstances' => $beneficiary->classification_circumstances,
            'needs_problems' => $beneficiary->needs_problems,
            'emergency_contact' => $beneficiary->emergency_contact, // Adjust if necessary
            'certification' => $beneficiary->certification,
        ];
    }
}

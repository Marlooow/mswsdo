<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\User;
use App\Models\Role;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Exclude users with 'Super Admin' role
        $query = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'super_admin');
        });

        // Filtering logic
        if ($request->filled('role') && $request->role !== 'all') {
            $query->whereHas('roles', fn($q) => $q->where('roles.id', $request->role));
        }

        if ($request->filled('program') && $request->program !== 'all') {
            $query->whereHas('beneficiaries', fn($q) => $q->where('program_id', $request->program));
        }


        // Search by name or email
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }
        $query->orderBy('created_at', 'desc');

        // Paginate results
        $users = $query->paginate(5)->appends($request->query());

        // Load available programs and roles
        $programs = Program::all();
        $roles = $this->getNonSuperAdminRoles();

        return view('superadmin.index', compact('users', 'roles', 'programs'));
    }


    public function show($id, $applicationId)
    {
        // Retrieve the beneficiary by ID
        $beneficiary = Beneficiary::findOrFail($id);

        // Get all applications for this beneficiary within the authenticated user's program
        $applications = $beneficiary->applications()
            ->where('program_id', auth()->user()->program_id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Retrieve the specific application by ID
        $selectedApplication = $beneficiary->applications()
            ->where('program_id', auth()->user()->program_id)
            ->where('id', $applicationId)
            ->firstOrFail();

        // Decode the form data for the selected application
        $formData = json_decode($selectedApplication->form_data, true);

        // Get the view for the selected application's program (e.g., dynamic rendering based on the program)
        $view = $this->getViewForProgram($selectedApplication->program);

        // Determine the authenticated user's role
        $user = User::find(auth()->id());
        $isAdmin = $user ? $user->isAdmin() : false;
        $isSocialWorker = $user ? $user->isSocialWorker() : false;

        // Check if the beneficiary can apply for a new application every 3 months
        $latestApplicationDate = $applications->max('created_at');
        $canApply = !$latestApplicationDate || $latestApplicationDate->diffInMonths(now()) >= 3;

        // Render the view with all necessary data
        return view('superadmin.beneficiary_show', [
            'beneficiary' => $beneficiary,
            'applications' => $applications,
            'selectedApplication' => $selectedApplication,
            'formData' => $formData,
            'isAdmin' => $isAdmin,
            'view' => $view,
            'isSocialWorker' => $isSocialWorker,
            'canApply' => $canApply,
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

    public function store(Request $request)
    {

        // Validate user data
        $validatedData = $this->validateUser($request);

        try {
            // Create user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'program_id' => $validatedData['program_id'],
                'status' => 'active', // Set default status
            ]);

            // Attach role
            $user->roles()->attach($validatedData['roles']);

            return redirect()->route('users.index')
                ->with('success', 'User Created Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Error Creating New User. Please try again!');
        }
    }

    public function update(Request $request, User $user)
    {
        Log::info('Updating user ID ' . $user->id . ' with data: ', $request->except('password', 'password_confirmation'));

        try {
            // Validate user data
            $validatedData = $this->validateUser($request, $user->id);

            // Prepare update data
            $userData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'program_id' => $validatedData['program_id'],
            ];

            // Only update password if provided
            if (!empty($validatedData['password'])) {
                $userData['password'] = Hash::make($validatedData['password']);
            }

            // Update user
            $user->update($userData);

            // Sync roles
            if (isset($validatedData['roles'])) {
                $user->roles()->sync($validatedData['roles']);
            }

            return redirect()->route('users.index')
                ->with('success', 'User Updated Successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Error updating user. Please try again.');
        }
    }

    public function toggleStatus(User $user)
    {
        try {
            $user->status = $user->status === 'active' ? 'inactive' : 'active';
            $user->save();

            $message = $user->status === 'active' ? 'User activated successfully' : 'User deactivated successfully';
            return redirect()->route('users.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error toggling user status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating user status. Please try again.');
        }
    }
    public function resetPassword(User $user)
    {
        try {
            $user->password = bcrypt('12345678');
            $user->save();

            return redirect()->route('users.index')->with('success', "Password for {$user->name} has been reset successfully.");
        } catch (\Exception $e) {
            Log::error('Password reset error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to reset password. Please try again.');
        }
    }



    private function getNonSuperAdminRoles()
    {
        return Role::where('name', '!=', 'super_admin')->get();
    }

    private function validateUser(Request $request, $userId = null)
    {
        $passwordRules = $userId
            ? 'nullable|string|min:8|confirmed' // Optional for updates
            : 'required|string|min:8|confirmed'; // Required for creation

        $emailRules = 'required|string|email|max:255|unique:users,email';
        if ($userId) {
            $emailRules .= ',' . $userId;
        }

        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => $emailRules,
            'password' => $passwordRules,
            'program_id' => 'required|exists:programs,id',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);
    }
}

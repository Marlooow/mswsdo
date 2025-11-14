<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of beneficiaries with filters.
     */
    public function index(Request $request)
    {
        $query = Beneficiary::with([
            'applications' => function ($query) {
                // Eager load only the most recent application for each beneficiary
                $query->whereIn('id', function ($subQuery) {
                    $subQuery->selectRaw('MAX(id) as id')
                        ->from('applications')
                        ->groupBy('beneficiary_id');
                });
            },
            'program',
            'socialWorker',
        ]);

        // Filter by program
        if ($request->filled('program') && $request->program !== 'all') {
            $query->where('program_id', $request->program);
        }

        // Improved status filtering to ensure only the latest application is considered
        if ($request->filled('status') && $request->status !== 'all') {
            $query->whereHas('applications', function ($subQuery) use ($request) {
                $subQuery->where('id', function ($latestQuery) {
                    $latestQuery->selectRaw('MAX(id)')
                        ->from('applications')
                        ->whereColumn('beneficiary_id', 'beneficiaries.id');
                })->where('status', $request->status);
            });
        }

        // Filter by date range (beneficiary's created_at date)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59',
            ]);
        }

        // Search by beneficiary name
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('surname', 'like', '%' . $request->search . '%')
                    ->orWhere('middle_name', 'like', '%' . $request->search . '%');
            });
        }

        // Fetch paginated results
        $beneficiaries = $query->orderBy('created_at', 'desc')->paginate(5);

        // Append all query parameters to pagination links
        $beneficiaries->appends($request->all());

        // Retrieve programs for the filter dropdown
        $programs = Program::all();

        return view('superadmin.beneficiaries.index', compact('beneficiaries', 'programs'));
    }


    /**
     * Generate reports based on filters.
     */
    public function reports(Request $request)
{
    // Initialize query
    $query = Beneficiary::with([
        'applications' => function ($query) {
            // Eager load only the most recent application for each beneficiary
            $query->whereIn('id', function ($subQuery) {
                $subQuery->selectRaw('MAX(id) as id')
                    ->from('applications')
                    ->groupBy('beneficiary_id');
            });
        },
        'program',
        'socialWorker',
    ]);

    // Filter by program
    if ($request->filled('program') && $request->program !== 'all') {
        $query->where('program_id', $request->program);
    }

    // Improved status filtering to ensure only the latest application is considered
    if ($request->filled('status') && $request->status !== 'all') {
        $query->whereHas('applications', function ($subQuery) use ($request) {
            $subQuery->where('id', function ($latestQuery) {
                $latestQuery->selectRaw('MAX(id)')
                    ->from('applications')
                    ->whereColumn('beneficiary_id', 'beneficiaries.id');
            })->where('status', $request->status);
        });
    }

    // Filter by date range (beneficiary's created_at date)
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('created_at', [
            $request->start_date . ' 00:00:00',
            $request->end_date . ' 23:59:59',
        ]);
    }

    // Search by beneficiary name
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('surname', 'like', '%' . $request->search . '%')
                ->orWhere('middle_name', 'like', '%' . $request->search . '%');
        });
    }

    // Fetch paginated results
    $beneficiaries = $query->orderBy('created_at', 'desc')->paginate(5);

    // Append all query parameters to pagination links
    $beneficiaries->appends($request->all());

    // Retrieve programs for the filter dropdown
    $programs = Program::all();

    return view('superadmin.reports.index', compact('beneficiaries', 'programs'));
}


    /**
     * Generate reports (e.g., export to PDF or CSV).
     */
    public function generateReport()
    {
        $beneficiaries = Beneficiary::all();
        // Add your report generation logic here (e.g., PDF export)
    }
}

@extends("layouts.app")

@section("content")
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>List of Beneficiaries</h1>
    </div>

    <!-- Program, Status, Date Range, and Search Filters -->
    <div class="row mb-6">
        <div class="col-md-12">
            <form action="{{ route("superadmin.beneficiaries.index") }}" method="GET" class="row align-items-end g-2">
                <!-- Program Filter -->
                <div class="col-auto">
                    <label for="program" class="form-label">Filter by Program:</label>
                    <div class="custom-select-wrapper">
                        <select name="program" id="program" class="form-control custom-select-dropdown" onchange="this.form.submit()">
                            <option value="all">All Programs</option>
                            @foreach ($programs as $program)
                            <option value="{{ $program->id }}"
                                {{ request("program") == $program->id ? "selected" : "" }}>
                                {{ $program->name }}
                            </option>
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down dropdown-icon"></i>
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="col-auto">
                    <label for="status" class="form-label">Filter by Status:</label>
                    <div class="custom-select-wrapper">
                        <select name="status" id="status" class="form-control custom-select-dropdown" onchange="this.form.submit()">
                            <option value="all">All Statuses</option>
                            <option value="pending" {{ request("status") == "pending" ? "selected" : "" }}>Pending</option>
                            <option value="approved" {{ request("status") == "approved" ? "selected" : "" }}>Approved</option>
                            <option value="disapproved" {{ request("status") == "disapproved" ? "selected" : "" }}>Disapproved</option>
                            <option value="new" {{ request("status") == "new" ? "selected" : "" }}>New</option>
                            <option value="renew" {{ request("status") == "renew" ? "selected" : "" }}>Renew</option>
                        </select>
                        <i class="fas fa-chevron-down dropdown-icon"></i>
                    </div>
                </div>

                <!-- Start Date Filter -->
                <div class="col-auto">
                    <label for="start_date" class="form-label">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ request("start_date") }}" onchange="this.form.submit()">
                </div>

                <!-- End Date Filter -->
                <div class="col-auto">
                    <label for="end_date" class="form-label">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ request("end_date") }}" onchange="this.form.submit()">
                </div>

                <!-- Search Bar -->
                <div class="col">
                    <label for="search" class="form-label">Search Beneficiary:</label>
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control"
                            value="{{ request("search") }}" placeholder="Enter beneficiary name">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <hr class="my-1">

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Beneficiary Full Name</th>
                    <th>Program</th>
                    <th>Submitted By</th>
                    <th>Date Submitted</th>
                    <th>Status</th>
                    <th>Approver</th>
                    <th>Date Approved/Declined</th>
                    <th>Date Released</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($beneficiaries as $beneficiary)
                <tr>
                    <td>{{ $beneficiary->surname }}, {{ $beneficiary->first_name }}
                        {{ $beneficiary->middle_name }}
                    </td>
                    <td>{{ $beneficiary->program ?? "N/A" }}</td>
                    <td>{{ $beneficiary->socialWorker->name ?? "N/A" }}</td>
                    <td>{{ $beneficiary->created_at->format("F j, Y") ?? "N/A" }}</td>
                    <td>
                        @if($beneficiary->applications->isNotEmpty())
                        @php
                        $latestApplication = $beneficiary->applications->sortByDesc('created_at')->first();
                        @endphp
                        <span class="badge 
                                        @if($latestApplication->status == 'approved')
                                            bg-success
                                        @elseif($latestApplication->status == 'disapproved')
                                            bg-danger
                                        @else
                                            bg-warning
                                        @endif
                                    ">
                            {{ ucfirst($latestApplication->status) }}
                        </span>
                        @else
                        <span class="badge bg-secondary">No Application</span>
                        @endif
                    </td>
                    <td>{{ $beneficiary->applications->first()?->admin->name ?? "-" }}</td>
                    <td>{{ $beneficiary->applications->first()?->approved_date ? \Carbon\Carbon::parse($beneficiary->approved_date)->format("F j, Y") : "-" }}
                    </td>
                    <td>{{ $beneficiary->applications->first()?->date_released ? \Carbon\Carbon::parse($beneficiary->date_released)->format("F j, Y") : "-" }}
                    </td>
                    <td>
                        <a href="{{ route("superadmin.beneficiary.show", ["id" => $beneficiary->id, "program_id" => $beneficiary->program_id]) }}"
                            class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">No beneficiaries found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $beneficiaries->links('pagination::bootstrap-5') }}

    </div>
</div>
@endsection

<style>
    .form-label {
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .my-4 {
        border: 2px solid #000;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .row.align-items-end {
        margin-right: 0;
        margin-left: 0;
    }

    /* Custom Dropdown Styles */
    .custom-select-wrapper {
        position: relative;
    }

    .custom-select-dropdown {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 2.5rem !important;
        background-color: #fff;
        border: 1px solid #ced4da;
        cursor: pointer;
        min-width: 180px;
    }

    .custom-select-dropdown:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        outline: none;
    }

    .dropdown-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #6c757d;
        font-size: 0.875rem;
    }

    /* Table Styling */
    .table-responsive {
        margin-top: 1rem;
    }

    .badge {
        padding: 0.4rem 0.6rem;
        font-size: 0.85rem;
    }
</style>
@extends("layouts.app")

@section("content")
<div class="container">
    <div class="d-flex justify-content-between align-items-center no-print">
        <div>
            <h1>Reports List</h1>
        </div>
    </div>

    <!-- Program, Status, and Search Filters -->
    <div class="row mb-6 no-print">
        <div class="col-md-12">
            <form action="{{ route("superadmin.reports.index") }}" method="GET" class="row align-items-end g-2">
                <div class="col-auto">
                    <label for="status" class="form-label">Filter by Status:</label>
                    <div class="custom-select-wrapper">
                        <select name="status" id="status" class="form-control custom-select-dropdown">
                            <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }}>All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="disapproved" {{ request('status') == 'disapproved' ? 'selected' : '' }}>Disapproved</option>
                            <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                            <option value="renew" {{ request('status') == 'renew' ? 'selected' : '' }}>Renew</option>
                        </select>
                        <i class="fas fa-chevron-down dropdown-icon"></i>
                    </div>
                </div>
                <!-- Program Dropdown Filter -->
                <div class="col-auto">
                    <label for="program" class="form-label">Filter by Program:</label>
                    <div class="custom-select-wrapper">
                        <select name="program" id="program" class="form-control custom-select-dropdown">
                            <option value="all" {{ request('program', 'all') == 'all' ? 'selected' : '' }}>All Programs</option>
                            @foreach ($programs as $program)
                            <option value="{{ $program->id }}" {{ request('program') == $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down dropdown-icon"></i>
                    </div>
                </div>

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

    <hr class="my-3">
    <div class="d-flex justify-content-end no-print">
        <a href="#" onclick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                <path
                    d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
            </svg>
        </a>
    </div>

    <!-- Print Area -->
    <div class="print-area">
        <div class="d-flex align-items-center no-display-print">
            <!-- Logo Section -->
            <div class="col-auto">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="117px" height="auto"
                    class="ml-2 mr-200" class="img-fluid">
            </div>
            <!-- Header Section -->
            <div class="header text-center flex-grow-1 ml-1 mr-0">
                <p class="text-center fs-5 fst-italic mb-1">Republic of the Philippines</p>
                <p class="text-center fs-5 mb-1">PROVINCE OF BUKIDNON</p>
                <p class="text-center fs-5 fw-bold">MUNICIPALITY OF MANOLO FORTICH</p>
                <p class="text-center fs-4 fw-bold my-2">MASTER LIST</p>
            </div>
        </div>
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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($beneficiaries as $beneficiary)
                    <tr>
                        <td>{{ $beneficiary->surname }}, {{ $beneficiary->first_name }}
                            {{ $beneficiary->middle_name }}
                        </td>
                        <td>{{ $beneficiary->program ?? 'N/A' }}</td>
                        <td>{{ $beneficiary->socialWorker->name ?? 'N/A' }}</td>
                        <td>{{ $beneficiary->created_at->format('F j, Y') }}</td>
                        <td>
                            @php
                            $status = $beneficiary->applications->first()->status ?? 'N/A';
                            @endphp
                            <span class="badge 
                                @if($status == 'approved')
                                    bg-success
                                @elseif($status == 'disapproved')
                                    bg-danger
                                @elseif($status == 'pending')
                                    bg-warning text-dark
                                @elseif($status == 'new')
                                    bg-info text-dark
                                @elseif($status == 'renew')
                                    bg-primary
                                @else
                                    bg-secondary
                                @endif
                            ">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td>{{ $beneficiary->applications->first()?->admin->name ?? '-' }}</td>
                        <td>
                            {{ $beneficiary->applications->first()?->approved_date
                    ? \Carbon\Carbon::parse($beneficiary->applications->first()->approved_date)->format('F j, Y')
                    : '-' }}
                        </td>
                        <td>
                            {{ $beneficiary->applications->first()?->date_released
                    ? \Carbon\Carbon::parse($beneficiary->applications->first()->date_released)->format('F j, Y')
                    : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No beneficiaries found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        {{ $beneficiaries->links('pagination::bootstrap-5') }}

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle status change
        document.getElementById('status').addEventListener('change', function() {
            this.form.submit();
        });

        // Handle program change
        document.getElementById('program').addEventListener('change', function() {
            this.form.submit();
        });
    });
</script>

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

    /* Status Badge Styles */
    .badge {
        padding: 0.4rem 0.6rem;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .no-display-print {
        display: none !important;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .print-area,
        .print-area * {
            visibility: visible;
        }

        .print-area {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .no-print {
            display: none !important;
        }

        .no-display-print {
            display: flex !important;
        }
    }
</style>
@endsection
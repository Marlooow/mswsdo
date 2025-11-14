@extends("layouts.app")

@section("content")
<div class="container">
    <div
        class="
    @switch($program->name)
        @case(" Educational Assistance")
        bg-primary
        @break
        @case("Solo Parent")
        bg-success
        @break
        @case("Senior Citizen")
        bg-warning
        @break
        @case("AIFCS")
        bg-danger
        @break
        @default
        bg-secondary
        @endswitch
        rounded-4 pb-2 mb-3 pt-3">
        <h3 class="text-center text-white">{{ $program->name === "AIFCS" ? "AICS" : $program->name }}</h3>
        <h2 class="text-center text-white">Admin Dashboard</h2>
    </div>

    <!-- Card Section -->

    <div class="row">
        <!-- Card 1 -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title fs-1 " style="text-align: center;">{{ $pendingApplications }}</h5>
                    <p class="card-text" style="text-align: center;">New Pending Application</p>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title fs-1 " style="text-align: center;">{{ $approvedApplications }}</h5>
                    <p class="card-text" style="text-align: center;">Approved Application</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title fs-1 " style="text-align: center;">{{ $disapprovedApplications }}</h5>
                    <p class="card-text" style="text-align: center;"> Disapproved Application</p>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title fs-1 " style="text-align: center;">{{ $totalApplications }}</h5>
                    <p class="card-text" style="text-align: center;">Total Application</p>
                </div>
            </div>
        </div>
    </div>

    @if (isset($program))
    <div class="row mb-3">
        <div class="col-md-4">
            <!-- Add any admin-specific action button here if needed -->
        </div>
        <div class="col-md-4">
            <form action="{{ route("admin.dashboard") }}" method="GET" class="form-inline" id="statusFilterForm">
                <div class="custom-select-wrapper w-100">
                    <select name="status" class="form-control custom-select-dropdown" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="pending" {{ request("status") == "pending" ? "selected" : "" }}>Pending</option>
                        <option value="renew" {{ request("status") == "renew" ? "selected" : "" }}>Renew</option>
                        <option value="new" {{ request("status") == "new" ? "selected" : "" }}>New</option>
                        <option value="approved" {{ request("status") == "approved" ? "selected" : "" }}>Approved</option>
                        <option value="disapproved" {{ request("status") == "disapproved" ? "selected" : "" }}>Disapproved</option>
                    </select>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                @if (request("search"))
                <input type="hidden" name="search" value="{{ request("search") }}">
                @endif
            </form>
        </div>
        <div class="col-md-4">
            <form action="{{ route("admin.dashboard") }}" method="GET" class="form-inline justify-content-end">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search beneficiaries..."
                        value="{{ request("search") }}">
                    @if (request("status"))
                    <input type="hidden" name="status" value="{{ request("status") }}">
                    @endif
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @if ($beneficiaries->isNotEmpty())
        <table class="table table-bordered  table-striped table-sm">
            <thead>
                <tr>
                    <th class="name-column">Name</th>
                    <th class="social-worker-column">Submitted By</th>
                    <th class="status-column">Status</th>
                    <th class="date-column">Created Date</th>
                    <th class="applications-column">Total Applications</th>
                    <th class="">Date Released</th>
                    <th class="actions-column">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($beneficiaries as $beneficiary)
                <tr>
                    <td>{{ $beneficiary->surname }}, {{ $beneficiary->first_name }}
                        {{ $beneficiary->middle_name }}
                    </td>
                    <td>{{ $beneficiary->socialWorker->name }}</td>
                    <td>
                        @if($beneficiary->applications->isNotEmpty())
                        @php
                        $latestApplication = $beneficiary->applications->sortByDesc('created_at')->first(); // Get the most recent application
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
                    <td>{{ $beneficiary->created_at->format("F j, Y") }}</td>
                    <td class="text-center">{{ $beneficiary->applications_count }}</td>
                    <td>{{ $beneficiary->applications->first()?->date_released ? \Carbon\Carbon::parse($beneficiary->date_released)->format("F j, Y") : "-" }}
                    </td>
                    <td>
                        <a href="{{ route("admin.beneficiary.show", $beneficiary->id) }}"
                            class="btn btn-primary">View Applications</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $beneficiaries->appends(["search" => request("search"), "status" => request("status")])->links("pagination::bootstrap-4") }}
        </div>
        @else
        <p style="text-align:center; margin-top:15%; font-size:20px;">No beneficiaries found</p>
        @endif
    </div>
    @endif
</div>
@endsection

<style>
    .table-bordered {
        width: 100%;
        border-collapse: collapse;
    }

    .table-bordered th,
    .table-bordered td {
        text-align: center;
        padding: 8px;
    }

    .table-bordered th {
        background-color: #f8f9fa;
    }

    .name-column {
        width: 22%;
    }

    .social-worker-column {
        width: 15%;
    }

    .status-column {
        width: 8%;
    }

    .date-column {
        width: 15%;
    }

    .applications-column {
        width: 10%;
    }

    .actions-column {
        width: 15%;
    }

    .badge {
        padding: 5px 10px;
        font-size: 0.9rem;
    }

    .text-center {
        text-align: center !important;
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
    }

    .custom-select-dropdown:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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
</style>
@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Program Banner -->
    <div class="text-center
        @switch($program->name)
            @case('Educational Assistance') bg-primary @break
            @case('Solo Parent') bg-success @break
            @case('Senior Citizen') bg-warning @break
            @case('AIFCS') bg-danger @break
            @default bg-secondary
        @endswitch
        rounded-4 pb-3 mb-4 pt-3">
        <h3 class="text-white">{{ $program->name }}</h3>
        <h2 class="text-white">Social Worker Dashboard</h2>
    </div>

    <!-- Notifications -->
    <div class="row mb-3">
        @if(session('error'))
        <div class="alert alert-danger col-12">
            {{ session('error') }}
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success col-12">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <!-- Action Buttons -->
    <div class="row mb-3">
        <div class="col-md-3">
            <a href="{{ route('social_worker.form', str_replace(' ', '-', auth()->user()->program->name)) }}" class="btn btn-primary w-100">+ Create Beneficiary</a>
        </div>
        <div class="col-md-2">
            <!-- <a href="{{ route('social_worker.showBatchRelease') }}" class="btn btn-success w-100">Manage Beneficiary Release</a> -->
        </div>

        <!-- Filter by Status -->
        <div class="col-md-2 col-sm-2 mb-2 mb-md-0">
            <form action="{{ route('social_worker.index') }}" method="GET" id="statusFilterForm">
                <div class="custom-select-wrapper">
                    <select name="status" id="status" class="form-select custom-select-dropdown" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="disapproved" {{ request('status') == 'disapproved' ? 'selected' : '' }}>Disapproved</option>
                    </select>
                </div>
                @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
            </form>
        </div>

        <!-- Search Beneficiaries -->
        <div class="col-md-5">
            <form action="{{ route('social_worker.index') }}" method="GET" class="form-inline justify-content-end">
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

    <!-- Beneficiaries Table -->
    <div class="row ">
        @if($beneficiaries->isNotEmpty())
        <div class="col-12 ">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th class="name-column">Name</th>
                        <th class="status-column">Application Status</th>
                        <th class="date-column">Created Date</th>
                        <th class="noa-column">Total Applications</th>
                        <th class="actions-column">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($beneficiaries as $beneficiary)
                    <tr>
                        <td>{{ $beneficiary->surname }}, {{ $beneficiary->first_name }} {{ $beneficiary->middle_name }}</td>
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
                            <span class="badge bg-secondary">Pending</span>
                            @endif
                        </td>

                        <td>{{ $beneficiary->created_at->format('F j, Y') }}</td>
                        <td class="text-center">{{ $beneficiary->applications_count }}</td>
                        <td>
                            <a href="{{ route('social_worker.beneficiaries.show', $beneficiary->id) }}" class="btn btn-primary btn-sm">View Applications</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $beneficiaries->appends(['search' => request('search'), 'status' => request('status')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @else
        <div class="col-12 text-center mt-5">
            <p class="font-size-lg">No beneficiaries found</p>
        </div>
        @endif
    </div>
</div>

@endsection

<style>
    /* Ensure consistent table column widths */
    .table-fixed {
        table-layout: fixed;
        width: 100%;
    }

    .table-fixed th,
    .table-fixed td {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .table-fixed .name-column {
        width: 45%;
    }

    .table-fixed .program-column {
        width: 15%;
    }

    .table-fixed .status-column {
        width: 5%;
    }

    .table-fixed .date-column {
        width: 20%;
    }

    .table-fixed .actions-column {
        width: 5%;
    }

    .table-fixed .noa-column {
        width: 20%;
    }

    .text-center {
        text-align: center !important;
    }
</style>
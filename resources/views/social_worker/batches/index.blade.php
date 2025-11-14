@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="text-center">Beneficiary Release Management</h1>

    {{-- Summary Panel --}}
    <div class="row text-center my-4">
        {{-- Total Applications --}}
        <div class="col-md-3">
            <div class="card shadow-sm text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Applications</h5>
                    <p class="fs-4">{{ $totalApplications }}</p>
                </div>
            </div>
        </div>

        {{-- Unclaimed Applications --}}
        <div class="col-md-3">
            <div class="card shadow-sm text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Unclaimed Applications</h5>
                    <p class="fs-4">{{ $unclaimedApplications }}</p>
                </div>
            </div>
        </div>

        {{-- Claimed Applications --}}
        <div class="col-md-3">
            <div class="card shadow-sm text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Claimed Applications</h5>
                    <p class="fs-4">{{ $claimedApplications }}</p>
                </div>
            </div>
        </div>

        {{-- Total Released Amount --}}
        <div class="col-md-3">
            <div class="card shadow-sm text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Released Amount</h5>
                    <p class="fs-4">₱{{ number_format($totalReleasedAmount, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tab Navigation --}}
    <ul class="nav nav-tabs" id="beneficiaryTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="unbatched-tab" data-bs-toggle="tab" data-bs-target="#unbatched" type="button" role="tab">Unbatched Applications</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="batch-released-tab" data-bs-toggle="tab" data-bs-target="#batch-released" type="button" role="tab">Batch-Released Applications</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="individual-released-tab" data-bs-toggle="tab" data-bs-target="#individual-released" type="button" role="tab">Individually Released Applications</button>
        </li>
    </ul>

    <div class="tab-content" id="beneficiaryTabsContent">
        {{-- Tab 1: Unbatched Applications --}}
        <div class="tab-pane fade show active" id="unbatched" role="tabpanel">
            <div class="card mt-4 shadow">
                <div class="card-header bg-primary text-white">
                    <h5>Select Unbatched Applications</h5>
                </div>
                <div class="card-body">
                    {{-- Batch Form --}}
                    <form action="{{ route('social_worker.manageRelease') }}" method="POST" id="batchForm">
                        @csrf
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label for="batchName" class="form-label">Batch Name</label>
                                <input type="text" id="batchName" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="releaseDate" class="form-label">Release Date</label>
                                <input type="date" id="releaseDate" name="release_date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="remarks" class="form-label">Remarks</label>
                                <input type="text" id="remarks" name="remarks" class="form-control">
                            </div>
                            <input type="hidden" name="social_worker_id" value="{{ auth()->id() }}">
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary w-100" onclick="return validateBatchCreation()">Create Batch</button>
                            </div>
                        </div>

                        {{-- Unbatched Applications Table --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input type="checkbox" id="select-all" class="form-check-input">
                                                <label class="form-check-label" for="select-all">Select All</label>
                                            </div>
                                        </th>
                                        <th>Beneficiary Name</th>
                                        <th>Program</th>
                                        <th>Status</th>
                                        <th>Claimed Amount</th>
                                        <th>Claim Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($unbatchedApplications as $application)
                                    <tr>
                                        {{-- Checkbox for Batch --}}
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" name="selected_beneficiaries[]" value="{{ $application->id }}" class="form-check-input beneficiary-checkbox">
                                            </div>
                                        </td>

                                        {{-- Beneficiary Name --}}
                                        <td>{{ $application->beneficiary->name ?? 'N/A' }}</td>

                                        {{-- Program Name --}}
                                        <td>{{ $application->program->name ?? 'N/A' }}</td>

                                        {{-- Status --}}
                                        <td>
                                            <span class="badge bg-warning">Unclaimed</span>
                                        </td>

                                        {{-- Claimed Amount (Only for Financial Programs) --}}
                                        <td>
                                            @if($application->program && $application->program->program_type === 'financial')
                                            <input type="number" name="claimed_amount" form="releaseForm{{ $application->id }}" class="form-control claimed-amount-input" placeholder="Enter Amount" step="0.01">
                                            @else
                                            N/A
                                            @endif
                                        </td>

                                        {{-- Claim Status Dropdown --}}
                                        <td>
                                            <select name="claim_status" form="releaseForm{{ $application->id }}" class="form-select">
                                                <option value="Unclaimed">Unclaimed</option>
                                                <option value="Claimed">Claimed</option>
                                            </select>
                                        </td>

                                        {{-- Actions: Individual Release --}}
                                        <td>
                                            <form action="{{ route('social_worker.releaseBeneficiary', $application->id) }}" method="POST" id="releaseForm{{ $application->id }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to release this beneficiary?')">
                                                    Release
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No unbatched applications available</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Tab 2: Batch-Released Applications --}}
        <div class="tab-pane fade" id="batch-released" role="tabpanel">
            <div class="card mt-4 shadow">
                <div class="card-header bg-success text-white">
                    <h5>Batch-Released Applications</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Batch Name</th>
                                    <th>Beneficiary Name</th>
                                    <th>Program</th>
                                    <th>Status</th>
                                    <th>Claimed Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($batchReleasedApplications as $application)
                                <tr>
                                    <td>{{ $application->batch->name ?? 'N/A' }}</td>
                                    <td>{{ $application->beneficiary->name ?? 'N/A' }}</td>
                                    <td>{{ $application->program->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($application->claim_status === 'Claimed')
                                        <span class="badge bg-success">Claimed</span>
                                        @else
                                        <span class="badge bg-warning">Unclaimed</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($application->program && $application->program->program_type === 'financial')
                                        ₱{{ number_format($application->claimed_amount ?? 0, 2) }}
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No batch-released applications</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab 3: Individually Released Applications --}}
        <div class="tab-pane fade" id="individual-released" role="tabpanel">
            <div class="card mt-4 shadow">
                <div class="card-header bg-info text-white">
                    <h5>Individually Released Applications</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Beneficiary Name</th>
                                    <th>Program</th>
                                    <th>Status</th>
                                    <th>Claimed Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($individuallyReleasedApplications as $application)
                                <tr>
                                    <td>{{ $application->beneficiary->name ?? 'N/A' }}</td>
                                    <td>{{ $application->program->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($application->claim_status === 'Claimed')
                                        <span class="badge bg-success">Claimed</span>
                                        @else
                                        <span class="badge bg-warning">Unclaimed</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($application->program && $application->program->program_type === 'financial')
                                        ₱{{ number_format($application->claimed_amount ?? 0, 2) }}
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No individually released applications</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('select-all');
        const beneficiaryCheckboxes = document.querySelectorAll('.beneficiary-checkbox');

        selectAll.addEventListener('change', function() {
            beneficiaryCheckboxes.forEach(checkbox => checkbox.checked = selectAll.checked);
        });

        function validateBatchCreation() {
            const selectedBeneficiaries = document.querySelectorAll('.beneficiary-checkbox:checked');
            if (selectedBeneficiaries.length === 0) {
                alert('Please select at least one beneficiary for the batch');
                return false;
            }
            return true;
        }
    });
</script>
@endpush
@endsection
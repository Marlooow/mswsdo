@extends("layouts.app")

@section("content")
<div class="container-fluid">
    <div class="row">
        <!-- Beneficiary Applications List Section -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $beneficiary->surname }}, {{ $beneficiary->first_name }} {{ $beneficiary->middle_name }}'s Applications</h4>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @forelse ($applications as $application)
                        <a href="{{ route("superadmin.beneficiary.show", ["id" => $beneficiary->id, "program_id" => $beneficiary->program_id, "application_id" => $application->id]) }}"
                            class="list-group-item list-group-item-action {{ $selectedApplication && $selectedApplication->id === $application->id ? "active" : "" }}">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Application #{{ $applications->count() - $loop->index }}</h6>
                                <small>
                                    <span class="badge 
                                        @if($application->status === 'approved')
                                            bg-success
                                        @elseif($application->status === 'disapproved')
                                            bg-danger
                                        @else
                                            bg-warning text-dark
                                        @endif
                                    ">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </small>
                            </div>
                            <p class="mb-1">Submitted: {{ $application->created_at->format("M d, Y") }}</p>
                            @if ($application->status === "approved" && $application->approval_date)
                            <p class="mb-1">Date Approved:
                                {{ \Carbon\Carbon::parse($application->approval_date)->format("M d, Y") }}
                            </p>
                            @endif
                        </a>
                        @empty
                        <div class="list-group-item">
                            <p class="text-muted mb-0">No applications found.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Selected Application Form Section -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Application Details</h4>
                    @if ($selectedApplication)
                    <span class="badge 
                        @if($selectedApplication->status === 'approved')
                            bg-success
                        @elseif($selectedApplication->status === 'disapproved')
                            bg-danger
                        @else
                            bg-warning text-dark
                        @endif
                    ">
                        {{ ucfirst($selectedApplication->status) }}
                    </span>
                    @endif
                </div>
                <div class="card-body">
                    @if ($selectedApplication)
                        @if (isset($view) && $view && isset($formData) && $formData)
                            {{-- Include the specific application form view --}}
                            @include($view, [
                                "formData" => $formData,
                                "application" => $selectedApplication,
                                "beneficiary" => $beneficiary,
                            ])
                        @else
                            <div class="alert alert-warning" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> No form data available for this application.
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Select an application from the list to view details</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set current date for date issuance field if it exists
        const dateIssuanceField = document.getElementById('dateIssuance');
        if (dateIssuanceField && !dateIssuanceField.value) {
            dateIssuanceField.value = new Date().toISOString().split('T')[0];
        }
    });
</script>
@endpush

<style>
    .list-group-item.active {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    .list-group-item.active:hover {
        background-color: #0d6efd;
    }

    .card-header h4 {
        color: #2c3e50;
    }

    .badge {
        padding: 0.4rem 0.6rem;
        font-size: 0.85rem;
    }
</style>
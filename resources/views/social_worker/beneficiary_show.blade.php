@extends("layouts.app")

@section("content")
<div class="container-fluid px-4">
    <div class="row">
        <!-- Beneficiary Applications List Section -->
        <div class="col-md-4 remove-display-print">
            <div class="card shadow-sm">
                <div class="card-header bg-white remove-display-print">
                    @if (!$canApply)
                    <small class="text-muted">You can only submit a new application every 3 months.</small>
                    @endif
                    <h4 class="mb-0">{{ $beneficiary->surname }}, {{ $beneficiary->first_name }} {{ $beneficiary->middle_name }}'s
                        Applications</h4>
                </div>
                <div class="card-body remove-display-print">
                    <div class="list-group ">
                        @foreach ($applications as $application)
                        <a href="{{ route("social_worker.beneficiaries.show", ["beneficiary_id" => $beneficiary->id, "application_id" => $application->id]) }}"
                            class="list-group-item list-group-item-action {{ $selectedApplication && $selectedApplication->id === $application->id ? "active" : "" }}">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Application # {{ $applications->count() - $loop->index }}</h6>
                                <small>
                                    <span
                                        class="badge bg-{{ $application->status === "approved" ? "success" : ($application->status === "disapproved" ? "danger" : "warning") }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </small>
                            </div>
                            <p class="mb-1">Submitted: {{ $application->created_at->format("M d, Y") }}</p>
                            <p class="mb-1">Submitted by: {{ $application->updatedBySocialWorker->name }}</p>
                            @switch($application->status)
                            @case("approved")
                            <p class="mb-1">Date Approved:
                                {{ \Carbon\Carbon::parse($application->approval_date)->format("M d, Y") }}
                            </p>
                            <p class="mb-1">Approved By: {{ $approverName }}</p>
                            @break

                            @case("pending")
                            @break

                            @case("disapproved")
                            <p class="mb-1">Date Disapproved:
                                {{ \Carbon\Carbon::parse($application->approval_date)->format("M d, Y") }}
                            </p>
                            @break

                            @default
                            {{-- Optionally handle any unexpected status values --}}
                            @endswitch
                        </a>
                        @endforeach
                    </div>
                    <!-- Add New Application Button -->
                    <div class="mt-3">
                        <button id="addNewApplicationBtn" class="btn btn-primary"
                            data-url="{{ route('social_worker.create', [
        'program_name' => str_replace(' ', '-', auth()->user()->program->name ?? ''), 
        'beneficiary_id' => $beneficiary->id
    ]) }}"
                            {{ !$canApply ? "disabled" : "" }}>
                            + Add New Application
                        </button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Selected Application Form Section -->
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Application Details</h4>

                    @if ($selectedApplication && $selectedApplication->status === "approved" && $isAdmin)
                    <div>
                        <button type="button" class="btn btn-primary" id="printButton"
                            data-beneficiary-id="{{ $beneficiary->id }}"
                            data-application-id="{{ $selectedApplication->id }}">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" class="btn btn-success ms-2" id="savePdfButton">
                            <i class="fas fa-file-pdf"></i> Save as PDF
                        </button>
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    @if ($selectedApplication)
                    @if ($view && $formData)
                    @include($view, [
                    "formData" => $formData,
                    "beneficiary" => $selectedApplication,
                    ])
                    @else
                    <p>No form data available.</p>
                    @endif
                    @else
                    <p>No Application Selected</p>
                    @endif
                </div>
            </div>

            <!-- Status Update Section -->
            @if ($isAdmin && $selectedApplication)
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Update Application Status</h5>
                </div>
                <div class="card-body">
                    <form
                        action="{{ route("admin.beneficiary.update.status", [
                                    "beneficiary" => $beneficiary->id,
                                    "application" => $selectedApplication->id,
                                ]) }}"
                        method="POST">
                        @csrf
                        @method("PUT")

                        <!-- Hidden input for program -->
                        <input type="hidden" name="program"
                            value="{{ strtolower(str_replace(" ", "", $beneficiary->program)) }}">

                        <div class="row">
                            @if (strtolower(str_replace(" ", "", $beneficiary->program)) === "soloparent")
                            <!-- Solo Parent Fields -->
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="idCardNumber"><strong>Solo Parent Identification Card
                                                Number:</strong></label>
                                        <input type="text" class="form-control" id="idCardNumber"
                                            name="idCardNumber" value="{{ old("idCardNumber") }}" required>
                                        @error("idCardNumber")
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dateIssuance"><strong>Date Issuance:</strong></label>
                                        <input type="date" class="form-control" id="dateIssuance" name="dateIssuance" required
                                            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                        @error("dateIssuance")
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            @endif

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="approval_status" class="form-label">Status:</label>
                                    <select class="form-select @error(" approval_status") is-invalid @enderror"
                                        id="approval_status" name="approval_status">
                                        @switch(strtolower(str_replace(' ', '', $beneficiary->program ?? '')))
                                        @case("aifcs")
                                        <option value="approved"
                                            {{ $selectedApplication->status === "approved" ? "selected" : "" }}>
                                            Approved</option>
                                        <option value="disapproved"
                                            {{ $selectedApplication->status === "disapproved" ? "selected" : "" }}>
                                            Disapproved</option>
                                        @break

                                        @case("soloparent")
                                        <option value="new"
                                            {{ $selectedApplication->status === "new" ? "selected" : "" }}>New
                                        </option>
                                        <option value="renew"
                                            {{ $selectedApplication->status === "Renew" ? "selected" : "" }}>Renew
                                        </option>
                                        <option value="approved"
                                            {{ $selectedApplication->status === "approved" ? "selected" : "" }}>
                                            Approved</option>
                                        <option value="disapproved"
                                            {{ $selectedApplication->status === "disapproved" ? "selected" : "" }}>
                                            Disapproved</option>
                                        @break

                                        @case("seniorcitizen")
                                        <option value="approved"
                                            {{ $selectedApplication->status === "approved" ? "selected" : "" }}>
                                            Approved</option>
                                        <option value="disapproved"
                                            {{ $selectedApplication->status === "disapproved" ? "selected" : "" }}>
                                            Disapproved</option>
                                        @break

                                        @default
                                        <option value="approved"
                                            {{ $selectedApplication->status === "approved" ? "selected" : "" }}>
                                            Approved</option>
                                        <option value="disapproved"
                                            {{ $selectedApplication->status === "disapproved" ? "selected" : "" }}>
                                            Disapproved</option>
                                        @endswitch
                                    </select>

                                    @error("approval_status")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="remarks" class="form-label">Remarks:</label>
                                    <textarea class="form-control @error(" remarks") is-invalid @enderror" id="remarks" name="remarks" rows="3"
                                        placeholder="Add any additional notes here...">{{ old("remarks", $selectedApplication->remarks) }}</textarea>
                                    @error("remarks")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                            <a href="{{ route("admin.dashboard") }}" class="btn btn-secondary ms-2">Back to
                                Dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

<style>
    .no-display {
        visibility: hidden;
    }

    .remove-display-print-view {
        display: none !important;
    }

    /* Make the right column scrollable */
    .col-md-8 {
        max-height: 100vh;
        /* Full viewport height */
        overflow-y: auto;
        /* Enable vertical scrolling */
    }

    /* Remove any overflow from cards and their children to prevent internal scrollbars */
    .col-md-8 .card,
    .col-md-8 .card-body,
    .col-md-8 .card-body * {
        overflow: visible !important;
        max-height: none !important;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .printable-area,
        .printable-area * {
            visibility: visible;
        }

        .printable-area {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .printable-area>.no-print {
            visibility: hidden !important;
        }

        .no-print {
            visibility: hidden;
        }

        .remove-display-print {
            display: none !important;
        }

        .remove-display-print-view {
            display: block !important;
        }

        /* Remove scrolling for print */
        .col-md-8 {
            max-height: none;
            overflow-y: visible;
        }
    }
</style>

<script src="/assets/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const printButton = document.getElementById('printButton');

        if (printButton) {
            printButton.addEventListener('click', function() {
                const beneficiaryId = this.getAttribute('data-beneficiary-id');
                const applicationId = this.getAttribute('data-application-id');
                const localDate = new Date();
                const year = localDate.getFullYear();
                const month = String(localDate.getMonth() + 1).padStart(2, '0'); // Month is 0-based
                const day = String(localDate.getDate()).padStart(2, '0'); // Pad single digit days
                const localDateString = `${year}-${month}-${day}`;

                if (beneficiaryId && applicationId) {
                    fetch('/admin/beneficiary/update/date_released', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                beneficiary_id: beneficiaryId,
                                application_id: applicationId,
                                date_released: localDateString
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Failed to update date released');
                            }
                            return response.json();
                        })
                        .then(data => {
                            window.print();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert(
                                'An error occurred while preparing to print. The document will still print.'
                            );
                            window.print();
                        });
                } else {
                    console.error("Beneficiary ID or Application ID not found");
                }
            });
        } else {
            console.error("Print button not found");
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const savePdfButton = document.getElementById('savePdfButton');

        if (savePdfButton) {
            savePdfButton.addEventListener('click', function() {
                // Get the printable content
                const printableContent = document.querySelector('.printable-area');

                if (printableContent && typeof html2canvas !== 'undefined' && window.jspdf) {
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF({
                        orientation: 'portrait',
                        unit: 'mm',
                        format: 'a4'
                    });

                    const originalVisibility = printableContent.style.visibility;
                    printableContent.style.visibility = 'visible';

                    html2canvas(printableContent, {
                        logging: true, // Enable detailed logging for debugging
                        useCORS: true, // Allow CORS for cross-origin images
                        scale: 2, // Increase scale for better resolution
                        dpi: 300 // Higher DPI for higher quality
                    }, function(canvas) {
                        // Check if the canvas is generated
                        if (!canvas) {
                            console.error('Failed to generate canvas.');
                            alert('Failed to generate content for PDF. Check the console for details.');
                            return;
                        }


                        const imgData = canvas.toDataURL('image/png');

                        const imgProps = doc.getImageProperties(imgData);
                        const pdfWidth = doc.internal.pageSize.getWidth();
                        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                        doc.addImage(imgData, 'PNG', 10, 10, pdfWidth - 20, pdfHeight - 20);

                        const beneficiaryName = document.querySelector('.card-header h4')?.textContent.trim() || 'Application';
                        const currentDate = new Date().toISOString().split('T')[0];
                        const filename = `${beneficiaryName}_application_${currentDate}.pdf`;

                        doc.save(filename);
                    });
                } else {
                    console.error('PDF generation requirements not met:', {
                        printableContent: !!printableContent,
                        html2canvasLoaded: typeof html2canvas !== 'undefined',
                        jspdfLoaded: !!window.jspdf
                    });
                    alert('Unable to generate PDF. Check browser console for details.');
                }
            });
        }
    });

    document.addEventListener("DOMContentLoaded", function() {

        const btn = document.getElementById("addNewApplicationBtn");

        if (!btn) {
            console.log("❌ Button not found in DOM");
            return;
        }

        console.log("🔍 Button found. Disabled = ", btn.disabled);

        btn.addEventListener("click", function(e) {
            e.preventDefault();

            console.log("🟢 Button clicked!");

            if (btn.disabled) {
                console.log("❌ Button is disabled. Cannot proceed.");
                return;
            }

            let url = btn.dataset.url;

            console.log("➡ Redirecting to URL:", url);

            // do the redirect
            window.location.href = url;
        });

    });
</script>
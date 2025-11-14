<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @foreach ($application as $applications)
    <title>{{ $formData['surname'] }}, {{ $formData['first_name'] }} {{ $formData['middle_name'] }} - Application # {{ $loop->index + 1 }}</title>
    @endforeach
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Reset some bootstrap defaults for compact layout */
        .container {
            max-width: 100%;
            padding: 10px 15px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            /* Reduced base font size */
            line-height: 1.3;
            /* Tightened line height */
        }

        /* Compact header */
        .header-section {
            margin-bottom: 15px;
        }

        .header-section img {
            width: 60px;
            /* Smaller logo */
            margin-bottom: 5px;
        }

        .header-section h5 {
            font-size: 14px;
            margin-bottom: 2px;
        }

        .header-section p {
            margin-bottom: 2px;
            font-size: 11px;
        }

        .header-section h2 {
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 10px;
        }



        /* Section titles */
        .section-title {
            background-color: #f8f9fa;
            padding: 4px 8px;
            margin: 10px 0 5px 0;
            font-size: 12px;
            font-weight: bold;
        }

        /* Form groups */
        .form-group {
            margin-bottom: 8px;
        }

        .form-group label {
            margin-bottom: 2px;
            font-size: 11px;
        }

        /* Table styles */
        .table {
            margin-bottom: 10px;
        }

        .table th,
        .table td {
            padding: 4px;
            font-size: 10px;
            vertical-align: middle;
        }

        /* Certification text */
        .certification-text {
            font-size: 9px;
            margin: 15px 0;
            line-height: 1.2;
        }

        /* Signature section */
        .signature-section {
            margin-top: 20px;
            display: flex;
            /* Use flexbox to align items */
            justify-content: space-between;
            /* Space between the two sections */
        }

        .signature-container {
            display: flex;
            /* Use flexbox for the individual containers */
            flex-direction: column;
            /* Stack items vertically */
            align-items: flex-start;
            /* Align to the start */
            width: 100%;
            /* Full width for each column */
        }

        .signature-line {
            white-space: nowrap;
            /* Prevent text from wrapping */
        }


        /* Additional Information checkboxes */
        .form-check {
            display: inline;
            margin-right: 15px;
            font-size: 10px;
        }

        .form-check-input {
            margin-top: 2px;
        }

        /* Row spacing */
        .row {
            margin-bottom: 5px;
        }

        /* Print specific styles */
        @media print {
            .container {
                width: 100%;
                max-width: none;
                margin: 0;
                padding: 5px;
            }

            /* Ensure page breaks don't occur within sections */
            h2,
            h4,
            .section-title {
                page-break-after: avoid;
            }

            .table {
                page-break-inside: avoid;
            }

            /* Minimize margins for printing */
            @page {
                margin: 0.5cm;
            }
        }

        /* Utility classes for spacing */
        .mt-2 {
            margin-top: 0.3rem !important;
        }

        .mb-2 {
            margin-bottom: 0.3rem !important;
        }

        .py-2 {
            padding-top: 0.3rem !important;
            padding-bottom: 0.3rem !important;
        }

        .px-2 {
            padding-left: 0.3rem !important;
            padding-right: 0.3rem !important;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Header -->
        <div class="header-section" style="text-align: center;">
            <img src="{{ asset('images/logo.png') }}" width="100ox" height="auto" class="img-fluid">
            <h5 class="font-weight-bold">Republic of the Philippines</h5>
            <p class="mb-1">Municipal Social Welfare and Development Office</p>
            <p>Manolo Fortich, Bukidnon/Region 10</p>
            <h2 class="mt-4 font-weight-bold">APPLICATION FORM FOR SOLO PARENT</h2>
        </div>

        <!-- Identifying Information -->
        <div class="section-title">I. IDENTIFYING INFORMATION</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Full Name:</label>
                    <div>{{ $formData['first_name'] }} {{ $formData['middle_name'] }} {{ $formData['surname'] }}</</</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name Extension:</label>
                    <div>{{ $formData['name_extension'] }}</div>
                </div>
            </div>
            <!-- Continue with other fields in the same pattern -->
            <div class="col-md-4">
                <div class="form-group">
                    <label>Age:</label>
                    <div>{{ $formData['age'] }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Sex:</label>
                    <div>{{ $formData['sex'] }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Date of Birth:</label>
                    <div>{{ $formData['dob'] }}</div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-4">
            <label class="font-weight-bold">Additional Information:</label>
            <div class="d-flex gap-4">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" disabled
                        {{ isset($formData['pantawid_beneficiary']) && $formData['pantawid_beneficiary'] ? 'checked' : '' }}>
                    <label class="form-check-label">Pantawid Beneficiary</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" disabled
                        {{ isset($formData['indigenous_person']) && $formData['indigenous_person'] ? 'checked' : '' }}>
                    <label class="form-check-label">Indigenous Person</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" disabled
                        {{ isset($formData['lgbtq_plus']) && $formData['lgbtq_plus'] ? 'checked' : '' }}>
                    <label class="form-check-label">LGBTQ+</label>
                </div>
            </div>
        </div>

        <!-- Family Composition -->
        <div class="section-title">II. FAMILY COMPOSITION</div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Relationship</th>
                        <th>Age</th>
                        <th>Birthday</th>
                        <th>Civil Status</th>
                        <th>Educational Attainment</th>
                        <th>Occupation</th>
                        <th>Monthly Income</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formData['family_composition'] as $member)
                    <tr>
                        <td>{{ $member['name'] }}</td>
                        <td>{{ $member['relationship'] }}</td>
                        <td>{{ $member['age'] }}</td>
                        <td>{{ $member['birthdate'] }}</td>
                        <td>{{ $member['civil_status'] }}</td>
                        <td>{{ $member['educational_attainment'] }}</td>
                        <td>{{ $member['occupation'] }}</td>
                        <td>{{ $member['monthly_income'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Classification Section -->
        <div class="section-title">III. Classification/Circumstances of being a solo parent</div>
        <div class="mb-4">{{ $formData['classification_circumstances'] }}</div>

        <!-- Needs/Problems Section -->
        <div class="section-title">IV. Needs/Problems of being a solo parent</div>
        <div class="mb-4">{{ $formData['needs_problems'] }}</div>

        <!-- Emergency Contact -->
        <div class="section-title">V. IN CASE OF EMERGENCY</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name:</label>
                    <div>{{ $formData['emergency_contact']['name'] }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Relationship:</label>
                    <div>{{ $formData['emergency_contact']['relationship'] }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Address:</label>
                    <div>{{ $formData['emergency_contact']['address'] }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Contact Number:</label>
                    <div>{{ $formData['emergency_contact_number'] }}</div>
                </div>
            </div>
        </div>

        <!-- Certification -->
        <div class="certification-text">
            <div class="form-check">
                <label class="form-check-label" for="certification">
                    I hereby certify that the information given above are true and correct. I further understand that any misrepresentation
                    that I may have made will subject me to criminal and civil liabilities provided for by existing laws. In addition,
                    I hereby give my consent to share the information above to the member agencies of the Inter-Agency Coordinating and
                    Monitoring Committee on solo parents.
                </label>
            </div>
        </div>

        <!-- Signature Section -->
        <div class="row signature-section">
            <div class="col-md-6 signature-container">
                <div class="signature-line">
                    {{ $formData['full_name'] }}
                </div>
                <div>Signature / Thumbmark over Printed Name</div>
            </div>
            <div class="col-md-6 signature-container">
                <div class="signature-line">
                    {{ \Carbon\Carbon::parse($beneficiary->created_at)->format('F j, Y') }}
                </div>
                <div>Date of Registration</div>
            </div>
        </div>

    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solo Parent Application Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .input-item {
            flex: 1;
            margin-right: 20px;
        }

        .input-line {
            border-bottom: 1px solid black;
            display: inline-block;
            width: 100%;
            padding: 0 5px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            border-bottom: 2px solid black;
            padding-bottom: 5px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid black;
            padding: 5px;
        }

        .footer-section {
            margin-top: 30px;
        }

        .certification-text {
            text-align: justify;
            margin-bottom: 30px;
        }

        .footer-section {
            margin-top: 30px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 50px;
        }

        .signature-block {
            width: 45%;
            text-align: center;
        }

        .signature-line {
            border-bottom: 1px solid black;
            margin-bottom: 10px;
            padding: 5px 0;
            min-height: 25px;
        }

        .status-section {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .status-options {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .status-option {
            display: flex;
            align-items: center;
        }

        .checkbox-group {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="header">
        <strong>ANNEX B (2023)</strong><br>
        Republic of the Philippines<br>
        Municipal Social Welfare and Development Office<br>
        Manolo Fortich, Bukidnon/Region 10<br>
        <h4>APPLICATION FORM FOR SOLO PARENT</h4>
    </div>

    <div class="section">
        <h5 class="section-title">I. IDENTIFYING INFORMATION</h5>

        <div class="input-row">
            <div class="input-item">
                Full Name: <span class="input-line">{{ $formData["first_name"] }} {{ $formData["middle_name"] }}
                    {{ $formData["surname"] }}
                    {{ $formData["name_extension"] && $formData["name_extension"] !== "N/A" ? " " . $formData["name_extension"] : "" }}</span>
            </div>
            <div class="input-item">
                Age: <span class="input-line">{{ $formData["age"] }}</span>
            </div>
        </div>

        <div class="input-row">
            <div class="input-item">
                Sex: <span class="input-line">{{ $formData["sex"] }}</span>
            </div>
            <div class="input-item">
                Date of Birth: <span class="input-line">{{ $formData["dob"] }}</span>
            </div>
        </div>

        <div class="input-row">
            <div class="input-item">
                Place of Birth: <span class="input-line">{{ $formData["place_of_birth"] }}</span>
            </div>
            <div class="input-item">
                Address: <span class="input-line">{{ $formData["address"] }}</span>
            </div>
        </div>

        <div class="checkbox-group">
            <div>Pantawid Beneficiary? ____Y ____N</div>
            <div>Indigenous Person? ____Y ____N</div>
            <div>LGBTQ+? ____Y ____N</div>
        </div>
    </div>

    <div class="section">
        <h5 class="section-title">II. FAMILY COMPOSITION</h5>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Relationship</th>
                    <th>Age</th>
                    <th>Birthday</th>
                    <th>Civil Status</th>
                    <th>Education</th>
                    <th>Occupation</th>
                    <th>Monthly Income</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formData["family_composition"] as $member)
                    <tr>
                        <td>{{ $member["name"] }}</td>
                        <td>{{ $member["relationship"] }}</td>
                        <td>{{ $member["age"] }}</td>
                        <td>{{ $member["birthdate"] }}</td>
                        <td>{{ $member["civil_status"] }}</td>
                        <td>{{ $member["educational_attainment"] }}</td>
                        <td>{{ $member["occupation"] }}</td>
                        <td>{{ $member["monthly_income"] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h5 class="section-title">III. Classification of Solo Parent</h5>
        <div class="input-line" style="height: 50px;">{{ $formData["classification_circumstances"] }}</div>
    </div>

    <div class="section">
        <h5 class="section-title">IV. Needs/Problems as a Solo Parent</h5>
        <div class="input-line" style="height: 50px;">{{ $formData["needs_problems"] }}</div>
    </div>

    <div class="section">
        <h5 class="section-title">V. Emergency Contact</h5>

        <div class="input-row">
            <div class="input-item">
                Name: <span class="input-line">{{ $formData["emergency_contact"]["name"] ?? "" }}</span>
            </div>
            <div class="input-item">
                Relationship: <span
                    class="input-line">{{ $formData["emergency_contact"]["relationship"] ?? "" }}</span>
            </div>
        </div>

        <div class="input-row">
            <div class="input-item">
                Address: <span class="input-line">{{ $formData["emergency_contact"]["address"] ?? "" }}</span>
            </div>
            <div class="input-item">
                Contact Number: <span class="input-line">{{ $formData["emergency_contact_number"] ?? "" }}</span>
            </div>
        </div>
    </div>

    <div class="footer-section">
        <div class="certification-text">
            I hereby certify that the information given above are true and correct. I understand that any
            misinterpretation will subject me to criminal and civil liabilities. I give consent to share this
            information with the Inter-Agency Coordinating and Monitoring Committee on solo parents.
        </div>

        <div class="signature-section">
            <div class="signature-block">
                <div class="signature-line">{{ $formData["first_name"] }} {{ $formData["middle_name"] }}
                    {{ $formData["surname"] }}{{ $formData["name_extension"] && $formData["name_extension"] !== "N/A" ? " " . $formData["name_extension"] : "" }}
                </div>
                Signature/Thumbmark over Printed Name
            </div>
            <div class="signature-block">
                <div class="signature-line">{{ \Carbon\Carbon::parse($beneficiary->created_at)->format("F j, Y") }}
                </div>
                Date
            </div>
        </div>
    </div>

    <div class="section">
        <h5 class="section-title">FOR OFFICE USE ONLY</h5>

        <div class="status-section">
            <div>STATUS:</div>
            <div class="status-options">
                <div class="status-option">
                    <input type="radio" name="status" value="approved"
                        @if ($beneficiary->status == "approved") checked @endif disabled> Approved
                </div>
                <div class="status-option">
                    <input type="radio" name="status" value="new" @if ($beneficiary->status == "new") checked @endif
                        disabled> New
                </div>
                <div class="status-option">
                    <input type="radio" name="status" value="disapproved"
                        @if ($beneficiary->status == "disapproved") checked @endif disabled> Disapproved
                </div>
                <div class="status-option">
                    <input type="radio" name="status" value="renew" @if ($beneficiary->status == "renew") checked @endif
                        disabled> Renewal
                </div>
            </div>
        </div>
    </div>
</body>

</html>

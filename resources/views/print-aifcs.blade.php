<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Eligibility</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10.5pt;
            margin: 20px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .mb-1,
        .mb-5,
        .mt-5 {
            margin: 5px 0;
        }

        .fw-bold {
            font-weight: bold;
        }

        .fill-line {
            display: inline-block;
            border-bottom: 1px solid black;
            min-width: 150px;
            margin: 0 5px;
            text-align: center;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .column {
            width: 48%;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-check-label {
            margin-left: 10px;
        }

        .line {
            border-top: 1px solid black;
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="d-flex align-items-center">
                    <!-- Logo Section -->
                   
    <div class="container">
        <p class="fst-italic mb-1 text-center">Republic of the Philippines</p>
        <p class="mb-1 text-center">PROVINCE OF BUKIDNON</p>
        <p class="fw-bold mb-3 text-center">MUNICIPALITY OF MANOLO FORTICH</p>

        <h4 class="letter-spacing fw-bold text-center">CERTIFICATE OF ELIGIBILITY</h4>

        <p class="text-end mb-4">Date: <span class="fill-line">{{ $formData['certificate_date'] ?? '_________' }}</span></p>

        <p class="mb-2">
            This is to certify that <span class="fill-line">{{ $formData['surname'] ?? '_________' }}</span>,
            <span class="fill-line">{{ $formData['first_name'] ?? '_________' }}</span>
            <span class="fill-line">{{ $formData['middle_name'] ?? '_________' }}</span>,
            <span class="fill-line">{{ $formData['age'] ?? '___' }}</span> year/s old and presently residing at
            <span class="fill-line">{{ $formData['address'] ?? '_________________________' }}</span>, has been found eligible for
            <span class="fw-bold">Financial Assistance</span> for
            <span class="fill-line">{{ $formData['assistance_type'] ?? '_________________' }}</span> after a thorough assessment has been conducted.
        </p>

        <p class="mb-1">Records of the case such as the following are confidentially filed at the Municipal Social Welfare and Development Office:</p>

        <!-- Checkboxes Section -->
        <div class="checkbox-group">
            <div class="column">
                <div class="form-check">
                    <input type="checkbox" {{ isset($formData['brgy_certification']) && $formData['brgy_certification'] ? 'checked' : '' }} disabled>
                    <label class="form-check-label">BRGY. CERTIFICATION OF INDIGENCE</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ isset($formData['valid_id_presented']) && $formData['valid_id_presented'] ? 'checked' : '' }} disabled>
                    <label class="form-check-label">VALID ID PRESENTED</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ isset($formData['death_certificate']) && $formData['death_certificate'] ? 'checked' : '' }} disabled>
                    <label class="form-check-label">DEATH CERTIFICATE</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ isset($formData['medical_certificate']) && $formData['medical_certificate'] ? 'checked' : '' }} disabled>
                    <label class="form-check-label">MEDICAL CERTIFICATE/ABSTRACT</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ isset($formData['lab_request']) && $formData['lab_request'] ? 'checked' : '' }} disabled>
                    <label class="form-check-label">LAB REQUEST</label>
                </div>
            </div>
            <div class="column">
                <div class="form-check">
                    <input type="checkbox" {{ isset($formData['quotation']) && $formData['quotation'] ? 'checked' : '' }} disabled>
                    <label class="form-check-label">QUOTATION</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ isset($formData['charge_slip']) && $formData['charge_slip'] ? 'checked' : '' }} disabled>
                    <label class="form-check-label">CHARGE SLIP</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ isset($formData['statement_of_account']) && $formData['statement_of_account'] ? 'checked' : '' }} disabled>
                    <label class="form-check-label">STATEMENT OF ACCOUNT/HOSPITAL BILL</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ isset($formData['vaccination']) && $formData['vaccination'] ? 'checked' : '' }} disabled>
                    <label class="form-check-label">VACCINATION</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ isset($formData['treatment_protocol']) && $formData['treatment_protocol'] ? 'checked' : '' }} disabled>
                    <label class="form-check-label">TREATMENT PROTOCOL</label>
                </div>
            </div>
        </div>

        <!-- Financial Assistance Section -->
        <p class="mt-5 mb-1">
            The client is hereby recommended to receive financial assistance for
            <span class="fill-line">{{ $formData['financial_assistance'] ?? '_________________' }}</span> in the amount of Php.
            <span class="fill-line">{{ $formData['assistance_amount'] ?? '___________' }}</span>
        </p>

        <!-- Signature Section -->
        <div class="row">
                        <div class="col-6 text-center">
                            <p style="font-size: 0.8rem;"><br></p>
                            <p style="font-size: 0.8rem;"> ____________________________________</p>
                            <p style="font-size: 0.8rem;"><b>Signature or thumb mark of the Senior <br>
                                Citizens Member</b></p>
                        </div>
                    <div class="col-6 text-center">
                            <p style="font-size: 0.8rem;"><br></p>
                            <p style="font-size: 0.8rem;"> _____________________________________</p>
                            <p style="font-size: 0.8rem;"><b>Sr. Citizen Brgy. Org. President</b></p>
                    </div>
    </div>
</body>

</html>
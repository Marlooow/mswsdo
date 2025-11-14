<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Senior Citizen Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h5,
        .header h6 {
            margin: 5px 0;
        }

        .form-section {
            margin-bottom: 10px;
        }

        .input-underline {
            border: none;
            border-bottom: 1px solid black;
            width: 100%;
            padding: 2px 0;
        }

        .flex-row {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        .signature-section {
            margin-top: 20px;
        }

        .registration-details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        @media print {
            body {
                padding: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>Republic of the Philippines</h3>
        <h4>PROVINCE OF BUKIDNON</h4>
        <h4>Municipality of Manolo Fortich Bukidnon</h4>
        <h4>oOo</h4>
        <h4>OFFICE OF THE SENIOR CITIZENS AFFAIRS</h4>
        <h3>REGISTRATION FORM</h3>
    </div>

    <div class="form-section">
        <label><strong>NAME:</strong></label>
        <div class="flex-row">
            <input type="text" class="input-underline" value="{{ $formData["first_name"] ?? "" }}" style="width: 28%;">
            <input type="text" class="input-underline" value="{{ $formData["middle_name"] ?? "" }}"
                style="width: 28%;">
            <input type="text" class="input-underline" value="{{ $formData["surname"] ?? "" }}" style="width: 28%;">
            <input type="text" class="input-underline" value="{{ $formData["name_extension"] ?? "" }}"
                style="width: 6%;">
        </div>
    </div>

    <div class="form-section flex-row">
        <label><strong>DATE OF BIRTH:</strong></label>
        <input type="text" class="input-underline" value="{{ $formData["dob"] ?? "" }}" style="width: 40%;">
        <label><strong>Age:</strong></label>
        <input type="text" class="input-underline" value="{{ $formData["age"] ?? "" }}" style="width: 15%;">
        <label><strong>Sex:</strong></label>
        <input type="text" class="input-underline" value="{{ $formData["sex"] ?? "" }}" style="width: 15%;">
    </div>

    <div class="form-section">
        <label><strong>PLACE OF BIRTH:</strong></label>
        <input type="text" class="input-underline" value="{{ $formData["place_of_birth"] ?? "" }}"
            style="width: 100%;">
    </div>

    <div class="form-section">
        <label><strong>CIVIL STATUS:</strong></label>
        <input type="text" class="input-underline" value="{{ $formData["civil_status"] ?? "" }}"
            style="width: 100%;">
    </div>

    <div class="form-section">
        <label><strong>ADDRESS:</strong></label>
        <input type="text" class="input-underline" value="{{ $formData["address"] ?? "" }}" style="width: 100%;">
    </div>

    <div class="form-section">
        <label><strong>EDUCATIONAL ATTAINMENT:</strong></label>
        <input type="text" class="input-underline" value="{{ $formData["educational_attainment"] ?? "" }}"
            style="width: 100%;">
    </div>

    <div class="form-section flex-row">
        <label><strong>OCCUPATION:</strong></label>
        <input type="text" class="input-underline" value="{{ $formData["occupation"] ?? "" }}" style="width: 50%;">
        <label><strong>ANNUAL INCOME:</strong></label>
        <input type="text" class="input-underline" value="{{ $formData["annual_income"] ?? "" }}"
            style="width: 30%;">
    </div>

    <div class="form-section">
        <label><strong>OTHER SKILLS:</strong></label>
        <input type="text" class="input-underline" value="{{ $formData["other_skills"] ?? "" }}"
            style="width: 100%;">
    </div>

    <h5 style="text-align: center;">FAMILY COMPOSITION</h5>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Relation</th>
                <th>Civil Status</th>
                <th>Occupation</th>
                <th>Income</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($formData["family_composition"]) && is_array($formData["family_composition"]))
                @foreach ($formData["family_composition"] as $member)
                    <tr>
                        <td><input type="text" class="input-underline"
                                value="{{ $member["name"] ?? "Not provided" }}"></td>
                        <td><input type="text" class="input-underline"
                                value="{{ $member["age"] ?? "Not provided" }}"></td>
                        <td><input type="text" class="input-underline"
                                value="{{ $member["relation"] ?? "Not provided" }}"></td>
                        <td><input type="text" class="input-underline"
                                value="{{ $member["civil_status"] ?? "Not provided" }}"></td>
                        <td><input type="text" class="input-underline"
                                value="{{ $member["occupation"] ?? "Not provided" }}"></td>
                        <td><input type="text" class="input-underline"
                                value="{{ $member["income"] ?? "Not provided" }}"></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="signature-section">
        <p>I certify that the above information are true and correct to the best of my knowledge and belief.</p>
        <p style="text-align: center;"><strong>Signature or thumb mark of the Senior Citizens Member</strong></p>
    </div>

    <div class="form-section">
        <p><strong>Note:</strong> THIS REGISTRATION FORM SHALL BE SECURED BY THE SENIOR CITIZENS FROM OSCA AND SUBMIT
            WITH (2) 1X1 I.D PICTURE (red background) & 1 PHOTOCOPY OF BIRTH CERTIFICATE.</p>
    </div>

    <div class="registration-details">
        <div>
            <p><strong>Date of Registration:</strong> __________________________</p>
        </div>
        <div>
            <p><strong>Sr. Citizen Brgy. Org. President</strong> __________________________</p>
        </div>
    </div>
</body>

</html>

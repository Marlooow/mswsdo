<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Assistance Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .header-text {
            text-align: center;
        }

        .header-text h4,
        .header-text h5,
        .header-text h6 {
            margin: 5px 0;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            margin-bottom: 10px;
            align-items: center;
        }

        .form-label {
            width: 40%;
            text-align: right;
            margin-right: 10px;
            font-weight: bold;
        }

        .form-input {
            width: 60%;
        }

        .documents-list {
            list-style-type: none;
            padding: 0;
        }

        .documents-list li {
            margin-bottom: 5px;
            padding: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
        }

        .checkbox-item input {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-text">
            <h4>Republic of the Philippines</h4>
            <h5>PROVINCE OF BUKIDNON</h5>
            <h5>Municipality of Manolo Fortich Bukidnon</h5>
            <h6>oOo</h6>
            <h5>EDUCATIONAL ASSISTANCE PROGRAM</h5>
            <h3>REGISTRATION FORM</h3>
        </div>
    </div>

    <h4 style="text-align: center;">Personal Information</h4>

    <form>
        <input type="hidden" name="program_id" value="2">
        <input type="hidden" name="form_data[educational_attainment]" value="N/A">
        <input type="hidden" name="form_data[occupation]" value="N/A">

        <div class="form-section">
            <p class="form-row">
                <span class="form-label" for="surname">Surname:</span>
                <span class="form-input">{{ $formData["surname"] }}</span>
            </p>

            <p class="form-row">
                <span class="form-label" for="first_name">First name:</span>
                <span class="form-input">{{ $formData["first_name"] }}</span>
            </p>

            <p class="form-row">
                <span class="form-label" for="middle_name">Middle name:</span>
                <span class="form-input">{{ $formData["middle_name"] }}</span>
            </p>

            <p class="form-row">
                <span class="form-label">Name Extension:</span>
                <span class="form-input">{{ $formData["name_extension"] }}</span>
            </p>

            <p class="form-row">
                <span class="form-label">Sex:</span>
                <span class="form-input">{{ $formData["sex"] }}</span>
            </p>

            <p class="form-row">
                <span class="form-label" for="dob">Date of Birth:</span>
                <span class="form-input">{{ $formData["dob"] }}</span>
            </p>

            <p class="form-row">
                <span class="form-label" for="age">Age:</span>
                <span class="form-input">{{ $formData["age"] }}</span>
            </p>

            <p class="form-row">
                <span class="form-label" for="place_of_birth">Place of Birth:</span>
                <span class="form-input">{{ $formData["place_of_birth"] }}</span>
            </p>

            <p class="form-row">
                <span class="form-label">Civil Status:</span>
                <span class="form-input">{{ $formData["civil_status"] }}</span>
            </p>

            <p class="form-row">
                <span class="form-label" for="address">Address:</span>
                <span class="form-input">{{ $formData["address"] }}</span>
            </p>
        </div>

        <h4 style="text-align: center;">Required Documents</h4>

        <ul class="documents-list">
            <li>
                <div class="checkbox-item">
                    <input type="checkbox" id="referral_slip" name="form_data[referral_slip]" value="1"
                        {{ $formData["referral_slip"] ?? "" ? "checked" : "" }} disabled>
                    <label for="referral_slip">Referral slip from referring agency</label>
                </div>
            </li>
            <li>
                <div class="checkbox-item">
                    <input type="checkbox" id="study_load" name="form_data[study_load]" value="1"
                        {{ $formData["study_load"] ? "checked" : "" }} disabled>
                    <label for="study_load">Study load</label>
                </div>
            </li>
            <li>
                <div class="checkbox-item">
                    <input type="checkbox" id="student_id" name="form_data[student_id]" value="1"
                        {{ $formData["student_id"] ? "checked" : "" }} disabled>
                    <label for="student_id">Student ID</label>
                </div>
            </li>
            <li>
                <div class="checkbox-item">
                    <input type="checkbox" id="certificate_of_no_scholarship"
                        name="form_data[certificate_of_no_scholarship]" value="1"
                        {{ $formData["certificate_of_no_scholarship"] ? "checked" : "" }} disabled>
                    <label for="certificate_of_no_scholarship">Certificate of no scholarship</label>
                </div>
            </li>
            <li>
                <div class="checkbox-item">
                    <input type="checkbox" id="brgy_cert" name="form_data[brgy_cert]" value="1"
                        {{ $formData["brgy_cert"] ? "checked" : "" }} disabled>
                    <label for="brgy_cert">Barangay certification</label>
                </div>
            </li>
            <li>
                <div class="checkbox-item">
                    <input type="checkbox" id="cert_ass_off" name="form_data[cert_ass_off]" value="1"
                        {{ $formData["cert_ass_off"] ? "checked" : "" }} disabled>
                    <label for="cert_ass_off">Certification from the Assessors Office</label>
                </div>
            </li>
        </ul>
    </form>
</body>

</html>

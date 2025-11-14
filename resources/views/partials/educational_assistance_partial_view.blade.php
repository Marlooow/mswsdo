<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Assistance Application Form</title>
</head>

<body>
    <div class="container">
        @if (session("error"))
        <div class="alert alert-danger">
            {{ session("error") }}
        </div>
        @endif

        @if (session("success"))
        <div class="alert alert-success">
            {{ session("success") }}
        </div>
        @endif
        <div class="row justify-content-center no-print remove-display-print">
            <div class="col-md-12">
                <div class="status-banner no-print remove-display-print status-{{ strtolower($beneficiary->status) }}">
                    STATUS:
                    @if ($beneficiary->status == "approved")
                    <span>APPROVED</span>
                    @elseif($beneficiary->status == "pending")
                    <span>Pending</span>
                    @elseif($beneficiary->status == "new")
                    <span>NEW</span>
                    @elseif($beneficiary->status == "renew")
                    <span>RENEW</span>
                    @else
                    <span>DISAPPROVED</span>
                    @endif
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset("/images/logo.png") }}" alt="Logo" height="auto" width="150"
                                    class="img-fluid make-this-center">

                            </div>
                            <div class="text-center col-md-8">

                                <h4>Republic of the Philippines</h4>
                                <h5>PROVINCE OF BUKIDNON</h5>
                                <h5>Municipality of Manolo Fortich Bukidnon</h5>
                                <h6>oOo</h6>
                                <h5>EDUCATIONAL ASSISTANCE PROGRAM</h5>
                                <h3 class="mt-3">REGISTRATION FORM</h3>
                            </div>
                        </div>
                        <h4 class="mb-3" style="text-align:center">Personal Information</h4>

                        <input type="hidden" name="program_id" value="2">
                        <input type="hidden" name="form_data[educational_attainment]" value="N/A">
                        <input type="hidden" name="form_data[occupation]" value="N/A">

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">Surname:</label>
                            <div class="col-md-6 mb-1">
                                <input id="surname" type="text"
                                    class="form-control @error(" form_data.surname") is-invalid @enderror"
                                    name="form_data[surname]"
                                    value="{{ old("form_data.surname", $formData["surname"] ?? "") }}" required
                                    disabled>
                                @error("form_data.surname")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First name:</label>
                            <div class="col-md-6 mb-1">
                                <input id="first_name" type="text"
                                    class="form-control @error(" form_data.first_name") is-invalid @enderror"
                                    name="form_data[first_name]"
                                    value="{{ old("form_data.first_name", $formData["first_name"] ?? "") }}" required
                                    disabled>
                                @error("form_data.first_name")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="middle_name" class="col-md-4 col-form-label text-md-right">Middle name:</label>
                            <div class="col-md-6 mb-1">
                                <input id="middle_name" type="text"
                                    class="form-control @error(" form_data.middle_name") is-invalid @enderror"
                                    name="form_data[middle_name]"
                                    value="{{ old("form_data.middle_name", $formData["middle_name"] ?? "") }}" disabled>
                                @error("form_data.middle_name")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_extension" class="col-md-4 col-form-label text-md-right">Name
                                Extension:</label>
                            <div class="col-md-6 mb-1">
                                <select id="name_extension"
                                    class="form-control @error(" form_data.name_extension") is-invalid @enderror"
                                    name="form_data[name_extension]" disabled>
                                    <option value="N/A"
                                        {{ old("form_data.name_extension", $formData["name_extension"] ?? "") == "N/A" ? "selected" : "" }}>
                                        N/A</option>
                                    <option value="JR."
                                        {{ old("form_data.name_extension", $formData["name_extension"] ?? "") == "JR." ? "selected" : "" }}>
                                        JR.</option>
                                    <option value="SR."
                                        {{ old("form_data.name_extension", $formData["name_extension"] ?? "") == "SR." ? "selected" : "" }}>
                                        SR.</option>
                                    <option value="III"
                                        {{ old("form_data.name_extension", $formData["name_extension"] ?? "") == "III" ? "selected" : "" }}>
                                        III</option>
                                    <option value="IV"
                                        {{ old("form_data.name_extension", $formData["name_extension"] ?? "") == "IV" ? "selected" : "" }}>
                                        IV</option>
                                </select>
                                @error("form_data.name_extension")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">Sex:</label>
                            <div class="col-md-6 mb-1">
                                <select id="sex" class="form-control @error(" form_data.sex") is-invalid @enderror"
                                    name="form_data[sex]" disabled>
                                    <option value="Male"
                                        {{ old("form_data.sex", $formData["sex"] ?? "") == "Male" ? "selected" : "" }}>
                                        Male</option>
                                    <option value="Female"
                                        {{ old("form_data.sex", $formData["sex"] ?? "") == "Female" ? "selected" : "" }}>
                                        Female</option>
                                </select>
                                @error("form_data.sex")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth:</label>
                            <div class="col-md-3">
                                <input id="dob" type="date"
                                    class="form-control @error(" form_data.dob") is-invalid @enderror"
                                    name="form_data[dob]" value="{{ old("form_data.dob", $formData["dob"] ?? "") }}"
                                    required disabled>
                                @error("form_data.dob")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="age" class="col-md-1 col-form-label text-md-right">Age:</label>
                            <div class="col-md-2 mb-1">
                                <input id="age" type="number"
                                    class="form-control @error(" form_data.age") is-invalid @enderror"
                                    name="form_data[age]" value="{{ old("form_data.age", $formData["age"] ?? "") }}"
                                    required readonly disabled>
                                @error("form_data.age")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="place_of_birth" class="col-md-4 col-form-label text-md-right">Place of
                                Birth:</label>
                            <div class="col-md-6 mb-1">
                                <input id="place_of_birth" type="text"
                                    class="form-control @error(" form_data.place_of_birth") is-invalid @enderror"
                                    name="form_data[place_of_birth]"
                                    value="{{ old("form_data.place_of_birth", $formData["place_of_birth"] ?? "") }}"
                                    disabled>
                                @error("form_data.place_of_birth")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="civil_status" class="col-md-4 col-form-label text-md-right">Civil
                                Status:</label>
                            <div class="col-md-6 mb-1">
                                <select id="civil_status"
                                    class="form-control @error(" form_data.civil_status") is-invalid @enderror"
                                    name="form_data[civil_status]" required disabled>
                                    <option value="Single"
                                        {{ old("form_data.civil_status", $formData["civil_status"] ?? "") == "Single" ? "selected" : "" }}>
                                        Single</option>
                                    <option value="Married"
                                        {{ old("form_data.civil_status", $formData["civil_status"] ?? "") == "Married" ? "selected" : "" }}>
                                        Married</option>
                                    <option value="Widowed"
                                        {{ old("form_data.civil_status", $formData["civil_status"] ?? "") == "Widowed / Widower" ? "selected" : "" }}>
                                        Widowed / Widower</option>
                                    <option value="Legally Separated"
                                        {{ old("form_data.civil_status", $formData["civil_status"] ?? "") == "Legally Separated" ? "selected" : "" }}>
                                        Legally Separated</option>
                                </select>
                                @error("form_data.civil_status")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address:</label>
                            <div class="col-md-6 mb-1">
                                <input id="address" type="text"
                                    class="form-control @error(" form_data.address") is-invalid @enderror"
                                    name="form_data[address]"
                                    value="{{ old("form_data.address", $formData["address"] ?? "") }}" required
                                    disabled>
                                @error("form_data.address")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <h4 class="mb-3 mt-3" style="text-align:center">Required Documents</h4>

                            <ul class="list-group">
                                <!-- Referral Slip -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.referral_slip") is-invalid @enderror"
                                            type="checkbox" name="form_data[referral_slip]" id="referral_slip"
                                            value="1"
                                            {{ old("form_data.referral_slip", $formData["referral_slip"] ?? "") ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label" for="referral_slip">Referral slip from
                                            referring agency</label>
                                    </div>
                                </li>

                                <!-- Study Load -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.study_load") is-invalid @enderror"
                                            type="checkbox" name="form_data[study_load]" id="study_load"
                                            value="1"
                                            {{ old("form_data.study_load", $formData["study_load"] ?? "") ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label" for="study_load">Study load</label>
                                    </div>
                                </li>

                                <!-- Student ID -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.student_id") is-invalid @enderror"
                                            type="checkbox" name="form_data[student_id]" id="student_id"
                                            value="1"
                                            {{ old("form_data.student_id", $formData["student_id"] ?? "") ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label" for="student_id">Student ID</label>
                                    </div>
                                </li>

                                <!-- Certificate of No Scholarship -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.certificate_of_no_scholarship") is-invalid @enderror"
                                            type="checkbox" name="form_data[certificate_of_no_scholarship]"
                                            id="certificate_of_no_scholarship" value="1"
                                            {{ old("form_data.certificate_of_no_scholarship", $formData["certificate_of_no_scholarship"] ?? "") ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label"
                                            for="certificate_of_no_scholarship">Certificate of no scholarship</label>
                                    </div>
                                </li>

                                <!-- Barangay Certification -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.brgy_cert") is-invalid @enderror"
                                            type="checkbox" name="form_data[brgy_cert]" id="brgy_cert"
                                            value="1"
                                            {{ old("form_data.brgy_cert", $formData["brgy_cert"] ?? "") ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label" for="brgy_cert">Barangay certification</label>
                                    </div>
                                </li>

                                <!-- Certification from the Assessors Office -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.cert_ass_off") is-invalid @enderror"
                                            type="checkbox" name="form_data[cert_ass_off]" id="cert_ass_off"
                                            value="1"
                                            {{ old("form_data.cert_ass_off", $formData["cert_ass_off"] ?? "") ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label" for="cert_ass_off">Certification from the
                                            Assessors Office</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->role_id == 2 || $isAdmin)
        <div class="row justify-content-center printable-area remove-display-print-view neg-mt-educ">
            <div class="col-md-12">
                <div class="d-flex align-items-center">
                    <!-- Logo Section -->
                    <div class="col-auto">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="120" height="auto"
                            class="ml-2 mr-200" class="img-fluid">
                    </div>
                    <!-- Header Section -->
                    <div class="header text-center flex-grow-1 ml-1 mr-0">
                        <p class="text-center fs-5 fst-italic mb-1">Republic of the Philippines</p>
                        <p class="text-center fs-5 mb-1">PROVINCE OF BUKIDNON</p>
                        <p class="text-center fs-5 fw-bold mb-5">MUNICIPALITY OF MANOLO FORTICH</p>
                        <h4 class="letter-spacing text-center fw-bold">CERTIFICATE OF ELIGIBILITY</h4>
                    </div>
                </div>
                <p class="text-end my-5 fw-bold" style="text-align: center;">Date: <input value="{{ now()->format("Y-m-d") }}" type="date" name="form_data[certificate_date]" class="border-0 border-bottom border-2 border-black date-input mx-2" disabled /></p>

                <p class="mb-0">This is to certify that
                    <input type="text" style="text-align: center;" value="{{ $formData['surname'] ?? ''}}" name="form_data[surname]" class="border-0 border-bottom border-2 border-black fill-input-width-print straight-fill" disabled />,
                    <input type="text" style="text-align: center;" value="{{ $formData['first_name'] ?? ''}}" name="form_data[surname]" class="border-0 border-bottom border-2 border-black fill-input-width-print straight-fill" disabled />
                    <input type="text" style="text-align: center;" value="{{ $formData['middle_name'] ?? ''}}" name="form_data[surname]" class="border-0 border-bottom border-2 border-black fill-input-width-print straight-fill" disabled />,
                    <input type="number" style="text-align: center;" value="{{ $formData['age'] ?? ''}}" name="form_data[age]" class="border-0 border-bottom border-2 border-black fill-age-width straight-fill" disabled /> year/s old and presently residing at <input type="text" style="text-align: center;" value="{{ $formData['address'] ?? ''}}" name="form_data[address]" class="border-0 border-bottom border-2 border-black fill-address-width-print straight-fill" disabled />,
                    has been found eligible for <span class="text-decoration-underline fw-semibold">Educational Assistance</span> for <input type="text" style="text-align: center;" value="Financial" name="form_data[assistance_type]" class="border-0 border-bottom border-2 border-black fill-input-width-print straight-fill" disabled />
                    after a thorough assessment has been conducted.
                </p>

                <p class="mb-0 mt-1">Records of the case such as the following are confidentially filed at the Municipal Social Welfare and Development Office.</p>

                <div class="row px-5 my-4">
                    <div class="form-check col-6">
                        <input class="form-check-input" style="text-align: center;" type="checkbox" name="form_data[brgy_certification]"
                            id="brgycertcheckbox"
                            {{ old("form_data.certificate_of_no_scholarship", $formData["certificate_of_no_scholarship"] ?? "") ? "checked" : "" }} disabled>
                        <label class="form-check-label fs-6-force" for="brgycertcheckbox">
                            Referral slip from referring agency
                        </label>
                    </div>
                    <div class="form-check col-6 mb-1">
                        <input class="form-check-input" style="text-align: center;" type="checkbox" name="form_data[death_certificate]"
                            id="deathcertcheckbox"
                            {{ old("form_data.brgy_cert", $formData["brgy_cert"] ?? "") ? "checked" : "" }} disabled>
                        <label class="form-check-label fs-6-force" for="deathcertcheckbox">
                            Study load
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" style="text-align: center;" type="checkbox" name="form_data[valid_id_presented]" value="1" id="valididcheckbox"
                            {{ old("form_data.cert_ass_off", $formData["cert_ass_off"] ?? "") ? "checked" : "" }} disabled>
                        <label class="form-check-label fs-6-force" for="valididcheckbox">
                            Student ID
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" style="text-align: center;" type="checkbox" name="form_data[valid_id_presented]" value="1" id="valididcheckbox"
                            {{ old("form_data.certificate_of_no_scholarship", $formData["certificate_of_no_scholarship"] ?? "") ? "checked" : "" }} disabled>
                        <label class="form-check-label fs-6-force" for="valididcheckbox">
                            Certificate of no scholarship
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" style="text-align: center;" type="checkbox" name="form_data[valid_id_presented]" value="1" id="valididcheckbox"
                            {{ old("form_data.brgy_cert", $formData["brgy_cert"] ?? "") ? "checked" : "" }} disabled>
                        <label class="form-check-label fs-6-force" for="valididcheckbox">
                            Barangay certificate
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" style="text-align: center;" type="checkbox" name="form_data[valid_id_presented]" value="1" id="valididcheckbox"
                            {{ old("form_data.cert_ass_off", $formData["cert_ass_off"] ?? "") ? "checked" : "" }} disabled>
                        <label class="form-check-label fs-6-force" for="valididcheckbox">
                            Certificate from the Assessors Office
                        </label>
                    </div>
                </div>

                <p class="MB-0">The client is hereby recommended to receive financial assistance for <input type="text" style="text-align: center;" value="School Purposes" name="form_data[financial_assistance]" class="border-0 border-bottom border-2 border-black fill-assis-width straight-fill" disabled />
                    in the amount of Php. <input type="text" style="text-align: center;" value="{{ $formData['assistance_amount'] ?? ''}}" name="form_data[assistance_amount]" id="amount" class="border-0 border-bottom border-2 border-black fill-amount-width straight-fill" disabled />
                </p>

                <!-- Conforme section -->
                <div class="row mt-5 text-center">
                    <div class="col-6">
                        <p class="mb-6">CONFORME:</p>
                        <input
                            style="width: 100%; text-align:center; text-transform: uppercase; background-color: transparent; border: 0; border-bottom: 2px solid black;"
                            value="{{ ($formData['first_name'] ?? '') . ' ' . ($formData['middle_name'] ?? '') . ' ' . ($formData['surname'] ?? '') }}"
                            disabled>
                        <p>SIGNATURE ABOVE PRINTED NAME OF CLIENT</p>
                    </div>
                    <div class="col-6">
                        <p>APPROVED BY:</p>
                        <input type="text" name="form_data[approved_by]" class="border-0 border-bottom border-2 border-black fill-input-width-signed straight-fill text-center" value="{{ $approverName }}" name="form_data[approved_by]" readonly />
                        <p class="mb-0">MSWDO</p>

                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</body>
<!-- Add CSS for carousel size and status banner -->
<style>
    .carousel-small {
        width: 80%;
        /* Adjust width as needed */
        max-width: 600px;
        /* Adjust max-width as needed */
        margin: 0 auto;
        /* Center the carousel */
    }

    .carousel-small .carousel-item {
        text-align: center;
        min-width: 600px;
        /* Center content */
    }

    .carousel-img {
        width: 100%;
        min-height: 350px;
        /* Scale image to fit the container */
        height: auto;
        /* Maintain aspect ratio */
    }

    /* Custom Styling for Carousel Arrows */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: black;
        /* Background color of arrows */
    }

    .carousel-control-prev,
    .carousel-control-next {
        filter: invert(1);
        /* Invert color to make arrows black if using default white icons */
    }

    /* Status Banner Styling */
    .status-banner {
        padding: 10px;
        border-radius: 5px;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
        color: white;
        text-align: center;
        font-weight: bold;
    }

    .status-new {
        background-color: lightblue;
    }

    .status-renew {
        background-color: orange;
    }

    .status-approved {
        background-color: green;
    }

    .status-disapproved {
        background-color: red;
    }

    .status-pending {
        background-color: #ffc107;
    }

    .bg-info {
        padding: 5px;
    }

    .neg-mt-educ {
        margin-top: -50px !important;
    }

    .fill-input-width-signed {
        width: 300px !important;
    }

    .fill-input-width-print {
        width: 170px !important;
    }
</style>

</html>
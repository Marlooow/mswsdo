<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Citizen Application Form</title>
</head>

<body>
    <div class="container">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row justify-content-center no-print remove-display-print">
            <div class="col-md-12">
                <div class="status-banner no-print status-{{ strtolower($beneficiary->status) }}">
                    STATUS:
                    @switch(strtolower($beneficiary->status))
                    @case('approved')
                    <span>APPROVED</span>
                    @break
                    @case('pending')
                    <span>PENDING</span>
                    @break
                    @case('new')
                    <span>NEW</span>
                    @break
                    @case('renew')
                    <span>RENEW</span>
                    @break
                    @default
                    <span>DISAPPROVED</span>
                    @endswitch
                </div>
                <div class="card" style="border-top-right-radius: 0px;border-top-left-radius: 0px;">

                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-2 text-end">
                                <img src="{{ asset("/images/logo.png") }}" alt="Logo" height="auto" width="100"
                                    class="img-fluid make-this-center">
                            </div>
                            <div class="col-md-8 text-center">
                                <h5 class="mb-0" style="font-size: 1.1rem;">Republic of the Philippines</h5>
                                <h6 class="mb-0" style="font-size: 1rem;">PROVINCE OF BUKIDNON</h6>
                                <h6 class="mb-0" style="font-size: 1rem;">Municipality of Manolo Fortich Bukidnon
                                </h6>
                                <h6 class="mb-2" style="font-size: 1rem;">oOo</h6>
                                <h6 class="mb-0" style="font-size: 1rem;">OFFICE OF THE SENIOR CITIZENS AFFAIRS</h6>
                                <h5 class="mt-3 mb-0" style="font-size: 1.1rem;">REGISTRATION FORM</h5>

                            </div>

                        </div>
                        <h4 class="mb-3 " style="text-align:center">Personal Information</h4>

                        <input type="hidden" name="program_id" value="{{ $beneficiary->program_id }}">

                        <!-- Form Fields -->
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">Surname:</label>
                            <div class="col-md-6 mb-1">
                                <input value="{{ $formData['surname'] ?? '' }}" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First name:</label>
                            <div class="col-md-6 mb-1">
                                <input value="{{ $formData['first_name'] ?? '' }}" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="middle_name" class="col-md-4 col-form-label text-md-right">Middle name:</label>
                            <div class="col-md-6 mb-1">
                                <input value="{{ $formData['middle_name'] ?? '' }}" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_extension" class="col-md-4 col-form-label text-md-right">Name
                                Extension:</label>
                            <div class="col-md-6 mb-1">
                                <input value="{{ $formData['name_extension'] ?? '' }}" class="form-control" disabled>
                            </div>
                        </div>

                        <!-- Common Fields -->
                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">Sex:</label>
                            <div class="col-md-6 mb-1">
                                <input value="{{ $formData['sex'] ?? '' }}" class="form-control" disabled />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth:</label>
                            <div class="col-md-3">
                                <input class="form-control" value="{{ $formData['dob'] ?? '' }}" disabled>
                            </div>
                            <label for="age" class="col-md-1 col-form-label text-md-right">Age:</label>
                            <div class="col-md-2 mb-1">
                                <input class="form-control" value="{{ $formData['age'] ?? '' }}" disabled />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="place_of_birth" class="col-md-4 col-form-label text-md-right">Place of
                                Birth:</label>
                            <div class="col-md-6 mb-1">
                                <input class="form-control" value="{{ $formData['place_of_birth'] ?? '' }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="civil_status" class="col-md-4 col-form-label text-md-right">Civil
                                Status:</label>
                            <div class="col-md-6 mb-1">
                                <input value="{{ $formData['civil_status'] ?? '' }}" class="form-control" disabled />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="educational_attainment"
                                class="col-md-4 col-form-label text-md-right">Educational Attainment:</label>
                            <div class="col-md-6 mb-1">
                                <input value="{{ $formData['educational_attainment'] ?? '' }}" class="form-control"
                                    disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="occupation" class="col-md-4 col-form-label text-md-right">Occupation:</label>
                            <div class="col-md-6 mb-1">
                                <input class="form-control" value="{{ $formData['occupation'] ?? '' }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address:</label>
                            <div class="col-md-6 mb-1">
                                <input class="form-control" value="{{ $formData['address'] ?? '' }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="annual_income" class="col-md-4 col-form-label text-md-right">Annual
                                Income:</label>
                            <div class="col-md-6 mb-1">
                                <input class="form-control" value="{{ $formData['annual_income'] ?? '' }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="other_skills" class="col-md-4 col-form-label text-md-right">Other
                                Skills:</label>
                            <div class="col-md-6 mb-1">
                                <input class="form-control" value="{{ $formData['other_skills'] ?? '' }}" disabled>
                            </div>
                        </div>

                        <!-- Family Composition -->
                        <h4 class="mt-3 mb-3" style="text-align:center">Family Composition</h4>
                        <div id="family-composition">
                            <!-- Labels for each column -->
                            <div class="form-group row" style="text-align:center">
                                <label class="col-md-3 col-form-label text-md-right">Name</label>
                                <label class="col-md-1 col-form-label text-md-right">Age</label>
                                <label class="col-md-2 col-form-label text-md-right">Relation</label>
                                <label class="col-md-2 col-form-label text-md-right">Civil Status</label>
                                <label class="col-md-2 col-form-label text-md-right">Occupation</label>
                                <label class="col-md-2 col-form-label text-md-right">Income</label>
                            </div>

                            <!-- Loop through each family member in the array -->
                            @if (isset($formData['family_composition']) && is_array($formData['family_composition']))
                            @foreach ($formData['family_composition'] as $member)
                            <div class="family-member">
                                <div class="form-group row">
                                    <div class="col-md-3 mb-1">
                                        <input value="{{ $member['name'] ?? 'Not provided' }}"
                                            class="form-control" disabled>
                                    </div>
                                    <div class="col-md-1">
                                        <input value="{{ $member['age'] ?? 'Not provided' }}"
                                            class="form-control" disabled>
                                    </div>
                                    <div class="col-md-2">
                                        <input value="{{ $member['relation'] ?? 'Not provided' }}"
                                            class="form-control" disabled>
                                    </div>
                                    <div class="col-md-2">
                                        <input value="{{ $member['civil_status'] ?? 'Not provided' }}"
                                            class="form-control" disabled>
                                    </div>
                                    <div class="col-md-2">
                                        <input value="{{ $member['occupation'] ?? 'Not provided' }}"
                                            class="form-control" disabled>
                                    </div>
                                    <div class="col-md-2">
                                        <input value="{{ $member['income'] ?? 'Not provided' }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif

                        </div>

                        <div class="form-group row">
                            <label for="seniorid" class="col-md-4 col-form-label text-md-right">Required
                                Documents:</label>
                            <div class="col-md-4 mb-1 mt-2">
                                <input class="form-check-input @error(' form_data.seniorid') is-invalid @enderror"
                                    type="checkbox" name="form_data[seniorid]" id="seniorid" value="1"
                                    required
                                    {{ old('form_data.seniorid', $formData['seniorid'] ?? false) ? 'checked' : '' }}
                                    disabled>
                                Senior Citizen ID
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-1 mt-4">
                                <div class="alert alert-info text-center" style="font-weight: bold;">
                                    <span style="color: red;">Note:</span> <span style="color: blue;">THIS
                                        REGISTRATION FORM SHALL BE SECURED BY THE SENIOR CITIZENS FROM OSCA AND SUBMIT
                                        WITH</span> <span style="color: red;">(2) 1X1 I.D PICTURE (red
                                        background)</span> <span style="color: blue;">&</span> <span
                                        style="color: red;">1 PHOTOCOPY OF BIRTH CERTIFICATE</span>
                                </div>
                            </div>

                            <div class="col-md-6 mb-1 mt-5 text-md-center">
                                <div class="form-check">
                                    <input
                                        class="form-check-input @error(' form_data.certification') is-invalid @enderror"
                                        type="checkbox" name="form_data[certification]" id="certification"
                                        value="1"
                                        {{ old('form_data.certification', $formData['certification'] ?? false) ? 'checked' : '' }}
                                        disabled>
                                    <label class="form-check-label" for="certification">
                                        I certify that the above information is true and correct to the best of my
                                        knowledge and belief.
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-5 justify-content-center text-center">
                        <div class="col-md-6 mb-1">
                            <input
                                style="width: 100%; text-align:center; text-transform: uppercase; background-color: transparent; border: 0; border-bottom: 2px solid black;"
                                value="{{ ($formData['first_name'] ?? '') . ' ' . ($formData['middle_name'] ?? '') . ' ' . ($formData['surname'] ?? '') }}"
                                disabled>
                            <label for="signature" class="col-md-12 col-form-label text-center">
                                Signature or Thumb Mark of the Senior Citizens Member
                            </label>
                        </div>
                        <div class="col-md-6 mb-1">
                            @if($approverName)
                            <input
                                style="width: 100%; text-align:center; text-transform: uppercase; background-color: transparent; border: 0; border-bottom: 2px solid black;"
                                value=" {{ $approverName}}" disabled>
                            @endif

                            <label for="signature" class="col-md-12 col-form-label text-center"
                                style="text-align: center;">
                                Sr. Citizen Brgy. Org. President
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->role_id == 2 || $isAdmin)
        <div class="row justify-content-center printable-area remove-display-print-view neg-mt">
            <div class="col-md-12">
                <div class="d-flex align-items-center">
                    <!-- Logo Section -->
                    <div class="col-auto">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="117px" height="auto"
                            class="ml-0 mr-200" class="img-fluid">
                    </div>
                    <!-- Header Section -->
                    <div class="header text-center flex-grow-1 fs-3 ml-1 mr-0">
                        <span class="fs-6">Republic of the Philippines</span><br>
                        <span class="fs-6">PROVINCE OF BUKIDNON</span><br>
                        <span class="fs-6">Municipal of Manolo Fortich Bukidnon</span><br>
                        <span class="fs-6">oOo</span><br>
                        <span class="fs-6">OFFICE OF THE SENIOR CITIZENS AFFAIRS</span><br>
                        <h4 class="fs-3">REGISTRATION FORM</h4>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Name Fields -->
                    <div class="form-group">
                        <label style="font-size: 0.9rem;"><b>NAME:</b></label>
                        <div class="d-flex">
                            <input value="{{ $formData['first_name'] ?? '' }}" class="underline-input mr-2"
                                placeholder="First Name" style="width: 30%; font-size: 0.9rem;" disabled>
                            <input value="{{ $formData['middle_name'] ?? '' }}" class="underline-input"
                                placeholder="Middle Name" style="width: 30%; font-size: 0.9rem;" disabled>
                            <input value="{{ $formData['surname'] ?? '' }}" class="underline-input mr-2"
                                placeholder="Surname" style="width: 30%; font-size: 0.9rem;" disabled>
                            <input value="{{ $formData['name_extension'] ?? '' }}" class="underline-input mr-2"
                                placeholder="Name Extension" style="width: 30%; font-size: 0.9rem;" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mb-0" style="display: flex; gap: 80px; font-size: 0.8rem;">
                            <label>(First Name)</label>
                            <label>(Middle Name)</label>
                            <label>(Surname)</label>
                            <label>(Name Extension)</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <label style="font-size: 0.9rem;"><b>DATE OF BIRTH:</b></label>
                            <input value="{{ $formData['dob'] ?? '' }}" class="underline-input mr-2"
                                placeholder="Date of Birth" style="width: 40%; font-size: 0.9rem;" disabled>
                            <label class="mb-0 ml-3" style="font-size: 0.9rem;"><b>Age:</b></label>
                            <input value="{{ $formData['age'] ?? '' }}" class="underline-input mr-2 ml-2"
                                placeholder="Age" style="width: 15%; font-size: 0.9rem;" disabled>
                            <label class="mb-0 ml-3" style="font-size: 0.9rem;"><b>Sex:</b></label>
                            <input value="{{ $formData['sex'] ?? '' }}" class="underline-input ml-2"
                                placeholder="Sex" style="width: 18%; font-size: 0.9rem;" disabled>
                        </div>
                    </div>

                    <!-- Place of Birth -->
                    <div class="form-group">
                        <label style="font-size: 0.9rem;"><b>PLACE OF BIRTH:</b></label>
                        <input value="{{ $formData['place_of_birth'] ?? '' }}" class="underline-input"
                            style="font-size: 0.9rem;" disabled>
                    </div>

                    <!-- Civil Status -->
                    <div class="form-group">
                        <label style="font-size: 0.9rem;"><b>CIVIL STATUS:</b></label>
                        <input value="{{ $formData['civil_status'] ?? '' }}" class="underline-input"
                            style="font-size: 0.9rem;" disabled>
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <label style="font-size: 0.9rem;"><b>ADDRESS:</b></label>
                        <input value="{{ $formData['address'] ?? '' }}" class="underline-input"
                            style="font-size: 0.9rem;" disabled>
                    </div>

                    <!-- Educational Attainment -->
                    <div class="form-group">
                        <label style="font-size: 0.9rem;"><b>EDUCATIONAL ATTAINMENT:</b></label>
                        <input value="{{ $formData['educational_attainment'] ?? '' }}" class="underline-input"
                            style="font-size: 0.9rem;" disabled>
                    </div>

                    <!-- Occupation and Annual Income -->
                    <div class="form-group">
                        <label style="font-size: 0.9rem;"><b>OCCUPATION:</b></label>
                        <div class="d-flex align-items-center">
                            <input value="{{ $formData['occupation'] ?? '' }}" class="underline-input mr-2"
                                placeholder="Occupation" style="width: 70%; font-size: 0.9rem;" disabled>
                            <label class="mb-0 ml-3" style="font-size: 0.9rem;"><b>Annual Income:</b></label>
                            <input value="{{ $formData['annual_income'] ?? '' }}" class="underline-input mr-2"
                                placeholder="Annual Income" style="width: 12%; font-size: 0.9rem;" disabled>
                        </div>
                    </div>

                    <!-- Other Skills -->
                    <div class="form-group">
                        <label style="font-size: 0.9rem;"><b>OTHER SKILLS:</b></label>
                        <input value="{{ $formData['other_skills'] ?? '' }}" class="underline-input"
                            style="font-size: 0.9rem;" disabled>
                    </div>

                    <h5 class="text-center mt-3 mb-3" style="font-size: 1rem;"><b>FAMILY COMPOSITION</b></h5>

                    <!-- Family Composition Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="font-size: 0.9rem;">Name</th>
                                <th style="font-size: 0.9rem;">Age</th>
                                <th style="font-size: 0.9rem;">Relation</th>
                                <th style="font-size: 0.9rem;">Civil Status</th>
                                <th style="font-size: 0.9rem;">Occupation</th>
                                <th style="font-size: 0.9rem;">Income</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($formData['family_composition']) && is_array($formData['family_composition']))
                            @foreach ($formData['family_composition'] as $member)
                            <tr>
                                <td><input class="family-composition-input"
                                        value="{{ $member['name'] ?? 'Not provided' }}"
                                        style="font-size: 0.8rem;" disabled></td>
                                <td><input class="family-composition-input"
                                        value="{{ $member['age'] ?? 'Not provided' }}"
                                        style="font-size: 0.8rem;" disabled></td>
                                <td><input class="family-composition-input"
                                        value="{{ $member['relation'] ?? 'Not provided' }}"
                                        style="font-size: 0.8rem;" disabled></td>
                                <td><input class="family-composition-input"
                                        value="{{ $member['civil_status'] ?? 'Not provided' }}"
                                        style="font-size: 0.8rem;" disabled></td>
                                <td><input class="family-composition-input"
                                        value="{{ $member['occupation'] ?? 'Not provided' }}"
                                        style="font-size: 0.8rem;" disabled></td>
                                <td><input class="family-composition-input"
                                        value="{{ $member['income'] ?? 'Not provided' }}"
                                        style="font-size: 0.8rem;" disabled></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                    <div class="text-center mt-1">
                        <p style="font-size: 0.9rem;">I certify that the above information are true and correct to the
                            best
                            of my knowledge and belief.</p>
                    </div>

                    <div class="form-group text-center mt-3">
                        <label style="font-size: 0.7rem;"><b>Note:</b></label>
                        <small style="font-size: 0.7rem;">THIS REGISTRATION FORM SHALL BE SECURED BY THE SENIOR
                            CITIZENS
                            FROM OSCA AND SUBMIT WITH (2) 1X1 I.D PICTURE (red background) & 1 PHOTOCOPY OF BIRTH
                            CERTIFICATE.</small>
                    </div><br>

                    @php
                    $firstName = $formData['first_name'] ?? '';
                    $middleName = $formData['middle_name'] ?? '';
                    $lastName = $formData['surname'] ?? '';
                    $ext = strtoupper(trim($formData['name_extension'] ?? ''));
                    $validExtensions = ['JR', 'SR', 'I', 'II', 'III', 'IV', 'V'];

                    $fullName = $firstName;
                    if (!empty($middleName)) {
                    $fullName .= ' ' . $middleName;
                    }
                    $fullName .= ' ' . $lastName;

                    if (in_array($ext, $validExtensions)) {
                    $fullName .= ' ' . $ext;
                    }
                    @endphp

                    <div class="row">
                        <div class="col-6 text-center">
                            <!-- Align with the right side -->

                            <p style="font-size: 0.8rem; margin-bottom: 5px;"><br>
                                <input type="text"
                                    value="{{ $fullName }}"
                                    class="underline-input"
                                    style="width: 90%; font-size: 0.7rem; border: none; border-bottom: 2px solid black; text-align: center;"
                                    disabled>
                            </p>

                            <p style="font-size: 0.8rem;"><b>Signature or thumb mark of the Senior <br>
                                    Citizens Member</b></p>
                        </div>

                        <div class="col-6 text-center">
                            <!-- Match line width and spacing -->
                            @if($approverName)
                            {{ $approverName}}
                            <span style="display: inline-block; width: 90%; border-bottom: 2px solid black;">&nbsp;</span>
                            @endif
                            <p style="font-size: 0.8rem;"><b>Sr. Citizen Brgy. Org. President</b></p>
                        </div>
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
        width: 70%;
        /* Adjust width as needed */
        max-width: 200px;
        /* Adjust max-width as needed */
        margin: 0 auto;
        /* Center the carousel */
    }

    .carousel-small .carousel-item {
        text-align: center;
        min-width: 200px;
        /* Center content */
    }

    .carousel-img {
        width: 100%;
        min-height: 200px;
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

    /* Add the underline style to all form fields */
    .underline-input {
        border: none;
        border-bottom: 1px solid #000;
        background: transparent;
        outline: none;
        width: 100%;
    }

    /* To ensure inputs in the family composition table are aligned and consistent */
    .family-composition-input {
        border: none;
        background: transparent;
        outline: none;
        width: 50%;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table,
    .table th,
    .table td {
        border: 1px solid black;
    }

    /* Adjust input widths for better alignment */
    .input-half-width {
        width: 40%;
    }

    .input-third-width {
        width: 25%;
    }

    .input-quarter-width {
        width: 15%;
    }

    .certification-text {
        text-align: justify;
        margin-top: 10px;
    }

    .neg-mt {
        margin-top: -50px;
    }

    @media print {
        @page {
            margin: 100cm;
            Header: 0.7rem;
        }

        body {
            margin: 0;
            /* Set a 1-inch margin around the page */
        }

        .printable-area {
            page-break-inside: avoid;
            /* Avoid breaking content inside this area across pages */
        }

        .card {
            border: none;
            /* Remove borders for a cleaner print layout */
            box-shadow: none;
            /* Remove shadows for print */
        }

        .remove-display-print-view {
            display: block !important;
            /* Ensure visible if previously hidden */
        }
    }
</style>

</html>
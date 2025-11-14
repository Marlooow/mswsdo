<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solo Parent Application Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container ">
        @if (session("error"))
        <div class="alert alert-danger">
            {{ session("error") }}
        </div>
        @endif

        @if (session("success"))
        <div class="alert alert-success ">
            {{ session("success") }}
        </div>
        @endif
        <div class="row justify-content-center no-print remove-display-print">
            <div class="col-md-12">
                <div class="status-banner no-print status-{{ strtolower($beneficiary->status) }}">
                    STATUS:
                    @if ($beneficiary->status == "approved")
                    <span>APPROVED</span>
                    @elseif($beneficiary->status == "pending")
                    <span>PENDING</span>
                    @elseif($beneficiary->status == "new")
                    <span>NEW</span>
                    @elseif($beneficiary->status == "renew")
                    <span>RENEW</span>
                    @else
                    <span>DISAPPROVED</span>
                    @endif
                </div>
                <div class="card" style="border-top-right-radius: 0px;border-top-left-radius: 0px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset("images/logo.png") }}" alt="Logo" width="100ox" height="auto"
                                    class="img-fluid">
                            </div>
                            <div class="col-md-8 text-center">
                                <h5 class="font-weight-bold">Republic of the Philippines</h5>
                                <p>Municipal Social Welfare and Development Office</p>
                                <p>Manolo Fortich, Bukidnon/Region 10</p>
                            </div>
                        </div>

                        <h2 class="text-center mb-4">APPLICATION FORM FOR SOLO PARENT</h2>
                        <div class="mt-4 border-top pt-1">
                        </div>
                        <h4 class="mt-3">I. IDENTIFYING INFORMATION</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surname"><strong>Surname:</strong></label>
                                    <input type="text" class="form-control" id="surname"
                                        value="{{ $formData["surname"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name"><strong>First Name:</strong></label>
                                    <input type="text" class="form-control" id="first_name"
                                        value="{{ $formData["first_name"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="middle_name"><strong>Middle Name:</strong></label>
                                    <input type="text" class="form-control" id="middle_name"
                                        value="{{ $formData["middle_name"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_extension"><strong>Name Extension:</strong></label>
                                    <input type="text" class="form-control" id="name_extension"
                                        value="{{ $formData["name_extension"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="age"><strong>Age:</strong></label>
                                    <input type="number" class="form-control" id="age"
                                        value="{{ $formData["age"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sex"><strong>Sex:</strong></label>
                                    <input type="text" class="form-control" id="sex"
                                        value="{{ $formData["sex"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob"><strong>Date of Birth:</strong></label>
                                    <input type="date" class="form-control" id="dob"
                                        value="{{ $formData["dob"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="place_of_birth"><strong>Place of Birth:</strong></label>
                                    <input type="text" class="form-control" id="place_of_birth"
                                        value="{{ $formData["place_of_birth"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address"><strong>Address:</strong></label>
                                    <input type="text" class="form-control" id="address"
                                        value="{{ $formData["address"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="educational_attainment"><strong>Educational Attainment:</strong></label>
                                    <input type="text" class="form-control" id="educational_attainment"
                                        value="{{ $formData["educational_attainment"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="civil_status"><strong>Civil Status:</strong></label>
                                    <input type="text" class="form-control" id="civil_status"
                                        value="{{ $formData["civil_status"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="occupation"><strong>Occupation:</strong></label>
                                    <input type="text" class="form-control" id="occupation"
                                        value="{{ $formData["occupation"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="religion"><strong>Religion:</strong></label>
                                    <input type="text" class="form-control" id="religion"
                                        value="{{ $formData["religion"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_agency"><strong>Company/Agency:</strong></label>
                                    <input type="text" class="form-control" id="company_agency"
                                        value="{{ $formData["company_agency"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monthly_income"><strong>Monthly Income:</strong></label>
                                    <input type="text" step="0.01" class="form-control" id="monthly_income"
                                        value="{{ $formData["monthly_income"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Employment Status:</strong></label>
                                    <input type="text" class="form-control"
                                        value="{{ $formData["employment_status"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_number"><strong>Contact number:</strong></label>
                                    <input type="text" class="form-control" id="phone_number"
                                        value="{{ $formData["phone_number"] }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="container row-6 mt-3 mb-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <label><strong>Additional Information:</strong></label>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" name="pantawid_beneficiary" type="checkbox"
                                            id="pantawid_beneficiary" value="1"
                                            {{ old("pantawid_beneficiary", $formData["pantawid_beneficiary"] ?? false) ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label" for="pantawid_beneficiary">Pantawid
                                            Beneficiary</label>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" name="indigenous_person" type="checkbox"
                                            id="indigenous_person" value="1"
                                            {{ old("indigenous_person", $formData["indigenous_person"] ?? false) ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label" for="indigenous_person">Indigenous
                                            Person</label>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" name="lgbtq_plus" type="checkbox"
                                            id="lgbtq_plus" value="1"
                                            {{ old("lgbtq_plus", $formData["lgbtq_plus"] ?? false) ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label" for="lgbtq_plus">LGBTQ+</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="mt-3">II. FAMILY COMPOSITION</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="familyCompositionTable">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Relationship</strong></th>
                                        <th><strong>Age</strong></th>
                                        <th><strong>Birthday</strong></th>
                                        <th><strong>Civil Status</strong></th>
                                        <th><strong>Educational Attainment</strong></th>
                                        <th><strong>Occupation</strong></th>
                                        <th><strong>Monthly Income</strong></th>
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

                        <h4 class="mt-3"><strong>III. Classification/Circumstances of being a solo parent</strong>
                        </h4>
                        <div class="form-group">
                            <textarea class="form-control" rows="4" disabled>{{ $formData["classification_circumstances"] }}</textarea>
                        </div>

                        <h4 class="mt-3"><strong>IV. Needs/Problems of being a solo parent</strong></h4>
                        <div class="form-group">
                            <textarea class="form-control" rows="4" disabled>{{ $formData["needs_problems"] }}</textarea>
                        </div>

                        <h4 class="mt-3"><strong>V. IN CASE OF EMERGENCY</strong></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_name"><strong>Name:</strong></label>
                                    <input type="text" class="form-control" id="emergency_contact_name"
                                        value="{{ $formData["emergency_contact"]["name"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_relationship"><strong>Relationship:</strong></label>
                                    <input type="text" class="form-control" id="emergency_contact_relationship"
                                        value="{{ $formData["emergency_contact"]["relationship"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_address"><strong>Address:</strong></label>
                                    <input type="text" class="form-control" id="emergency_contact_address"
                                        value="{{ $formData["emergency_contact"]["address"] }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_number"><strong>Contact number:</strong></label>
                                    <input type="text" class="form-control" id="emergency_contact_number"
                                        value="{{ $formData["emergency_contact_number"] ?? "" }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="mb-3 mt-3" style="text-align:center">Required Documents</h4>

                            <ul class="list-group">
                                <!-- Birth Certificate of the child -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.child_birth_cert") is-invalid @enderror"
                                            type="checkbox" name="form_data[child_birth_cert]" id="child_birth_cert"
                                            value="1"
                                            {{ old("form_data.child_birth_cert", $formData["child_birth_cert"] ?? "") ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label" for="child_birth_cert">Referral slip from
                                            referring agency</label>
                                    </div>
                                </li>

                                <!-- Parent Valid ID -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.parent_id") is-invalid @enderror"
                                            type="checkbox" name="form_data[parent_id]" id="parent_id"
                                            value="1"
                                            {{ old("form_data.parent_id", $formData["parent_id"] ?? "") ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label" for="parent_id">Study load</label>
                                    </div>
                                </li>

                                <!-- Barangay Clearance -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.brgy_clearance") is-invalid @enderror"
                                            type="checkbox" name="form_data[brgy_clearance]" id="brgy_clearance"
                                            value="1"
                                            {{ old("form_data.brgy_clearance", $formData["brgy_clearance"] ?? "") ? "checked" : "" }}
                                            disabled>
                                        <label class="form-check-label" for="brgy_clearance">Student ID</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col mb-1 p-4">
                            <div class="form-check">
                                <label class="form-check-label" for="certification">
                                    <input
                                        class="form-check-input @error(" form_data.certification") is-invalid @enderror"
                                        type="checkbox" name="form_data[certification]" id="certification"
                                        value="1"
                                        {{ old("form_data.certification", $formData["certification"] ?? "") ? "checked" : "" }}
                                        disabled>
                                    <p style="text-align:center;" class="text-muted "><small>I hereby certify that the
                                            information given above are true and correct. I further understand that any
                                            misrepresentation that I may have made will subject me to criminal and civil
                                            liabilities provided for by existing laws. In addition, I hereby give my
                                            consent to share the information above to the member agencies of the
                                            Inter-Agency Coordinating and Monitoring Committee on solo parents.</small>
                                    </p>
                                </label>
                            </div>
                        </div>
                        <div class="row" style="text-align: center;">
                            <div class="col-md-6">
                                <input
                                    style="width: 100%; text-align:center; text-transform: uppercase; background-color: transparent; border: 0; border-bottom: 2px solid black;"
                                    value="{{ ($formData["first_name"] ?? "") . " " . ($formData["middle_name"] ?? "") . " " . ($formData["surname"] ?? "") }}"
                                    disabled>
                                <label for="signature-thumbmark" class="col-form-label">Signature / Thumbmark over
                                    Printed Name</label>
                            </div>

                            <div class="col-md-6 mb-1">
                                <input id="date" style="width: 100%; text-transform: uppercase;"
                                    value="{{ \Carbon\Carbon::parse($beneficiary->created_at)->format("F j, Y") }}"
                                    disabled>
                                <label for="date" class="col-form-label">Date of Registration</label>
                            </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center printable-area remove-display-print-view">
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
                        <h4>APPLICATION FORM FOR SOLO PARENT</h4>
                    </div>
                </div>
        <div class="form-section">
            <h5 class="section-title">I. IDENTIFYING INFORMATION</h5>

            <!-- Full Name, Age, Sex -->
            <div class="input-row mt-2 row">
                <div class="input-item col-md-6"> <!-- Full Name takes up 7 out of 12 columns -->
                    Full Name:
                    <span class="input-line w-100">
                        {{ $formData['first_name'] }} {{ $formData['middle_name'] }} {{ $formData['surname'] }}
                        {{ $formData['name_extension'] && $formData['name_extension'] !== 'N/A' ? ' ' . $formData['name_extension'] : '' }}
                    </span>
                </div>
                <div class="input-item col-md-6"> <!-- Age takes up 3 out of 12 columns -->
                    Age:
                    <span class="input-line w-100">{{ $formData['age'] }} </span>
                </div>
            </div>

            <div class="input-row row">
                <div class="input-item col-md-6"> <!-- Sex takes up 3 out of 12 columns -->
                    Sex:
                    <span class="input-line w-100">{{ $formData['sex'] }} </span>
                </div>
                <div class="input-item col-md-6"> <!-- Date of Birth takes up 3 out of 12 columns -->
                    Date of Birth:
                    <span class="input-line w-100">{{ $formData['dob'] }} </span>
                </div>
            </div>

            <div class="input-row row">
                <div class="input-item col-md-6"> <!-- Place of Birth takes up 6 out of 12 columns -->
                    Place of Birth:
                    <span class="input-line w-100">{{ $formData['place_of_birth'] }} </span>
                </div>
                <div class="input-item col-md-6"> <!-- Address takes up 6 out of 12 columns -->
                    Address:
                    <span class="input-line w-100">{{ $formData['address'] }} </span>
                </div>
            </div>

            <div class="input-row row">
                <div class="input-item col-md-6"> <!-- Educational Attainment takes up 6 out of 12 columns -->
                    Educational Attainment:
                    <span class="input-line w-100">{{ $formData['educational_attainment'] }} </span>
                </div>
                <div class="input-item col-md-6"> <!-- Civil Status takes up 6 out of 12 columns -->
                    Civil Status:
                    <span class="input-line w-100">{{ $formData['civil_status'] }} </span>
                </div>
            </div>

            <!-- Occupation, Religion -->
            <div class="input-row row">
                <div class="input-item col-md-6"> <!-- Occupation takes up 6 out of 12 columns -->
                    Occupation:
                    <span class="input-line w-100">{{ $formData['occupation'] }} </span>
                </div>
                <div class="input-item col-md-6"> <!-- Religion takes up 6 out of 12 columns -->
                    Religion:
                    <span class="input-line w-100">{{ $formData['religion'] }} </span>
                </div>
            </div>

            <!-- Company/Agency, Monthly Income -->
            <div class="input-row row">
                <div class="input-item col-md-6"> <!-- Company/Agency takes up 6 out of 12 columns -->
                    Company/Agency:
                    <span class="input-line w-100">{{ $formData['company_agency'] }} </span>
                </div>
                <div class="input-item col-md-6"> <!-- Monthly Income takes up 6 out of 12 columns -->
                    Monthly Income:
                    <span class="input-line w-100">{{ $formData['monthly_income'] }} </span>
                </div>
            </div>

            <!-- Employment Status -->
            <div class="input-row row">
                <div class="input-item col-md-6"> <!-- Employment Status takes up 6 out of 12 columns -->
                    Employment Status:
                    <span class="input-line w-100">{{ $formData['employment_status'] }}</span>
                </div>
                <div class="input-item col-md-6"> <!-- Contact Number takes up 6 out of 12 columns -->
                    Contact number/s:
                    <span class="input-line w-100">{{ $formData['phone_number'] }}</span>
                </div>
            </div>


            <!-- Pantawid Beneficiary, Indigenous Person, LGBTQ+ -->
            <div class="input-row">
                <div class="input-item">
                    Pantawid Beneficiary? ____Y ____N
                </div>
                <div class="input-item">
                    Indigenous Person? ____Y ____N
                </div>
                <div class="input-item">
                    LGBTQ+? ____Y ____N
                </div>
            </div>
        </div>


        <div class="form-section">
            <h5 class="section-title">II. FAMILY COMPOSITION</h5>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name (First, Middle, Last)</th>
                        <th>Relationship</th>
                        <th>Age</th>
                        <th>Birthday (mm/dd/yy)</th>
                        <th>Civil Status</th>
                        <th>Educational Attainment</th>
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

            <p><strong>NOTE:</strong> Include family member and other members of the household especially minor children. Use back side for additional members.</p>
        </div>

        <div class="form-section">
            <h5 class="section-title">III. Classification/Circumstances of being a solo parent (Dahilan bakit naging solo parent)?</h5>
            <div style="width: 100%; height: 50px;">{{ $formData["classification_circumstances"] }}</div>
        </div>

        <div class="form-section">
            <h5 class="section-title">IV. Needs/Problems of being a solo parent (Kinakailangan/Problema ng isang solo parent)?</h5>
            <div style="width: 100%; height: 50px;">{{ $formData["needs_problems"] }}</div>
        </div>

        <div class="form-section">
            <h5 class="section-title">V. IN CASE OF EMERGENCY</h5>

            <div class="form-row">
                <div class="form-column">
                    Name: <span class="input-line"> {{ $formData["emergency_contact"]["name"] ?? "" }}</span>
                </div>
                <div class="form-column">
                    Relationship: <span class="input-line"> {{ $formData["emergency_contact"]["relationship"] ?? "" }}</span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-column">
                    Address: <span class="input-line"> {{ $formData["emergency_contact"]["address"] ?? "" }}</span>
                </div>
                <div class="form-column">
                    Contact number/s: <span class="input-line"> {{ $formData["emergency_contact_number"] ?? "" }}</span>
                </div>
            </div>
        </div>


        <div class="footer-section">
            <div class="certification-text">
                I hereby certify that the information given above are true and correct. I further understand that any misinterpretation that may have made will subject me to criminal and civil liabilities provided for by existing laws. In addition, I hereby give my consent to share the information above to the member agencies of the Inter-Agency Coordinating and Monitoring Committee on solo parents.
            </div>

            <div style="display: flex; justify-content: space-between; margin-top: 50px;">
                <div style="text-align: center; width: 45%;">
                    <div class="input-line" style="width: 100%;">{{ $formData['first_name'] }} {{ $formData['middle_name'] }} {{ $formData['surname'] }}{{ $formData['name_extension'] && $formData['name_extension'] !== 'N/A' ? ' ' . $formData['name_extension'] : '' }}
                    </div>
                    Signature/Thumbmark over Printed Name
                </div>
                <div style="text-align: center; width: 45%;">
                    <div class="input-line" style="width: 100%;">
                        <!-- Check if applications exists and then format the created_at -->
                        {{ \Carbon\Carbon::parse($beneficiary->created_at)->format("F j, Y") }}
                    </div>
                    Date
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    .form-check {
        margin-right: 20px;
        /* Adjust the margin between options as needed */
    }

    /* Specific styles for disabled inputs */
    .form-control:disabled {
        background-color: #e9ecef;
        /* Light gray background for all disabled inputs */
    }

    /* Override styles for specific inputs */
    #date,
    #signature-thumbmark {
        background-color: #ffffff !important;
        /* White background */
        border: none;
        /* Remove default border */
        border-bottom: 2px solid #000000;
        /* Black bottom border */
        color: #000000;
        /* Black text color for contrast */
        text-align: center;
        /* Center the text */
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

    .form-row {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 10px;
                }

                .form-column {
                    width: 48%;
                    /* Adjust the width of each column to fit within the row */
                    padding: 5px;
                }

                .input-row {
                    display: flex;
                    flex-wrap: wrap;
                    margin-bottom: 15px;
                    justify-content: space-between;
                    /* Distribute space evenly */
                }

                .input-item {
                    flex: 1;
                    min-width: 30%;
                    /* Minimum width for columns */
                    margin-right: 20px;
                    box-sizing: border-box;
                }

                .input-item.full-width {
                    flex: 1;
                    min-width: 100%;
                    /* Make this item full width (e.g. for address) */
                }

                .checkbox-group {
                    display: flex;
                    justify-content: space-between;
                }

                .input-line {
                    font-weight: bold;
                    text-align: center;
                }

                .label {
                    font-weight: bold;
                }

                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                }

                .header {
                    text-align: center;
                    margin-bottom: 10px;
                }

                .form-section {
                    margin-bottom: 10px;
                }

                .section-title {
                    font-weight: bold;
                    margin-top: 10px;
                }

                .input-line {
                    border-bottom: 1px solid black;
                    display: inline-block;
                    width: 200px;
                }

                .checkbox-group {
                    display: inline-block;
                    margin-right: 20px;
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

                .footer-section {
                    font-size: 14px;
                    line-height: 1.6;
                }

                .status-section {
                    display: flex;
                    align-items: center;
                    margin-bottom: 10px;
                }

                .status-label {
                    font-weight: bold;
                    margin-right: 10px;
                }

                .status-options {
                    display: flex;
                    justify-content: space-between;
                    width: 70%;
                    /* Adjust this width as needed */
                }

                .status-option {
                    flex: 1;
                    text-align: center;
                }

                .status-option input {
                    margin-right: 5px;
                }

                .solo-parent-info {
                    margin-top: 15px;
                }

                .info-row {
                    margin-bottom: 10px;
                }

                .info-row label {
                    font-weight: bold;
                    margin-right: 10px;
                }

                .info-row span {
                    font-weight: normal;
                    border-bottom: 1px solid #000;
                    padding: 0 5px;
                    display: inline-block;
                    width: 200px;
                    /* You can adjust the width of these lines */
                }


                .certification-text {
                    text-align: justify;
                    margin-top: 10px;
                }

                .form-group {
                    margin-bottom: 15px;
                }

                .form-check-group {
                    display: flex;
                    justify-content: space-between;
                    /* Distribute space evenly between options */
                }
</style>

</html>
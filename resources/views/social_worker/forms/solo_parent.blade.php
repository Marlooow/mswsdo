@extends("layouts.app")
@section("content")
<form id="applicationForm" action="{{ route("social_worker.store") }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="program_id" value="4">
    <div class="container">
        <div class="row justify-content-center">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- HEADER -->
                        <div class="row mb-4">
                            <div class="col-md-2">
                                <img src="{{ asset("/images/logo.png") }}" alt="Logo" height="auto" width="100"
                                    class="img-fluid">
                            </div>
                            <div class="col-md-8 text-center">
                                <h5 class="font-weight-bold">Republic of the Philippines</h5>
                                <p>Municipal Social Welfare and Development Office</p>
                                <p>Manolo Fortich, Bukidnon/Region 10</p>
                            </div>
                        </div>
                        <h2 class="text-center mb-4">APPLICATION FORM FOR SOLO PARENT</h2>
                        <!-- Beneficiary Search Section -->
                        <div class="row m-2">
                            <div class="col offset-md-6"> <!-- Adjusted to position on the right -->
                                <div class="input-group">
                                    <input type="text" id="beneficiarySearch" class="form-control" style="font-size:13px;" placeholder="Search Beneficiary For Pre-fill (Surname, First Name, Middle Name)">
                                    <button class="btn btn-primary" type="button" id="searchButton">Search</button>
                                </div>
                                <div id="searchResults" class="mt-1">
                                    <!-- Search results will be dynamically populated here -->
                                </div>
                            </div>
                        </div>
                        <!-- IDENTIFYING INFORMATION -->
                        <h4 class="mt-4">I. IDENTIFYING INFORMATION</h4>
                        <div class="row">
                            <!-- Surname -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="surname">Surname:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.surname") is-invalid @enderror"
                                        id="surname" name="form_data[surname]"
                                        value="{{ old("form_data.surname", $formData["surname"] ?? "") }}" required>
                                    @error("form_data.surname")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- First Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.first_name") is-invalid @enderror"
                                        id="first_name" name="form_data[first_name]"
                                        value="{{ old("form_data.first_name", $formData["first_name"] ?? "") }}"
                                        required>
                                    @error("form_data.first_name")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Middle Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.middle_name") is-invalid @enderror"
                                        id="middle_name" name="form_data[middle_name]"
                                        value="{{ old("form_data.middle_name", $formData["middle_name"] ?? "") }}">
                                    @error("form_data.middle_name")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Name Extension -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_extension">Name Extension:</label>
                                    <select id="name_extension"
                                        class="form-control @error(" form_data.name_extension") is-invalid @enderror"
                                        name="form_data[name_extension]">
                                        <option value="N/A"
                                            {{ old("form_data.name_extension", $formData["name_extension"] ?? "N/A") == "N/A" ? "selected" : "" }}>
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
                            <!-- Date of Birth -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">Date of Birth:</label>
                                    <input type="date"
                                        class="form-control @error(" form_data.dob") is-invalid @enderror"
                                        id="dob" name="form_data[dob]"
                                        value="{{ old("form_data.dob", $formData["dob"] ?? "") }}"
                                        required>
                                    @error("form_data.dob")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="age">Age:</label>
                                    <input type="number"
                                        class="form-control @error(" form_data.age") is-invalid @enderror" id="age"
                                        name="form_data[age]"
                                        value="{{ old("form_data.age", $formData["age"] ?? "") }}" required readonly>
                                    @error("form_data.age")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sex">Sex:</label>
                                    <select id="sex" class="form-control" name="form_data[sex]" required>
                                        <option value="Male"
                                            {{ old("form_data.sex", $formData["sex"] ?? "") == "male" ? "selected" : "" }}>
                                            Male</option>
                                        <option value="Female"
                                            {{ old("form_data.sex", $formData["sex"] ?? "") == "female" ? "selected" : "" }}>
                                            Female</option>
                                    </select>
                                    @error("form_data.sex")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="place_of_birth">Place of Birth:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.place_of_birth") is-invalid @enderror"
                                        id="place_of_birth" name="form_data[place_of_birth]"
                                        value="{{ old("form_data.place_of_birth", $formData["place_of_birth"] ?? "") }}">
                                    @error("form_data.place_of_birth")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.address") is-invalid @enderror"
                                        id="address" name="form_data[address]"
                                        value="{{ old("form_data.address", $formData["address"] ?? "") }}" required>
                                    @error("form_data.address")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="educational_attainment">Educational Attainment:</label>
                                    <select id="educational_attainment"
                                        class="form-control @error(" form_data.educational_attainment") is-invalid @enderror"
                                        name="form_data[educational_attainment]" required>
                                        <option value="Primary"
                                            {{ old("form_data.educational_attainment") == "Primary" ? "selected" : "" }}>
                                            Primary</option>
                                        <option value="Secondary"
                                            {{ old("form_data.educational_attainment") == "Secondary" ? "selected" : "" }}>
                                            Secondary</option>
                                        <option value="Vocational"
                                            {{ old("form_data.educational_attainment") == "Vocational" ? "selected" : "" }}>
                                            Vocational</option>
                                        <option value="Tertiary"
                                            {{ old("form_data.educational_attainment") == "Tertiary" ? "selected" : "" }}>
                                            Tertiary</option>
                                    </select>
                                    @error("form_data.educational_attainment")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="civil_status">Civil Status:</label>
                                    <select id="civil_status"
                                        class="form-control @error(" form_data.civil_status") is-invalid @enderror"
                                        name="form_data[civil_status]" required>
                                        <option value="Single"
                                            {{ old("form_data.civil_status") == "Single" ? "selected" : "" }}>Single
                                        </option>
                                        <option value="Married"
                                            {{ old("form_data.civil_status") == "Married" ? "selected" : "" }}>Married
                                        </option>
                                        <option value="Widowed"
                                            {{ old("form_data.civil_status") == "Widowed / Widower" ? "selected" : "" }}>
                                            Widowed / Widower</option>
                                        <option value="Legally Separated"
                                            {{ old("form_data.civil_status") == "Legally Separated" ? "selected" : "" }}>
                                            Legally Separated</option>
                                    </select>
                                    @error("form_data.civil_status")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="occupation">Occupation:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.occupation") is-invalid @enderror"
                                        id="occupation" name="form_data[occupation]"
                                        value="{{ old("form_data.occupation", $formData["occupation"] ?? "") }}"
                                        required>
                                    @error("form_data.occupation")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="religion">Religion:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.religion") is-invalid @enderror"
                                        id="religion" name="form_data[religion]"
                                        value="{{ old("form_data.religion", $formData["religion"] ?? "") }}">
                                    @error("form_data.religion")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_agency">Company/Agency:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.company_agency") is-invalid @enderror"
                                        id="company_agency" name="form_data[company_agency]"
                                        value="{{ old("form_data.company_agency", $formData["company_agency"] ?? "") }}">
                                    @error("form_data.company_agency")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monthly_income">Monthly Income:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.monthly_income") is-invalid @enderror"
                                        id="monthly_income" name="form_data[monthly_income]"
                                        value="{{ old("form_data.monthly_income", $formData["monthly_income"] ?? "") }}"
                                        oninput="formatCurrency(this)" placeholder="Enter amount">
                                    @error("form_data.monthly_income")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employment_status">Employment Status:</label>
                                    <select
                                        class="form-control @error(" form_data.employment_status") is-invalid @enderror"
                                        id="employment_status" name="form_data[employment_status]">
                                        <option value="employed"
                                            {{ old("form_data.employment_status") == "employed" ? "selected" : "" }}>
                                            Employed</option>
                                        <option value="self-employed"
                                            {{ old("form_data.employment_status") == "self-employed" ? "selected" : "" }}>
                                            Self-employed</option>
                                        <option value="not-employed"
                                            {{ old("form_data.employment_status") == "not-employed" ? "selected" : "" }}>
                                            Not employed</option>
                                    </select>
                                    @error("form_data.employment_status")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_number">Contact number:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+63</span>
                                        <input type="text"
                                            class="form-control @error(" form_data.phone_number") is-invalid @enderror"
                                            id="phone_number" name="form_data[phone_number]"
                                            value="{{ old("form_data.phone_number", $formData["phone_number"] ?? "") }}"
                                            placeholder="9123456789" maxlength="10" pattern="\d{10}"
                                            title="Please enter exactly 10 digits for the contact number.">
                                    </div>
                                    @error("form_data.phone_number")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                            {{ old("pantawid_beneficiary", $formData["pantawid_beneficiary"] ?? false) ? "checked" : "" }}>
                                        <label class="form-check-label" for="pantawid_beneficiary">Pantawid
                                            Beneficiary</label>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" name="indigenous_person" type="checkbox"
                                            id="indigenous_person" value="1"
                                            {{ old("indigenous_person", $formData["indigenous_person"] ?? false) ? "checked" : "" }}>
                                        <label class="form-check-label" for="indigenous_person">Indigenous
                                            Person</label>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" name="lgbtq_plus" type="checkbox"
                                            id="lgbtq_plus" value="1"
                                            {{ old("lgbtq_plus", $formData["lgbtq_plus"] ?? false) ? "checked" : "" }}>
                                        <label class="form-check-label" for="lgbtq_plus">LGBTQ+</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h4 class="mt-4">II. FAMILY COMPOSITION</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="familyCompositionTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Relationship</th>
                                        <th>Birthday</th>
                                        <th>Age</th>
                                        <th>Civil Status</th>
                                        <th>Educational Attainment</th>
                                        <th>Occupation</th>
                                        <th>Monthly Income</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Existing row structure for family members -->
                                    @if (isset($formData["family_composition"]) && is_array($formData["family_composition"]))
                                    @foreach ($formData["family_composition"] as $member)
                                    <div class="family-member">
                                        <tr class="family-member-row" data-index="0">
                                            <td><input type="text" class="form-control"
                                                    name="form_data[family_composition][0][name]"
                                                    value="{{ $member["name"] ?? "Not provided" }}" required>
                                            </td>
                                            <td><input type="text" class="form-control"
                                                    name="form_data[family_composition][0][relationship]"
                                                    value="{{ $member["relationship"] ?? "Not provided" }}"
                                                    required></td>
                                            <td><input type="date" class="form-control birthdate"
                                                    name="form_data[family_composition][0][birthdate]"
                                                    value="{{ $member["birthdate"] ?? "Not provided" }}"
                                                    required></td>
                                            <td><input type="number" class="form-control age"
                                                    name="form_data[family_composition][0][age]"
                                                    value="{{ $member["age"] ?? "Not provided" }}" required
                                                    readonly></td>
                                            <td>
                                                <select class="form-control"
                                                    name="form_data[family_composition][0][civil_status]"
                                                    value="{{ $member["civil_status"] ?? "Not provided" }}"
                                                    required>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed / Widower">Widowed / Widower
                                                    </option>
                                                    <option value="Legally Separated">Legally Separated
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control"
                                                    name="form_data[family_composition][0][educational_attainment]"
                                                    value="{{ $member["educational_attainment"] ?? "Not provided" }}"
                                                    required>
                                                    <option value="Primary">Primary</option>
                                                    <option value="Secondary">Secondary</option>
                                                    <option value="Vocational">Vocational</option>
                                                    <option value="Tertiary">Tertiary</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control"
                                                    name="form_data[family_composition][0][occupation]"
                                                    value="{{ $member["occupation"] ?? "Not provided" }}">
                                            </td>
                                            <td><input type="number" class="form-control"
                                                    name="form_data[family_composition][0][monthly_income]"
                                                    value="{{ $member["monthly_income"] ?? "Not provided" }}"
                                                    min="0"></td>
                                        </tr>
                                    </div>
                                    @endforeach
                                    @endif
                                    <tr class="family-member-row" data-index="0">
                                        <td><input type="text" class="form-control"
                                                name="form_data[family_composition][0][name]" required></td>
                                        <td><input type="text" class="form-control"
                                                name="form_data[family_composition][0][relationship]" required></td>
                                        <td><input type="date" class="form-control birthdate"
                                                name="form_data[family_composition][0][birthdate]" required></td>
                                        <td><input type="number" class="form-control age"
                                                name="form_data[family_composition][0][age]" required readonly></td>
                                        <td>
                                            <select class="form-control"
                                                name="form_data[family_composition][0][civil_status]" required>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed / Widower">Widowed / Widower</option>
                                                <option value="Legally Separated">Legally Separated</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control"
                                                name="form_data[family_composition][0][educational_attainment]"
                                                required>
                                                <option value="Primary">Primary</option>
                                                <option value="Secondary">Secondary</option>
                                                <option value="Vocational">Vocational</option>
                                                <option value="Tertiary">Tertiary</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control"
                                                name="form_data[family_composition][0][occupation]"></td>
                                        <td><input type="number" class="form-control"
                                                name="form_data[family_composition][0][monthly_income]"
                                                min="0"></td>
                                        <td><button type="button" class="btn btn-danger btn-sm removeRow"
                                                data-index="0">Remove</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-8 p-2">
                            <div>
                                <button type="button" class="btn btn-primary" id="addFamilyMember">Add Family
                                    Member</button>
                            </div>
                            <small class="form-text text-muted">NOTE: Include family member and other members of the
                                household especially minor children.</small>
                        </div>


                        <!-- III. Classification/Circumstances -->
                        <h4 class="mt-4">III. Classification/Circumstances of Being a Solo Parent (Dahilan bakit
                            naging solo parent)?</h4>
                        <div class="form-group">
                            <textarea class="form-control @error(" form_data.classification_circumstances") is-invalid @enderror" rows="4"
                                name="form_data[classification_circumstances]" required>{{ old("form_data.classification_circumstances", $formData["classification_circumstances"] ?? "") }}</textarea>
                            @error("form_data.classification_circumstances")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- IV. Needs/Problems -->
                        <h4 class="mt-4">IV. Needs/Problems of Being a Solo Parent (Kinakailangan/Problema ng isang
                            solo parent)?</h4>
                        <div class="form-group">
                            <textarea class="form-control @error(" form_data.needs_problems") is-invalid @enderror" rows="4"
                                name="form_data[needs_problems]" required>{{ old("form_data.needs_problems", $formData["needs_problems"] ?? "") }}</textarea>
                            @error("form_data.needs_problems")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- V. Emergency Contact -->
                        <h4 class="mt-4">V. IN CASE OF EMERGENCY</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_name">Name:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.emergency_contact.name") is-invalid @enderror"
                                        id="emergency_contact_name" name="form_data[emergency_contact][name]"
                                        value="{{ old("form_data.emergency_contact.name", $formData["emergency_contact"]["name"] ?? "") }}">
                                    @error("form_data.emergency_contact.name")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_relationship">Relationship:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.emergency_contact.relationship") is-invalid @enderror"
                                        id="emergency_contact_relationship"
                                        name="form_data[emergency_contact][relationship]"
                                        value="{{ old("form_data.emergency_contact.relationship", $formData["emergency_contact"]["relationship"] ?? "") }}">
                                    @error("form_data.emergency_contact.relationship")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_address">Address:</label>
                                    <input type="text"
                                        class="form-control @error(" form_data.emergency_contact.address") is-invalid @enderror"
                                        id="emergency_contact_address" name="form_data[emergency_contact][address]"
                                        value="{{ old("form_data.emergency_contact.address", $formData["emergency_contact"]["address"] ?? "") }}">
                                    @error("form_data.emergency_contact.address")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_number">Contact Number:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+63</span>
                                        <input type="text"
                                            class="form-control @error(" form_data.emergency_contact_number") is-invalid @enderror"
                                            id="emergency_contact_number" name="form_data[emergency_contact_number]"
                                            value="{{ old("form_data.emergency_contact_number", $formData["emergency_contact_number"] ?? "") }}"
                                            placeholder="9123456789" maxlength="10" pattern="\d{10}"
                                            title="Please enter exactly 10 digits for the contact number.">
                                    </div>
                                    @error("form_data.emergency_contact_number")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Required Documents -->
                        <div class="form-group">
                            <h4 class="mb-3 mt-3 text-center">Required Documents</h4>
                            <ul class="list-group">
                                <!-- Birth Certificate -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.child_birth_cert") is-invalid @enderror"
                                            type="checkbox" name="form_data[child_birth_cert]" id="child_birth_cert"
                                            value="1" required
                                            {{ old("form_data.child_birth_cert", $formData["child_birth_cert"] ?? "") ? "checked" : "" }}>
                                        <label class="form-check-label" for="child_birth_cert">
                                            Birth Certificate of the child
                                        </label>
                                    </div>
                                </li>
                                <!-- Parent Valid ID -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.parent_id") is-invalid @enderror"
                                            type="checkbox" name="form_data[parent_id]" id="parent_id"
                                            value="1" required
                                            {{ old("form_data.parent_id", $formData["parent_id"] ?? "") ? "checked" : "" }}>
                                        <label class="form-check-label" for="parent_id">
                                            Parent valid ID
                                        </label>
                                    </div>
                                </li>
                                <!-- Barangay Clearance -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error(" form_data.brgy_clearance") is-invalid @enderror"
                                            type="checkbox" name="form_data[brgy_clearance]" id="brgy_clearance"
                                            value="1" required
                                            {{ old("form_data.brgy_clearance", $formData["brgy_clearance"] ?? "") ? "checked" : "" }}>
                                        <label class="form-check-label" for="brgy_clearance">
                                            Barangay Clearance
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Certification -->
                        <div class="col mb-1 p-4">
                            <div class="form-check">
                                <input class="form-check-input @error(" form_data.certification") is-invalid @enderror"
                                    type="checkbox" name="form_data[certification]" id="certification"
                                    value="1" required
                                    {{ old("form_data.certification", $formData["certification"] ?? "") ? "checked" : "" }}>
                                <label class="form-check-label" for="certification">
                                    <p class="text-muted"><small>
                                            I hereby certify that the information given above is true and correct. I
                                            further understand that any misrepresentation that I may have made will
                                            subject me to criminal and civil liabilities provided for by existing laws.
                                            In addition, I hereby give my consent to share the information above with
                                            the member agencies of the Inter-Agency Coordinating and Monitoring
                                            Committee on solo parents.
                                        </small></p>
                                </label>
                            </div>
                            @error("form_data.certification")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" style="display: flex; justify-content: flex-end;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" style="margin-left: 10px;"
                                onclick="window.history.back();">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
<script src="/assets/jquery.js"></script>
<script>
    function formatCurrency(input) {
        let value = parseFloat(input.value.replace(/,/g, ''));
        if (isNaN(value)) {
            input.value = '';
        } else {
            input.value = value.toLocaleString('en-US', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('applicationForm');
        const dateOfBirthInput = document.getElementById('dob');
        const ageInput = document.getElementById('age');
        const sexSelect = document.getElementById('sex');
        const nameExtensionSelect = document.getElementById('name_extension');

        // Function to calculate age
        function calculateAge(dateInput, ageInput) {
            const dob = new Date(dateInput.value);

            // Check if the date is valid
            if (isNaN(dob)) {
                alert('Invalid birthdate.');
                dateInput.value = ''; // Clear the date input field
                ageInput.value = ''; // Clear the age input field
                return;
            }

            // Check if the birthdate is in the future
            const today = new Date();
            if (dob > today) {
                alert('Birthdate should not exceed current date.');
                dateInput.value = ''; // Clear the date input field
                ageInput.value = ''; // Clear the age input field
                return;
            }

            // Calculate the age
            let age = today.getFullYear() - dob.getFullYear();
            const monthDifference = today.getMonth() - dob.getMonth();

            // Adjust age if birthday hasn't occurred yet this year
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            // Set the calculated age
            ageInput.value = age;
        }

        // Function to handle changes in the sex field
        function handleSexChange() {
            if (sexSelect.value === 'female') {
                nameExtensionSelect.value = 'N/A';
            }
        }

        // Function to handle changes in the name extension field
        function handleNameExtensionChange() {
            if (nameExtensionSelect.value !== 'N/A') {
                sexSelect.value = 'male';
            }
        }

        // Function to validate Monthly Income
        function validateIncome(input) {
            if (input.value < 0) {
                alert('Monthly Income cannot be negative.');
                input.value = ''; // Clear the input
            }
        }

        // Initial age calculation
        dateOfBirthInput.addEventListener('change', function() {
            calculateAge(this, ageInput);
        });

        // Sex and Name Extension event listeners
        sexSelect.addEventListener('change', handleSexChange);
        nameExtensionSelect.addEventListener('change', handleNameExtensionChange);

        // Add and Remove Family Members
        const addButton = document.getElementById('addFamilyMember');
        const tableBody = document.querySelector('#familyCompositionTable tbody');

        let rowIndex = 1;

        addButton.addEventListener('click', function() {
            const newRow = document.createElement('tr');
            newRow.classList.add('family-member-row');
            newRow.dataset.index = rowIndex;

            newRow.innerHTML = `
                <td><input type="text" class="form-control" name="form_data[family_composition][${rowIndex}][name]" required></td>
                <td><input type="text" class="form-control" name="form_data[family_composition][${rowIndex}][relationship]" required></td>
                <td><input type="date" class="form-control birthdate" name="form_data[family_composition][${rowIndex}][birthdate]" required></td>
                <td><input type="number" class="form-control age" name="form_data[family_composition][${rowIndex}][age]" required readonly></td>
                <td>
                    <select class="form-control" name="form_data[family_composition][${rowIndex}][civil_status]" required>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed / Widower">Widowed / Widower</option>
                        <option value="Legally Separated">Legally Separated</option>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="form_data[family_composition][${rowIndex}][educational_attainment]" required>
                        <option value="Primary">Primary</option>
                        <option value="Secondary">Secondary</option>
                        <option value="Vocational">Vocational</option>
                        <option value="Tertiary">Tertiary</option>
                    </select>
                </td>
                <td><input type="text" class="form-control" name="form_data[family_composition][${rowIndex}][occupation]"></td>
                <td><input type="number" class="form-control monthly-income" name="form_data[family_composition][${rowIndex}][monthly_income]" min="0"></td>
                <td><button type="button" class="btn btn-danger btn-sm removeRow" data-index="${rowIndex}">Remove</button></td>
            `;

            tableBody.appendChild(newRow);

            // Add event listener for the birthdate input in the new row
            newRow.querySelector('.birthdate').addEventListener('change', function() {
                calculateAge(this, newRow.querySelector('.age'));
            });

            // Add event listener for Monthly Income validation
            newRow.querySelector('.monthly-income').addEventListener('input', function() {
                validateIncome(this);
            });

            rowIndex++;
        });

        tableBody.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeRow')) {
                e.target.closest('tr').remove();
            }
        });

        // Add event listeners to existing rows
        document.querySelectorAll('.family-member-row .birthdate').forEach(function(element) {
            element.addEventListener('change', function() {
                const ageInput = this.closest('tr').querySelector('.age');
                calculateAge(this, ageInput);
            });
        });

        document.querySelectorAll('.family-member-row .monthly-income').forEach(function(element) {
            element.addEventListener('input', function() {
                validateIncome(this);
            });
        });

        // Form validation function
        function validateForm() {
            let isValid = true;
            const requiredFields = {
                'surname': 'Surname is required',
                'first_name': 'First name is required',
                'age': 'Age is required',
                'address': 'Address is required',
                'monthly_income': 'Amount is required'
            };

            // Clear all previous errors first
            clearAllErrors();

            // Validate each required field
            for (const [fieldId, errorMessage] of Object.entries(requiredFields)) {
                const field = document.getElementById(fieldId);
                if (!field.value.trim()) {
                    showError(field, errorMessage);
                    isValid = false;
                }
            }

            // Scroll to first error if any
            if (!isValid) {
                const firstError = document.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }

            return isValid;
        }

        function showError(input, message) {
            input.classList.add('error');
            input.style.borderColor = '#dc3545';

            const error = document.createElement('span');
            error.className = 'validation-error';
            error.textContent = message;

            // Remove any existing error message before adding new one
            removeError(input);
            input.parentNode.insertBefore(error, input.nextSibling);
        }

        function removeError(input) {
            const nextSibling = input.nextSibling;
            if (nextSibling && nextSibling.classList && nextSibling.classList.contains('validation-error')) {
                nextSibling.remove();
            }
        }

        function clearAllErrors() {
            document.querySelectorAll('.validation-error').forEach(error => error.remove());
            document.querySelectorAll('.error').forEach(input => {
                input.classList.remove('error');
                input.style.borderColor = 'black';
            });
        }
    });

    // document.addEventListener('DOMContentLoaded', function() {
    //     const nameOfAssociation = document.getElementById('name_of_association');
    //     const addressOfAssociation = document.getElementById('address_of_association');
    //     const dateOfMembership = document.getElementById('date_of_membership');
    //     const officerDateElected = document.getElementById('officer_date_elected');
    //     const officerPosition = document.getElementById('officer_position');
    //     const form = document.getElementById('applicationForm');

    //     // Function to handle changes in the association name input
    //     nameOfAssociation.addEventListener('input', function() {
    //         if (this.value === 'N/A') {
    //             // Disable and clear the associated fields
    //             addressOfAssociation.disabled = true;
    //             addressOfAssociation.value = '';
    //             dateOfMembership.disabled = true;
    //             dateOfMembership.value = '';
    //             officerDateElected.disabled = true;
    //             officerDateElected.value = '';
    //             officerPosition.disabled = true;
    //             officerPosition.value = '';
    //         } else {
    //             // Enable the fields
    //             addressOfAssociation.disabled = false;
    //             dateOfMembership.disabled = false;
    //             officerDateElected.disabled = false;
    //             officerPosition.disabled = false;
    //         }
    //     });


    // });

    document.addEventListener('DOMContentLoaded', function() {
        const programId = "{{ $selectedProgram->id }}"; // Pass this from the blade
        const searchInput = document.getElementById('beneficiarySearch');
        const searchButton = document.getElementById('searchButton');
        const searchResults = document.getElementById('searchResults');

        searchButton.addEventListener('click', performBeneficiarySearch);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performBeneficiarySearch();
            }
        });

        function performBeneficiarySearch() {
            const searchTerm = searchInput.value.trim();

            if (searchTerm.length < 2) {
                alert('Please enter at least 2 characters');
                return;
            }

            $.ajax({
                url: `/social-worker/${programId}/search-beneficiaries`,
                method: 'GET',
                data: {
                    search_term: searchTerm
                },
                success: function(response) {
                    displaySearchResults(response.beneficiaries);
                },
                error: function() {
                    alert('An error occurred during search');
                }
            });
        }

        function displaySearchResults(beneficiaries) {
            searchResults.innerHTML = ''; // Clear previous results

            if (beneficiaries.length === 0) {
                searchResults.innerHTML = '<p class="text-muted">No beneficiaries found</p>';
                return;
            }

            const resultList = document.createElement('ul');
            resultList.className = 'list-group';

            beneficiaries.forEach(beneficiary => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item list-group-item-action';
                listItem.textContent = beneficiary.name;

                listItem.addEventListener('click', function() {
                    // Fetch and prefill beneficiary details
                    fetchBeneficiaryDetails(beneficiary.id);
                    // Clear search results
                    searchResults.innerHTML = '';
                });

                resultList.appendChild(listItem);
            });

            searchResults.appendChild(resultList);
        }

        function fetchBeneficiaryDetails(beneficiaryId) {
            $.ajax({
                url: `/social-worker/${programId}/beneficiary/${beneficiaryId}/details`,
                method: 'GET',
                success: function(response) {
                    // Prefill form fields
                    prefillFormFields(response);
                },
                error: function() {
                    alert('Failed to fetch beneficiary details');
                }
            });
        }

        function prefillFormFields(beneficiaryData) {
            // Map beneficiary data to form fields
            const fieldMappings = {
                'surname': '#surname',
                'first_name': '#first_name',
                'middle_name': '#middle_name',
                'address': '#address',
                'dob': '#dob',
                'age': '#age',
                'sex': '#sex',
                'name_extension': '#name_extension',
                'place_of_birth': '#place_of_birth',
                'phone_number': '#phone_number',
                'civil_status': '#civil_status'
            };

            // Iterate through mappings and set values
            Object.entries(fieldMappings).forEach(([dataKey, selector]) => {
                const field = document.querySelector(selector);
                if (field && beneficiaryData[dataKey]) {
                    field.value = beneficiaryData[dataKey];
                }
            });
            updateConforme();
        }
    });
</script>
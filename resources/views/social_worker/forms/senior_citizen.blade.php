@extends('layouts.app')

@section('content')
<style>
    /* Consistent Dropdown Styling */
    .custom-select-wrapper {
        position: relative;
        display: inline-block;
        width: auto;
    }


    .custom-select-dropdown {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: #fff url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'/></svg>") no-repeat right 12px center;
        background-size: 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 8px 36px 8px 12px;
        font-size: 14px;
        color: #333;
        cursor: pointer;
    }


    .custom-select-dropdown:focus {
        outline: none;
        border-color: #888;
    }
</style>
<form id="applicationForm" action="{{ route('social_worker.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

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
                    <div class="card-header text-center">
                        <h4>Republic of the Philippines</h4>
                        <h5>PROVINCE OF BUKIDNON</h5>
                        <h5>Municipality of Manolo Fortich Bukidnon</h5>
                        <h6>oOo</h6>
                        <h5>OFFICE OF THE SENIOR CITIZENS AFFAIRS</h5>
                        <h3 class="mt-3">REGISTRATION FORM</h3>
                    </div>
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
                    <div class="card-body">
                        <h4 class="mb-3 text-center text-white py-2 rounded" style="background-color: #0d6efd;">
                            Personal Information
                        </h4>

                        <input type="hidden" name="program_id" value="2">
                        <input type="hidden" id="phone_number" name="phone_number" value="N/A">

                        <!-- Surname -->
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">Surname:</label>
                            <div class="col-md-6 mb-1">
                                <input id="surname" type="text" class="form-control "
                                    name="form_data[surname]"
                                    value="{{ old('form_data.surname', $formData['surname'] ?? '') }}" required autofocus>
                                @error('form_data.surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- First Name -->
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First name:</label>
                            <div class="col-md-6 mb-1">
                                <input id="first_name" type="text" class="form-control"
                                    name="form_data[first_name]"
                                    value="{{ old('form_data.first_name', $formData['first_name'] ?? '') }}" required>
                                @error('form_data.first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Middle Name -->
                        <div class="form-group row">
                            <label for="middle_name" class="col-md-4 col-form-label text-md-right">Middle name:</label>
                            <div class="col-md-6 mb-1">
                                <input id="middle_name" type="text" class="form-control @error('form_data.middle_name') is-invalid @enderror"
                                    name="form_data[middle_name]"
                                    value="{{ old('form_data.middle_name', $formData['middle_name'] ?? '') }}">
                                @error('form_data.middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Name Extension -->
                        <div class="form-group row">
                            <label for="name_extension" class="col-md-4 col-form-label text-md-right">Name Extension:</label>
                            <div class="col-md-6 mb-1">
                                <select id="name_extension" class="form-control @error('form_data.name_extension') is-invalid @enderror"
                                    name="form_data[name_extension]">
                                    <option value="N/A" {{ old('form_data.name_extension', $formData['name_extension'] ?? '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                    <option value="JR." {{ old('form_data.name_extension', $formData['name_extension'] ?? '') == 'JR.' ? 'selected' : '' }}>JR.</option>
                                    <option value="SR." {{ old('form_data.name_extension', $formData['name_extension'] ?? '') == 'SR.' ? 'selected' : '' }}>SR.</option>
                                    <option value="III" {{ old('form_data.name_extension', $formData['name_extension'] ?? '') == 'III' ? 'selected' : '' }}>III</option>
                                    <option value="IV" {{ old('form_data.name_extension', $formData['name_extension'] ?? '') == 'IV' ? 'selected' : '' }}>IV</option>
                                </select>
                                @error('form_data.name_extension')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">Sex:</label>
                            <div class="col-md-6 mb-1">
                                <select id="sex" class="form-control @error('form_data.sex') is-invalid @enderror" name="form_data[sex]">
                                    <option value="Male" {{ old('form_data.sex', $form_data['sex'] ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('form_data.sex', $form_data['sex'] ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('form_data.sex')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth:</label>
                            <div class="col-md-3">
                                <input id="dob" type="date" class="form-control @error('form_data.dob') is-invalid @enderror" name="form_data[dob]"
                                    value="{{ old('form_data.dob', $formData['dob'] ?? '') }}" required onchange="calculateAge(this.value)">
                                @error('form_data.dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="age" class="col-md-1 col-form-label text-md-right">Age:</label>
                            <div class="col-md-2 mb-1">
                                <input id="age" type="number" class="form-control @error('form_data.age') is-invalid @enderror"
                                    name="form_data[age]" value="{{ old('form_data.age', $formData['age'] ?? '') }}" required readonly>
                                @error('form_data.age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="place_of_birth" class="col-md-4 col-form-label text-md-right">Place of Birth:</label>
                            <div class="col-md-6 mb-1">
                                <input id="place_of_birth" type="text" class="form-control @error('form_data.place_of_birth') is-invalid @enderror"
                                    name="form_data[place_of_birth]" value="{{ $formData['place_of_birth'] ?? '' }}">
                                @error('form_data.place_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="civil_status" class="col-md-4 col-form-label text-md-right">Civil Status:</label>
                            <div class="col-md-6 mb-1">
                                <select id="civil_status" class="form-control @error('form_data.civil_status') is-invalid @enderror" name="form_data[civil_status]" required>
                                    <option value="Single" {{ old('form_data.civil_status', $form_data['civil_status'] ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                                    <option value="Married" {{ old('form_data.civil_status', $form_data['civil_status'] ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                                    <option value="Widowed" {{ old('form_data.civil_status', $form_data['civil_status'] ?? '') == 'Widowed / Widower' ? 'selected' : '' }}>Widowed / Widower</option>
                                    <option value="Legally Separated" {{ old('form_data.civil_status', $form_data['civil_status'] ?? '') == 'Legally Separated' ? 'selected' : '' }}>Legally Separated</option>
                                </select>
                                @error('form_data.civil_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="educational_attainment" class="col-md-4 col-form-label text-md-right">Educational Attainment:</label>
                            <div class="col-md-6 mb-1">
                                <select id="educational_attainment" class="form-control @error('form_data.educational_attainment') is-invalid @enderror" name="form_data[educational_attainment]" required>
                                    <option value="Primary" {{ old('form_data.educational_attainment', $form_data['educational_attainment'] ?? '') == 'Primary' ? 'selected' : '' }}>Primary</option>
                                    <option value="Secondary" {{ old('form_data.educational_attainment', $form_data['educational_attainment'] ?? '') == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                                    <option value="Vocational" {{ old('form_data.educational_attainment', $form_data['educational_attainment'] ?? '') == 'Vocational' ? 'selected' : '' }}>Vocational</option>
                                    <option value="Tertiary" {{ old('form_data.educational_attainment', $form_data['educational_attainment'] ?? '') == 'Tertiary' ? 'selected' : '' }}>Tertiary</option>
                                </select>
                                @error('form_data.educational_attainment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="occupation" class="col-md-4 col-form-label text-md-right">Occupation:</label>
                            <div class="col-md-6 mb-1">
                                <input id="occupation" type="text" class="form-control @error('form_data.occupation') is-invalid @enderror"
                                    name="form_data[occupation]" value="{{ old('form_data.occupation', $formData['occupation'] ?? '') }}" required>
                                @error('form_data.occupation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address:</label>
                            <div class="col-md-6 mb-1">
                                <input id="address" type="text" class="form-control @error('form_data.address') is-invalid @enderror"
                                    name="form_data[address]" value="{{ old('form_data.address', $formData['address'] ?? '') }}" required>
                                @error('form_data.address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="annual_income" class="col-md-4 col-form-label text-md-right">Annual Income:</label>
                            <div class="col-md-6 mb-1">
                                <input id="annual_income" type="number" class="form-control @error('form_data.annual_income') is-invalid @enderror" name="form_data[annual_income]" value="{{ old('form_data.annual_income', $formData['annual_income'] ?? '') }}" required autofocus>
                                @error('form_data.annual_income')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="other_skills" class="col-md-4 col-form-label text-md-right">Other Skills:</label>
                            <div class="col-md-6 mb-3">
                                <input id="other_skills" type="text" class="form-control @error('form_data.other_skills') is-invalid @enderror" name="form_data[other_skills]" value="{{ old('form_data.other_skills', $formData['other_skills'] ?? '') }}">
                                @error('form_data.other_skills')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- FAMILY COMPOSITION --}}
                        @include('social_worker.forms._family_composition', ['formData' => $formData])

                        <!-- Required Document -->
                        <div class="form-group row">
                            <label for="seniorid" class="col-md-4 col-form-label text-md-right">Required Documents:</label>
                            <div class="col-md-6 mb-1">
                                <input class="form-check-input @error('form_data.seniorid') is-invalid @enderror" type="checkbox" name="form_data[seniorid]" id="seniorid" value="1" required {{ old('form_data.seniorid', $formData['seniorid'] ?? '') ? 'checked' : '' }}>
                                Senior Citizen ID
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <div class="alert alert-info text-center" style="font-weight: bold;">
                                    <span style="color: red;">Note:</span> <span style="color: blue;">THIS REGISTRATION FORM SHALL BE SECURED BY THE SENIOR CITIZENS FROM OSCA AND SUBMIT WITH</span> <span style="color: red;">(2) 1X1 I.D PICTURE (red background)</span> <span style="color: blue;">&</span> <span style="color: red;">1 PHOTOCOPY OF BIRTH CERTIFICATE</span>
                                </div>
                            </div>

                            <div class="col-md-6 mb-1 mt-4">
                                <div class="form-check">
                                    <input class="form-check-input @error('form_data.certification') is-invalid @enderror" type="checkbox" name="form_data[certification]" id="certification" value="1" required {{ old('form_data.certification', $formData['certification'] ?? '') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="certification">
                                        I certify that the above information is true and correct to the best of my knowledge and belief.
                                    </label>
                                </div>
                                @error('form_data.certification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-md-3 offset-md-8"> <!-- Adjust offset to move buttons to the right -->
                                    <button type="submit" class="btn btn-primary">
                                        Submit Registration
                                    </button>
                                    <a href="{{ route('social_worker.index') }}" class="btn btn-danger "> <!-- Add margin for spacing between buttons -->
                                        Cancel
                                    </a>
                                </div>
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
    // Function to handle name extension change
    // Function to handle name extension change
    function handleNameExtensionChange(selectElement) {
        const sexSelect = document.getElementById('sex');
        const selectedExtension = selectElement.value;

        if (['JR.', 'SR.', 'III', 'IV'].includes(selectedExtension)) {
            sexSelect.value = 'Male';
        }
    }

    // Function to handle sex change
    function handleSexChange(selectElement) {
        const nameExtensionSelect = document.getElementById('name_extension');
        const selectedSex = selectElement.value;
        if (nameExtensionSelect.value !== 'N/A' && selectedSex === 'Female') {
            nameExtensionSelect.value = 'N/A';
        }
    }

    // Add event listeners to both select elements
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('name_extension').addEventListener('change', function() {
            handleNameExtensionChange(this);
        });

        document.getElementById('sex').addEventListener('change', function() {
            handleSexChange(this);
        });
    });

    function calculateAge(dateString) {
        if (!dateString) {
            document.getElementById('age').value = '';
            return;
        }

        var today = new Date();
        var birthDate = new Date(dateString);

        // Check if birthDate is a valid date
        if (isNaN(birthDate.getTime())) {
            // Handle invalid date input (optional)
            console.error('Invalid date input:', dateString);
            document.getElementById('age').value = 'N/A';
            return;
        }

        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }


        // Check if age is less than 60 for senior citizen form
        if (age < 60) {
            // Display error message or alert
            alert('Senior citizen age should be atleast 60 years old or above.');
            // Clear age field or take appropriate action
            document.getElementById('age').value = '';
            return;
        }

        document.getElementById('age').value = age;
    }
    document.addEventListener('DOMContentLoaded', function() {
        const nameOfAssociation = document.getElementById('name_of_association');
        const addressOfAssociation = document.getElementById('address_of_association');
        const dateOfMembership = document.getElementById('date_of_membership');
        const officerDateElected = document.getElementById('officer_date_elected');
        const officerPosition = document.getElementById('officer_position');
        const form = document.getElementById('applicationForm');

        // Function to handle changes in the association name input
        nameOfAssociation.addEventListener('input', function() {
            if (this.value === 'N/A') {
                // Disable and clear the associated fields
                addressOfAssociation.disabled = true;
                addressOfAssociation.value = '';
                dateOfMembership.disabled = true;
                dateOfMembership.value = '';
                officerDateElected.disabled = true;
                officerDateElected.value = '';
                officerPosition.disabled = true;
                officerPosition.value = '';
            } else {
                // Enable the fields
                addressOfAssociation.disabled = false;
                dateOfMembership.disabled = false;
                officerDateElected.disabled = false;
                officerPosition.disabled = false;
            }
        });


    });
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
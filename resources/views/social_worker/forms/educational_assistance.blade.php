<!--Original Form-->

@extends("layouts.app")

@section("content")
<style>
    h4[class] {
        background: linear-gradient(90deg, #004aad, #007bff);
        color: white;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        font-weight: 700;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>
<form id="applicationForm" action="{{ route('social_worker.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="container">
        <div class="row justify-content-center">
            @if(session('error'))
            <div class="alert alert-danger text-center">
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
                        <h5>EDUCATIONAL ASSISTANCE PROGRAM</h5>
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
                        <h4 class="mb-" style="text-align:center">Personal Information</h4>
                        <input type="hidden" name="program_id" value="2">
                        <input type="hidden" name="form_data[educational_attainment]" value="N/A">
                        <input type="hidden" name="form_data[occupation]" value="N/A">

                        <!-- Surname -->
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">Surname:</label>
                            <div class="col-md-6 mb-1">
                                <input id="surname" type="text" class="form-control @error('form_data.surname') is-invalid @enderror"
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
                                <input id="first_name" type="text" class="form-control @error('form_data.first_name') is-invalid @enderror"
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

                        <!-- Sex -->
                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">Sex:</label>
                            <div class="col-md-6 mb-1">
                                <select id="sex" class="form-control @error('form_data.sex') is-invalid @enderror" name="form_data[sex]">
                                    <option value="Male" {{ old('form_data.sex', $formData['sex'] ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('form_data.sex', $formData['sex'] ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('form_data.sex')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">Date of
                                Birth:</label>
                            <div class="col-md-3">
                                <input id="dob" type="date"
                                    class="form-control @error(" form_data.dob") is-invalid @enderror"
                                    name="form_data[dob]" value="{{ old('form_data.dob', $formData['dob'] ?? '') }}"
                                    required onchange="calculateAge(this.value)">
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
                                    name="form_data[age]" value="{{ old('form_data.age', $formData['age'] ?? '') }}" required readonly>
                                @error("form_data.age")
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

                        <div class="form-group row">
                            <label for="place_of_birth" class="col-md-4 col-form-label text-md-right">Place of Birth:</label>
                            <div class="col-md-6 mb-1">
                                <input id="place_of_birth" type="text"
                                    class="form-control @error('form_data.place_of_birth') is-invalid @enderror"
                                    name="form_data[place_of_birth]" value="{{ old('form_data.place_of_birth', $formData['place_of_birth'] ?? '') }}">
                                @error('form_data.place_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address:</label>
                            <div class="col-md-6 mb-1">
                                <input id="address" type="text" class="form-control @error('form_data.address') is-invalid @enderror"
                                    name="form_data[address]"
                                    value="{{ old('form_data.address', $formData['address'] ?? '') }}" required>
                                @error('form_data.address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Required Documents -->
                        <div class="form-group">
                            <h4 class="mb-3 mt-3" style="text-align:center">Required Documents</h4>

                            <ul class="list-group">
                                <!-- Referral Slip -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input @error('form_data.referral_slip') is-invalid @enderror"
                                            type="checkbox" name="form_data[referral_slip]" id="referral_slip" value="1" required
                                            {{ old('form_data.referral_slip', $formData['referral_slip'] ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="referral_slip">Referral slip from referring agency</label>
                                    </div>

                                    <!-- Study Load -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input @error('form_data.study_load') is-invalid @enderror"
                                            type="checkbox" name="form_data[study_load]" id="study_load" value="1" required
                                            {{ old('form_data.study_load', $formData['study_load'] ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="study_load">Study load</label>
                                    </div>
                                </li>

                                <!-- Student ID -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input @error('form_data.student_id') is-invalid @enderror"
                                            type="checkbox" name="form_data[student_id]" id="student_id" value="1" required
                                            {{ old('form_data.student_id', $formData['student_id'] ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="student_id">Student ID</label>
                                    </div>
                                </li>

                                <!-- Certificate of No Scholarship -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input @error('form_data.certificate_of_no_scholarship') is-invalid @enderror"
                                            type="checkbox" name="form_data[certificate_of_no_scholarship]" id="certificate_of_no_scholarship" value="1"
                                            required {{ old('form_data.certificate_of_no_scholarship', $formData['certificate_of_no_scholarship'] ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="certificate_of_no_scholarship">Certificate of no scholarship</label>
                                    </div>
                                </li>

                                <!-- Barangay Certification -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input @error('form_data.brgy_cert') is-invalid @enderror"
                                            type="checkbox" name="form_data[brgy_cert]" id="brgy_cert" value="1"
                                            required {{ old('form_data.brgy_cert', $formData['brgy_cert'] ?? false) ? 'checked' : '' }}>

                                        <label class="form-check-label" for="brgy_cert">Barangay certification</label>
                                    </div>
                                </li>

                                <!-- Certification from the Assessors Office -->
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input @error('form_data.cert_ass_off') is-invalid @enderror"
                                            type="checkbox" name="form_data[cert_ass_off]" id="cert_ass_off" value="1"
                                            required {{ old('form_data.cert_ass_off', $formData['cert_ass_off'] ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cert_ass_off">Certification from the Assessors Office</label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Certification -->
                        <div class="form-group row">
                            <div class="col-md-12 p-3">
                                <div class="form-check">
                                    <input class="form-check-input @error('form_data.certification') is-invalid @enderror"
                                        type="checkbox" name="form_data[certification]" id="certification" value="1"
                                        required {{ old('form_data.certification', $formData['certification'] ?? false) ? 'checked' : '' }}>
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
                        </div>

                        <!-- Submit Buttons -->
                        <div class="form-group row justify-content-end">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Submit Registration</button>
                                <a href="{{ route('social_worker.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
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
        const form = document.getElementById('applicationForm');

        document.getElementById('name_extension').addEventListener('change', function() {
            handleNameExtensionChange(this);
        });

        document.getElementById('sex').addEventListener('change', function() {
            handleSexChange(this);
        });

        // Form validation function
        function validateForm() {
            let isValid = true;
            const requiredFields = {
                'surname': 'Surname is required',
                'first_name': 'First name is required',
                'age': 'Age is required',
                'address': 'Address is required',
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

        document.getElementById('age').value = age;
    }
</script>
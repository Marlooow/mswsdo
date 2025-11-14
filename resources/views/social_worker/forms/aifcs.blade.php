@extends("layouts.app")

@section("content")
    <form id="applicationForm" action="{{ route("social_worker.store") }}" method="POST" enctype="multipart/form-data"
        class="relative my-3 custom-width mx-auto">
        @csrf

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

        <!-- Hidden inputs remain the same -->
        <input type="hidden" name="program_id" value="1">
        <input type="hidden" name="form_data[sex]" value="N/A">
        <input type="hidden" name="form_data[civil_status]" value="N/A">
        <input type="hidden" name="form_data[certification]" value="1">
        <input type="hidden" name="form_data[educational_attainment]" value="N/A">
        <input type="hidden" name="form_data[occupation]" value="N/A">
        <input type="hidden" name="form_data[place_of_birth]" value="N/A">
        <!-- Beneficiary Search Section -->
        <div class="col-md-6 mx-auto"> <!-- Adjusted to position on the right -->
            <div class="input-group">
                <input type="text" id="beneficiarySearch" class="form-control" style="font-size:12px;"
                    placeholder="Search Beneficiary For Pre-fill (Surname, First Name, Middle Name)">
                <button class="btn btn-primary" type="button" id="searchButton">Search</button>
            </div>
            <div id="searchResults" class="mt-2">
                <!-- Search results will be dynamically populated here -->
            </div>
        </div>
        <!-- Modified inputs with 'old' and fallback to $formData -->
        <p class="text-end my-2 fw-bold">
            Date: <input type="date" name="form_data[certificate_date]" id="certificate_date"
                class="border-0 border-bottom border-2 border-black date-input mx-2" value="{{ now()->format("Y-m-d") }}"
                required />
        </p>

        <p class="mb-0">This is to certify that
            <input type="text" name="form_data[surname]" id="surname"
                class="border-0 border-bottom border-2 border-black fill-input-width straight-fill" placeholder="Surname"
                value="{{ old("form_data.surname", $formData["surname"] ?? "") }}" required />
            ,
            <input type="text" name="form_data[first_name]" id="first_name"
                class="border-0 border-bottom border-2 border-black fill-input-width straight-fill" placeholder="First Name"
                value="{{ old("form_data.first_name", $formData["first_name"] ?? "") }}" required />

            <input type="text" name="form_data[middle_name]" id="middle_name"
                class="border-0 border-bottom border-2 border-black fill-input-width straight-fill"
                placeholder="Middle Name" value="{{ old("form_data.middle_name", $formData["middle_name"] ?? "") }}" />
            ,
            <input type="date" id="dob" name="form_data[dob]"
                class="border-0 border-bottom border-2 border-black straight-fill"
                value="{{ old("form_data.dob", $formData["dob"] ?? "") }}" required />

            <input type="number" id="age" name="form_data[age]"
                class="border-0 border-bottom border-2 border-black fill-age-width straight-fill"
                value="{{ old("form_data.age", $formData["age"] ?? "") }}" readonly required />
            year/s old and presently residing at
        </p>

        <p class="mb-0">
            <input type="text" name="form_data[address]" id="address"
                class="border-0 border-bottom border-2 border-black fill-address-width straight-fill"
                placeholder="Enter Beneficiary Address" value="{{ old("form_data.address", $formData["address"] ?? "") }}"
                required />
            ,
            has been found eligible for <span class="text-decoration-underline fw-semibold">Financial Assistance</span> for
        </p>

        <p class="mb-0">
            <input type="text" name="form_data[assistance_type]" id="assistance_type"
                class="border-0 border-bottom border-2 border-black fill-input-width straight-fill"
                value="{{ old("form_data.assistance_type", $formData["assistance_type"] ?? "") }}" required />
            after a thorough assessment 
        </p>

        <p class="mt-2 ms-lg-5">Records of the case such as the following are confidentially filed at the Municipal Social
            Welfare and Development Office.</p>

        <div class="row px-5 mt-4">
            <div class="form-check col-6">
                <input class="form-check-input" type="checkbox" name="form_data[brgy_certification]" value="1"
                    id="brgycertcheckbox">
                <label class="form-check-label" for="brgycertcheckbox">
                    BRGY. CERTIFICATION OF INDIGENCE
                </label>
            </div>
            <div class="form-check col-6 mb-3">
                <input class="form-check-input" type="checkbox" name="form_data[death_certificate]" value="1"
                    id="deathcertcheckbox">
                <label class="form-check-label" for="deathcertcheckbox">
                    DEATH CERTIFICATE
                </label>
            </div>
            <div class="form-check col-6">
                <input class="form-check-input" type="checkbox" name="form_data[valid_id_presented]" value="1"
                    id="valididcheckbox">
                <label class="form-check-label" for="valididcheckbox">
                    VALID ID PRESENTED
                </label>
            </div>
        </div>
        <p class="my-4">OTHERS:</p>
        <div class="row px-5 mt-4">
            <div class="form-check col-6">
                <input class="form-check-input" type="checkbox" name="form_data[medical_certificate]" value="1"
                    id="medcertcheckbox">
                <label class="form-check-label" for="medcertcheckbox">
                    MEDICAL CERTIFICATE/ABSTRACT
                </label>
            </div>
            <div class="form-check col-6 mb-3">
                <input class="form-check-input" type="checkbox" name="form_data[lab_request]" value="1"
                    id="labreqcheckbox">
                <label class="form-check-label" for="labreqcheckbox">
                    LAB REQUEST
                </label>
            </div>
            <div class="form-check col-6">
                <input class="form-check-input" type="checkbox" name="form_data[quotation]" value="1"
                    id="quotcheckbox">
                <label class="form-check-label" for="quotcheckbox">
                    QUOTATION
                </label>
            </div>
            <div class="form-check col-6 mb-3">
                <input class="form-check-input" type="checkbox" name="form_data[charge_slip]" value="1"
                    id="chargeslipcheckbox">
                <label class="form-check-label" for="chargeslipcheckbox">
                    CHARGE SLIP
                </label>
            </div>
            <div class="form-check col-6">
                <input class="form-check-input" type="checkbox" name="form_data[medical_prescription]" value="1"
                    id="medprescheckbox">
                <label class="form-check-label" for="medprescheckbox">
                    MEDICAL PRESCRIPTION
                </label>
            </div>
            <div class="form-check col-6 mb-3">
                <input class="form-check-input" type="checkbox" name="form_data[statement_of_account]" value="1"
                    id="soacheckbox">
                <label class="form-check-label" for="soacheckbox">
                    STATEMENT OF ACCOUNT/HOSPITAL BILL
                </label>
            </div>
            <div class="form-check col-6">
                <input class="form-check-input" type="checkbox" name="form_data[discharge_summary]" value="1"
                    id="dissumcheckbox">
                <label class="form-check-label" for="dissumcheckbox">
                    DISCHARGE SUMMARY
                </label>
            </div>
            <div class="form-check col-6 mb-3">
                <input class="form-check-input" type="checkbox" name="form_data[vaccination]" value="1"
                    id="vacccheckbox">
                <label class="form-check-label" for="vacccheckbox">
                    VACCINATION
                </label>
            </div>
            <div class="form-check col-6">
                {{-- // empty. only for design --}}
            </div>
            <div class="form-check col-6 mb-3">
                <input class="form-check-input" type="checkbox" name="form_data[treatment_protocol]" value="1"
                    id="treatproccheckbox">
                <label class="form-check-label" for="treatproccheckbox">
                    TREATMENT PROTOCOL
                </label>
            </div>
        </div>

        <!-- Financial Assistance Section -->
        <p class="mb-0 ms-lg-5 mt-4">The client is hereby recommended to receive financial assistance for
            <input type="text" name="form_data[financial_assistance]" id="financial_assistance"
                class="border-0 border-bottom border-2 border-black fill-assis-width straight-fill"
                value="{{ old("form_data.financial_assistance", $formData["financial_assistance"] ?? "") }}" required />
            in the amount of
        </p>
        <p>Php. <input type="text" name="form_data[assistance_amount]" id="amount"
                class="border-0 border-bottom border-2 border-black fill-amount-width straight-fill"
                value="{{ old("form_data.assistance_amount", $formData["assistance_amount"] ?? "") }}" required /> </p>

        <!-- Conforme section -->
        <div class="row mt-5 text-center">
            <div class="col-6">
                <p class="mb-6">CONFORME:</p>
                <input type="text" name="form_data[conforme]" id="conforme"
                    class="border-0 text-center border-bottom border-2 border-black fill-input-width straight-fill"
                    value="{{ old("form_data.conforme", $formData["conforme"] ?? "") }}" readonly />
                <p>SIGNATURE ABOVE PRINTED NAME OF CLIENT</p>
            </div>
            <div class="col-6">
                <p>APPROVED BY:</p>
                <input type="text" name="form_data[approved_by]"
                    class="border-0 border-bottom border-2 border-black fill-input-width straight-fill text-center"
                    value="{{ old("form_data.approved_by", $formData["approved_by"] ?? "") }}" />
                <p class="mb-0">MSWDO</p>
                <p class="mb-0">
                    <input type="text" name="form_data[approver_license]"
                        class="border-0 border-bottom border-2 border-black fill-input-width straight-fill text-center"
                        placeholder="License No."
                        value="{{ old("form_data.approver_license", $formData["approver_license"] ?? "") }}" />
                </p>
            </div>
        </div>

        <div style="text-align: right; margin-top:2%;">
            <button type="submit" class="btn btn-primary">Submit Registration</button>
            <a href="{{ route("social_worker.index") }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>

    <style>
        /* Your existing styles */
        .custom-width {
            width: 57em;
        }

        .letter-spacing {
            letter-spacing: 10px;
        }

        .date-input {
            width: 120px;
        }

        .fill-address-width {
            width: 480px;
        }

        .fill-input-width {
            width: 350px;
        }

        .fill-assis-width {
            width: 230px;
        }

        .fill-age-width {
            width: 60px;
        }

        .fill-amount-width {
            width: 150px;
        }

        .straight-fill:focus {
            border: none;
            outline: none;
        }

        /* New validation styles */
        .validation-error {
            color: #dc3545;
            font-size: 12px;
            position: absolute;
            margin-top: 2px;
        }

        input.error {
            border-color: #dc3545 !important;
        }
    </style>

    <script src="/assets/jquery.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateConforme();
            const form = document.getElementById('applicationForm');
            const dobInput = document.getElementById('dob');
            const ageInput = document.getElementById('age');

            // Add input listeners for name fields to update conforme
            document.getElementById('surname').addEventListener('input', updateConforme);
            document.getElementById('first_name').addEventListener('input', updateConforme);
            document.getElementById('middle_name').addEventListener('input', updateConforme);
            document.getElementById('amount').addEventListener('input', formatNumber);

            // Add input listeners to remove error highlighting
            const inputs = document.querySelectorAll('input[required]');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.classList.remove('error');
                    this.style.borderColor = 'black';
                    removeError(this);
                });
            });


            // Function to calculate age from DOB
            function calculateAge(birthDate) {
                const today = new Date();
                const birthDateObj = new Date(birthDate);
                let age = today.getFullYear() - birthDateObj.getFullYear();
                const m = today.getMonth() - birthDateObj.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDateObj.getDate())) {
                    age--;
                }
                return age;
            }

            // Event listener for the DOB input to calculate age
            dobInput.addEventListener('input', function() {
                const dob = dobInput.value;
                if (dob) {
                    const age = calculateAge(dob);
                    ageInput.value = age;
                } else {
                    ageInput.value = ''; // If DOB is cleared, clear age
                }
            });

            // Initial age calculation if DOB is already set
            if (dobInput.value) {
                const age = calculateAge(dobInput.value);
                ageInput.value = age;
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

        function validateForm() {
            let isValid = true;
            const requiredFields = {
                'certificate_date': 'Certificate date is required',
                'surname': 'Surname is required',
                'first_name': 'First name is required',
                'age': 'Age is required',
                'address': 'Address is required',
                'assistance_type': 'Assistance type is required',
                'financial_assistance': 'Financial assistance is required',
                'amount': 'Amount is required'
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

        function formatNumber(event) {
            const input = event.target.value;
            const number = Number(input.replace(/,/g, ''));
            if (isNaN(number)) {
                alert("Please enter a valid number.");
                document.getElementById('amount').value = "";
            } else {
                const formattedNumber = number.toLocaleString('en-US');
                document.getElementById('amount').value = formattedNumber;
            }
        }

        function updateConforme() {
            const surname = document.getElementById('surname').value || '';
            const firstName = document.getElementById('first_name').value || '';
            const middleName = document.getElementById('middle_name').value || '';

            let fullName = '';

            if (surname) {
                fullName += surname;
            }
            if (firstName) {
                fullName += fullName ? ', ' + firstName : firstName;
            }
            if (middleName) {
                fullName += fullName ? ' ' + middleName : middleName;
            }
            if (!fullName) {
                fullName = 'Default Name';
            }
            document.getElementById('conforme').value = fullName;
        }
    </script>
@endsection

<div class="container">
    <form action="{{ route('social_worker.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="program_id" value="2">

        <h4 class="mb-3 text-center text-white py-2 rounded" style="background-color: #0d6efd;">
            Family Composition
        </h4>
        <div id="family-composition">

            <div class="form-group row " style="text-align:center">
                <label class="col-md-2 col-form-label text-md-left">Name</label>
                <label class="col-md-1 col-form-label text-md-left">Age</label>
                <label class="col-md-2 col-form-label text-md-left">Relation</label>
                <label class="col-md-2 col-form-label text-md-left">Civil Status</label>
                <label class="col-md-2 col-form-label text-md-left">Occupation</label>
                <label class="col-md-2 col-form-label text-md-left">Income</label>
                <div class="col-md-1 col-form-label text-md-left">
                    <!-- Empty column for remove button -->
                    Action
                </div>
            </div>
            <!-- Loop through each family member in the array -->
            @if (isset($formData['family_composition']) && is_array($formData['family_composition']))
            @foreach ($formData['family_composition'] as $member)
            <div class="family-member">
                <div class="form-group row">
                    <div class="col-md-2 mb-1">
                        <input value="{{ $member['name'] ?? 'Not provided'  }}" class="form-control" disabled>
                    </div>
                    <div class="col-md-1">
                        <input value="{{ $member['age'] ?? 'Not provided' }}" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <input value="{{ $member['relation'] ?? 'Not provided' }}" class="form-control" disabled>
                    </div>
                    <div class="col-md-2">
                        <input value="{{ $member['civil_status'] ?? 'Not provided' }}" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <input value="{{ $member['occupation'] ?? 'Not provided' }}" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <input value="{{ $member['income'] ?? 'Not provided' }}" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <!-- Empty column for remove button -->
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <!-- Initial family member row -->
            <div class="family-member">
                <div class="form-group row">
                    <div class="col-md-2 mb-1">
                        <input type="text" id="family_composition_name_0" name="form_data[family_composition][0][name]" value="{{ old('form_data.family_composition.0.name') }}" placeholder=" " class="form-control @error('form_data.family_composition.*.name') is-invalid @enderror" required>
                        @error('form_data.family_composition.*.name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-1">
                        <input type="number" id="family_composition_age_0" name="form_data[family_composition][0][age]" value="{{ old('form_data.family_composition.0.age') }}" placeholder="" class="form-control @error('form_data.family_composition.*.age') is-invalid @enderror" required>
                        @error('form_data.family_composition.*.age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="family_composition_relation_0" name="form_data[family_composition][0][relation]" value="{{ old('form_data.family_composition.0.relation') }}" placeholder="" class="form-control @error('form_data.family_composition.*.relation') is-invalid @enderror" required>
                        @error('form_data.family_composition.*.relation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <select id="family_composition_civil_status_0" class="form-control @error('form_data.family_composition.*.civil_status') is-invalid @enderror" name="form_data[family_composition][0][civil_status]" required>
                            <option value="Single" {{ old('form_data.family_composition.0.civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('form_data.family_composition.0.civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Widowed / Widower" {{ old('form_data.family_composition.0.civil_status') == 'Widowed / Widower' ? 'selected' : '' }}>Widowed / Widower</option>
                            <option value="Legally Separated" {{ old('form_data.family_composition.0.civil_status') == 'Legally Separated' ? 'selected' : '' }}>Legally Separated</option>
                        </select>
                        @error('form_data.family_composition.*.civil_status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="family_composition_occupation_0" name="form_data[family_composition][0][occupation]" value="{{ old('form_data.family_composition.0.occupation') }}" placeholder="" class="form-control @error('form_data.family_composition.*.occupation') is-invalid @enderror" required>
                        @error('form_data.family_composition.*.occupation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <input type="number" id="family_composition_income_0" name="form_data[family_composition][0][income]" value="{{ old('form_data.family_composition.0.income') }}" placeholder="" class="form-control @error('form_data.family_composition.*.income') is-invalid @enderror" required>
                        @error('form_data.family_composition.*.income')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md  -1">
                        <!-- Button to remove family member -->
                        <button type="button" class="btn btn-danger btn-sm mt-1" onclick="removeFamilyMember(this)">- </button>
                        <button type="button" class="btn btn-primary btn-sm mt-1" id="add-family-member" onclick="addFamilyMember()">+ </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- JavaScript Section -->
        <script>
            // Function to add event listeners for preventing negative values
            function addNegativeValueListeners(inputs) {
                inputs.forEach(input => {
                    if (input.name.includes('age') || input.name.includes('income')) {
                        input.addEventListener('input', function() {
                            if (input.value < 0) {
                                input.value = 0;
                            }
                        });
                        input.addEventListener('change', function() {
                            if (input.value < 0) {
                                input.value = 0;
                            }
                        });
                        input.addEventListener('keydown', function(e) {
                            if (e.key === 'ArrowUp' && input.value >= 0) {
                                input.stepUp();
                            }
                            if (e.key === 'ArrowDown' && input.value > 0) {
                                input.stepDown();
                            }
                        });
                    }
                });
            }

            // Function to add a new family member row
            function addFamilyMember() {
                const container = document.getElementById('family-composition');
                const index = container.querySelectorAll('.family-member').length;

                // Create a new family member div with Bootstrap form-group row structure
                const newMember = `
                <div class="family-member">
                    <div class="form-group row">
                        <div class="col-md-2 mb-1">
                            <input type="text" id="family_composition_name_${index}" name="form_data[family_composition][${index}][name]" value="{{ old('form_data.family_composition.${index}.name') }}" placeholder=" " class="form-control @error('form_data.family_composition.*.name') is-invalid @enderror" required>
                            @error('form_data.family_composition.*.name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-1">
                            <input type="number" id="family_composition_age_${index}" name="form_data[family_composition][${index}][age]" value="{{ old('form_data.family_composition.${index}.age') }}" placeholder="" class="form-control @error('form_data.family_composition.*.age') is-invalid @enderror" required>
                            @error('form_data.family_composition.*.age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <input type="text" id="family_composition_relation_${index}" name="form_data[family_composition][${index}][relation]" value="{{ old('form_data.family_composition.${index}.relation') }}" placeholder="" class="form-control @error('form_data.family_composition.*.relation') is-invalid @enderror" required>
                            @error('form_data.family_composition.*.relation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <select id="family_composition_civil_status_${index}" class="form-control @error('form_data.family_composition.*.civil_status') is-invalid @enderror" name="form_data[family_composition][${index}][civil_status]" required>
                                <option value="Single" {{ old('form_data.family_composition.0.civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ old('form_data.family_composition.0.civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Widowed / Widower" {{ old('form_data.family_composition.0.civil_status') == 'Widowed / Widower' ? 'selected' : '' }}>Widowed / Widower</option>
                                <option value="Legally Separated" {{ old('form_data.family_composition.0.civil_status') == 'Legally Separated' ? 'selected' : '' }}>Legally Separated</option>
                            </select>
                            @error('form_data.family_composition.*.civil_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <input type="text" id="family_composition_occupation_${index}" name="form_data[family_composition][${index}][occupation]" value="{{ old('form_data.family_composition.${index}.occupation') }}" placeholder="" class="form-control @error('form_data.family_composition.*.occupation') is-invalid @enderror" required>
                            @error('form_data.family_composition.*.occupation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <input type="number" id="family_composition_income_${index}" name="form_data[family_composition][${index}][income]" value="{{ old('form_data.family_composition.${index}.income') }}" placeholder="" class="form-control @error('form_data.family_composition.*.income') is-invalid @enderror" required>
                            @error('form_data.family_composition.*.income')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-1">
                            <!-- Button to remove family member -->
                            <button type="button" class="btn btn-danger btn-sm mt-1" onclick="removeFamilyMember(this)">-</button>
                            <button type="button" class="btn btn-primary btn-sm mt-1" id="add-family-member" onclick="addFamilyMember()">+ </button>
                        </div>
                    </div>
                </div>
                `;

                // Append the new family member to the container
                container.insertAdjacentHTML('beforeend', newMember);

                // Get all inputs within the newly added family member row
                const newInputs = container.lastElementChild.querySelectorAll('input, select');

                // Add event listeners to prevent negative values for the new inputs
                addNegativeValueListeners(newInputs);
            }

            // Function to remove the family member row
            function removeFamilyMember(button) {
                const memberDiv = button.closest('.family-member');
                const familyMembers = document.querySelectorAll('.family-member'); // All family member rows
                if (familyMembers.length > 1) { // Only allow removal if more than 1 member
                    memberDiv.remove();
                } else {
                    alert("You cannot remove the last family member.");
                }
            }

            // Add event listeners to existing family composition rows on page load
            document.addEventListener('DOMContentLoaded', function() {
                const existingMembers = document.querySelectorAll('.family-member input, .family-member select');
                addNegativeValueListeners(existingMembers);
            });
        </script>
    </form>
</div>
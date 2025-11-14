<!-- resources/views/social_worker/forms/_common_fields.blade.php -->

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

<div class="form-group">
    <label for="emergency_contact_name">Emergency Contact Name</label>
    <input type="text" id="emergency_contact_name" name="form_data[emergency_contact][name]" class="form-control" value="{{ old('form_data.emergency_contact.name') }}">
    @error('form_data.emergency_contact.name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="emergency_contact_relationship">Relationship</label>
    <input type="text" id="emergency_contact_relationship" name="form_data[emergency_contact][relationship]" class="form-control" value="{{ old('form_data.emergency_contact.relationship') }}">
    @error('form_data.emergency_contact.relationship')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="emergency_contact_address">Address</label>
    <input type="text" id="emergency_contact_address" name="form_data[emergency_contact][address]" class="form-control" value="{{ old('form_data.emergency_contact.address') }}">
    @error('form_data.emergency_contact.address')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="emergency_contact_number">Emergency Contact Number</label>
    <input type="text" id="emergency_contact_number" name="form_data[emergency_contact][contact_number]" class="form-control" value="{{ old('form_data.emergency_contact.contact_number') }}" pattern="^\+63[0-9]{10}$" title="Format: +63XXXXXXXXXX (10 digits after country code)" required>
    @error('form_data.emergency_contact.contact_number')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const emergencyContactInput = document.getElementById('emergency_contact_number');
        const contactNumberInput = document.getElementById('phone_number');

        function validatePhoneNumber(input) {
            const regex = /^\+63[0-9]{10}$/;
            if (!regex.test(input.value)) {
                input.setCustomValidity("Please enter a valid phone number in the format +63XXXXXXXXXX (10 digits after country code).");
            } else {
                input.setCustomValidity("");
            }
        }

        emergencyContactInput.addEventListener('input', () => validatePhoneNumber(emergencyContactInput));
        contactNumberInput.addEventListener('input', () => validatePhoneNumber(contactNumberInput));
    });
</script>
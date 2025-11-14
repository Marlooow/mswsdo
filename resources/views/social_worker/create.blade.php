@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($beneficiary) ? 'Update Application for ' . $selectedProgram->name : 'Apply for ' . $selectedProgram->name }}</h1>

    @if(session('error'))
    <div class="alert alert-danger mt-3" style="text-align: center;">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success mt-3" style="text-align: center;">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('social_worker.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="program_id" value="{{ $selectedProgram->id }}">

        <!-- Identify if the beneficiary is new or existing -->
        @if(isset($beneficiary))
        <input type="hidden" name="beneficiary_id" value="{{ $beneficiary->id }}">
        @endif

        <!-- Prefill form fields with data from $beneficiary or $formData if available -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control"
                value="{{ isset($beneficiary) ? $beneficiary->name : (isset($formData['name']) ? $formData['name'] : old('name')) }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                value="{{ isset($beneficiary) ? $beneficiary->email : (isset($formData['email']) ? $formData['email'] : old('email')) }}" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control"
                value="{{ isset($beneficiary) ? $beneficiary->phone_number : (isset($formData['phone_number']) ? $formData['phone_number'] : old('phone_number')) }}" required>
            @error('phone_number')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Add program-specific form fields based on $selectedProgram -->
        @if($selectedProgram->name == 'seniorcitizen')
        <div class="form-group">
            <label for="pensioner_id">Pensioner ID</label>
            <input type="text" name="form_data[pensioner_id]" id="pensioner_id" class="form-control"
                value="{{ isset($formData['pensioner_id']) ? $formData['pensioner_id'] : old('form_data[pensioner_id]') }}">
            @error('form_data.pensioner_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @elseif($selectedProgram->name == 'Solo Parent')
        <div class="form-group">
            <label for="solo_parent_id">Solo Parent ID</label>
            <input type="text" name="form_data[solo_parent_id]" id="solo_parent_id" class="form-control"
                value="{{ isset($formData['solo_parent_id']) ? $formData['solo_parent_id'] : old('form_data[solo_parent_id]') }}">
            @error('form_data.solo_parent_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @elseif($selectedProgram->name == 'Educational Assistance')
        <div class="form-group">
            <label for="student_id">Student ID</label>
            <input type="text" name="form_data[student_id]" id="student_id" class="form-control"
                value="{{ isset($formData['student_id']) ? $formData['student_id'] : old('form_data[student_id]') }}">
            @error('form_data.student_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @endif

        <!-- Document Upload -->
        <div class="form-group">
            <label for="documents">Documents</label>
            <input type="file" name="documents[]" multiple id="documents" class="form-control">
            @error('documents.*')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">{{ isset($beneficiary) ? 'Update' : 'Submit' }}</button>
    </form>
</div>


@endsection
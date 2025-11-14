@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Program</h1>
    <form action="{{ route('programs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required pattern="[a-zA-Z0-9 ]+">
        </div>
        <button type="submit" class="btn btn-primary">Create Program</button>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var nameInput = document.getElementById('name');

        nameInput.addEventListener('input', function() {
            var value = nameInput.value;
            var regex = /^[a-zA-Z0-9 ]*$/; // Allow only alphanumeric characters and spaces

            if (!regex.test(value)) {
                nameInput.setCustomValidity('Special characters are not allowed.');
            } else {
                nameInput.setCustomValidity('');
            }
        });
    });
</script>
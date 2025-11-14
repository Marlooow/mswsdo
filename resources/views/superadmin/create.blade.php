@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New User</h1>
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
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="form-group">
            <label for="roles">Role</label>
            <select class="form-control" id="roles" name="roles[]" required>
                @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="program_type">Program Type</label>
            <select class="form-control" id="program_type" name="program_type[]" required>
                @foreach($programs as $program)
                <option value="{{ $program->id }}">{{ $program->program_type }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="program">Program</label>
            <select class="form-control" id="program" name="program_id" required>
                @foreach($programs as $program)
                <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>
@endsection
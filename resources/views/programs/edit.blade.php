@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Program</h1>
    <form action="{{ route('programs.update', $program->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $program->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Program</button>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Programs</h1>
    <a href="{{ route('programs.create') }}" class="btn btn-primary mb-3">Create New Program</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $program)
            <tr>
                <td>{{ $program->name }}</td>
                <td>
                    <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
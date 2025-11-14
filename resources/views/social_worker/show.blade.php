@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Beneficiary Details</h1>

    <div class="card">
        <div class="card-header">
            <h4>{{ $beneficiary->name }}</h4>
        </div>
        <div class="card-body">
            <p>Email: {{ $beneficiary->email }}</p>
            <p>Phone Number: {{ $beneficiary->phone_number }}</p>
            <p>Status: {{ ucfirst($beneficiary->status) }}</p>

            <h5>Documents:</h5>
            <ul>
                @foreach ($beneficiary->documents as $document)
                <li>
                    <a href="{{ Storage::url($document->path) }}" target="_blank">{{ $document->path }}</a>
                </li>
                @endforeach
            </ul>

            <form action="{{ route('social_worker.sendToAdmin', $beneficiary->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning">Send to Admin</button>
            </form>
        </div>
    </div>
</div>
@endsection
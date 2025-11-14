@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Social Worker Dashboard</h1>
    <h2>Your Program: {{ auth()->user()->program->name }}</h2>

    <div class="row">
        @foreach($beneficiaries as $beneficiary)
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Beneficiary: {{ $beneficiary->name }}</h4>
                    </div>
                    <div class="card-body">
                        <p>Email: {{ $beneficiary->email }}</p>
                        <p>Phone Number: {{ $beneficiary->phone_number }}</p>
                        <p>Status: {{ ucfirst($beneficiary->status) }}</p>

                        <a href="{{ route('social_worker.show', $beneficiary->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

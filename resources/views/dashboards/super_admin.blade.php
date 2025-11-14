@extends('layouts.app')

@section('content')
<div class="container">
  <div class="p-3 mb-2 bg-dark text-white text-center rounded-2 fs-2">Super Admin Dashboard</div>

  <div class="row">
    <!-- Card 1 -->
    <div class="col-md-4 mb-4">
      <div class="card text-white bg-primary">
        <div class="card-body">
          <h5 class="card-title fs-3">User Management</h5>
          <p class="card-text">Creating users for admin and social worker for each program are listed here.</p>
          <a href="{{ route('users.index') }}" class="btn btn-light">
            <i class="fas fa-user"></i> Manage User
          </a>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-4 mb-4">
      <div class="card text-white bg-success">
        <div class="card-body">
          <h5 class="card-title fs-3">Beneficiary Management</h5>
          <p class="card-text">All applicants who are pending and accepted for all programs are listed here.</p>
          <a href="{{ route('superadmin.beneficiaries.index') }}" class="btn btn-light">
          <i class="fas fa-user-friends"></i>  Manage Beneficiaries</a>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-4 mb-4">
      <div class="card text-white bg-warning">
        <div class="card-body">
          <h5 class="card-title fs-3">Reports</h5>
          <p class="card-text">All applicants who are pending and accepted for all programs are listed here.</p>
          <a href="{{ route('superadmin.reports.index') }}" class="btn btn-light">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 0 .5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2A.5.5 0 0 1 .5 2h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2A.5.5 0 0 1 .5 4h10a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2A.5.5 0 0 1 .5 6h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2A.5.5 0 0 1 .5 8h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
          </svg>Reports</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
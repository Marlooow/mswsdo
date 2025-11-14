@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Beneficiary Report</h2>

    <form action="{{ route('social_worker.report') }}" method="GET" class="mb-4">
        <div class="form-row">
            <div class="col">
                <select name="status" class="form-control" required>
                    <option value="">Select Status</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="disapproved" {{ request('status') == 'disapproved' ? 'selected' : '' }}>Disapproved</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <div class="col">
                <select name="month" class="form-control">
                    <option value="">Select Month</option>
                    @foreach(range(1, 12) as $month)
                        <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="number" name="year" class="form-control" placeholder="Year" value="{{ request('year') }}" min="2000" max="2100">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </div>
        </div>
    </form>

    @if(isset($beneficiaries) && $beneficiaries->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Program</th>
                    <th>Status</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beneficiaries as $beneficiary)
                    <tr>
                        <td>{{ $beneficiary->name }}</td>
                        <td>{{ $beneficiary->program->name }}</td>
                        <td>
                            <span class="badge {{ $beneficiary->status == 'approved' ? 'bg-success' : ($beneficiary->status == 'disapproved' ? 'bg-danger' : 'bg-warning') }}">
                                {{ ucfirst($beneficiary->status) }}
                            </span>
                        </td>
                        <td>{{ $beneficiary->created_at->format('F j, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No beneficiaries found for the selected criteria.</p>
    @endif
</div>
@endsection

@if($beneficiaries->isNotEmpty())
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Program</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($beneficiaries as $beneficiary)
            <tr>
                <td>{{ $beneficiary->name }}</td>
                <td>{{ $beneficiary->program }}</td>
                <td>{{ ucfirst($beneficiary->status) }}</td>
                <td>
                    <a href="{{ route('social_worker.beneficiaries.show', $beneficiary->id) }}" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $beneficiaries->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
    </div>
@else
    <p>No beneficiaries found for this program.</p>
@endif
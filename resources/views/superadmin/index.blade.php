@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Header Row -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">User Management</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
            + Create New User
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- Modal -->
    <div class="modal fade @if ($errors->any()) show @endif"
        id="createUserModal"
        tabindex="-1"
        aria-labelledby="createUserModalLabel"
        aria-hidden="{{ $errors->any() ? 'false' : 'true' }}"
        style="{{ $errors->any() ? 'display: block;' : '' }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST" class="mx-auto p-3 shadow-sm rounded bg-light" style="max-width: 450px; font-size: 0.9rem;">
                        @csrf

                        <div class="mb-2">
                            <label for="name" class="form-label mb-1">Name</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-2">
                            <label for="email" class="form-label mb-1">Email</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div id="passwordFields" class="mb-2">
                            <label for="password" class="form-label mb-1">Password</label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password" minlength="8" title="Must contain at least 8 characters" required>
                        </div>

                        <div id="passwordConfirmationFields" class="mb-2">
                            <label for="password_confirmation" class="form-label mb-1">Confirm Password</label>
                            <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="mb-2">
                            <label for="roles" class="form-label mb-1">Role</label>
                            <select class="form-select form-select-sm" id="roles" name="roles[]" required>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_', ' ', $role->name)) }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="program" class="form-label mb-1">Program</label>
                            <select class="form-select form-select-sm" id="program" name="program_id" required>
                                @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer p-2">
                            <button type="submit" class="btn btn-primary btn-sm">Create User</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('users.index') }}" method="GET" class="row g-1 align-items-end">

                <!-- Program Filter -->
                <div class="col-md-3 col-sm-6">
                    <label for="program" class="form-label">Filter by Program:</label>
                    <div class="custom-select-wrapper">
                        <select name="program" id="program" class="form-control custom-select-dropdown" onchange="this.form.submit()">
                            <option value="all">All Programs</option>
                            @foreach ($programs as $program)
                            <option value="{{ $program->id }}" {{ request('program') == $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down dropdown-icon"></i>
                    </div>
                </div>

                <!-- Role Filter -->
                <div class="col-md-3 col-sm-6">
                    <label for="role" class="form-label">Filter by Role:</label>
                    <div class="custom-select-wrapper">
                        <select name="role" id="role" class="form-control custom-select-dropdown" onchange="this.form.submit()">
                            <option value="all">All Roles</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                                {{ ucwords(str_replace('_', ' ', $role->name)) }}
                            </option>

                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down dropdown-icon"></i>
                    </div>
                </div>

                <!-- Search -->
                <div class="col-md-6 col-sm-12">
                    <label for="search" class="form-label">Search (Name or Email):</label>
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control"
                            value="{{ request('search') }}" placeholder="Enter name or email">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr class="my-0">
    <table class="table table-bordered mt-3">
        <thead>
            <tr style="text-align: center;">
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Program</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name ?? 'N/A' }}</td>
                <td>{{ $user->email ?? 'N/A' }}</td>
                <td style="text-align: center;">
                    {{ ucwords(str_replace('_', ' ', $user->roles->first()->name ?? 'N/A')) }}
                </td>

                <td style="text-align: center;">{{ $user->program->name ?? 'N/A' }}</td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-sm btn-primary edit-user"
                        data-bs-toggle="modal"
                        data-bs-target="#createUserModal"
                        data-id="{{ $user->id }}"
                        data-name="{{ $user->name }}"
                        data-email="{{ $user->email }}"
                        data-roles="{{ json_encode($user->roles->pluck('id')) }}"
                        data-program="{{ $user->program_id }}">
                        Edit
                    </button>
                    <button
                        type="button"
                        class="btn btn-sm {{ $user->status === 'active' ? 'btn-danger' : 'btn-success' }}"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmStatusModal"
                        data-user-id="{{ $user->id }}"
                        data-name="{{ $user->name }}"
                        data-program="{{ $user->program->name ?? 'N/A' }}"
                        data-action="{{ route('users.toggleStatus', $user->id) }}"
                        data-status="{{ $user->status === 'active' ? 'deactivate' : 'activate' }}">
                        {{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}
                    </button>
                    <!-- Reset Password Button (triggers modal) -->
                    <button type="button"
                        class="btn btn-sm btn-warning reset-password-btn"
                        data-user-id="{{ $user->id }}"
                        data-user-name="{{ $user->name }}"
                        data-bs-toggle="modal"
                        data-bs-target="#resetPasswordModal">
                        Reset Password
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links('pagination::bootstrap-5') }}

</div>

<!-- CONFIRM STATUS MODAL (moved OUTSIDE container to prevent nesting) -->
<div class="modal fade" id="confirmStatusModal" tabindex="-1" aria-labelledby="confirmStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="confirmStatusForm" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmStatusModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="confirmStatusMessage">Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Reset Password Confirmation Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="resetPasswordForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel">Confirm Password Reset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to reset the password for <strong id="resetUserName"></strong>?</p>
                    <p class="text-muted mb-0"><small>The password will be reset to the system’s default value.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Yes, Reset Password</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const resetButtons = document.querySelectorAll('.reset-password-btn');
        const resetForm = document.getElementById('resetPasswordForm');
        const resetUserName = document.getElementById('resetUserName');

        resetButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                const userName = this.getAttribute('data-user-name');

                // Update modal content
                resetUserName.textContent = userName;

                // Update form action dynamically
                resetForm.action = `/users/${userId}/reset-password`;
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        // 🔹 Confirm modal logic
        const confirmModal = document.getElementById('confirmStatusModal');
        const confirmForm = document.getElementById('confirmStatusForm');
        const confirmMessage = document.getElementById('confirmStatusMessage');

        confirmModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const actionUrl = button.getAttribute('data-action');
            const userName = button.getAttribute('data-name');
            const userProgram = button.getAttribute('data-program');
            const userAction = button.getAttribute('data-status');

            confirmForm.action = actionUrl;

            // ✅ Use innerHTML so HTML tags (like <strong>) render properly
            confirmMessage.innerHTML = `Are you sure you want to ${userAction} 
            <strong>${userName}</strong> 
            from <strong>${userProgram} Program</strong>?`;

            const submitBtn = confirmForm.querySelector('button[type="submit"]');
            submitBtn.className = 'btn ' + (userAction === 'deactivate' ? 'btn-danger' : 'btn-success');
            submitBtn.textContent = `Yes, ${userAction.charAt(0).toUpperCase() + userAction.slice(1)}`;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');

        const passwordFeedback = document.createElement('small');
        passwordFeedback.className = 'form-text text-muted';
        password.insertAdjacentElement('afterend', passwordFeedback);

        const confirmFeedback = document.createElement('small');
        confirmFeedback.className = 'form-text text-muted';
        confirmPassword.insertAdjacentElement('afterend', confirmFeedback);

        password.addEventListener('input', () => {
            const value = password.value;
            let message = '';

            if (value.length < 8) message = 'Password must be at least 8 characters.';
            else message = '✅ Strong password';

            passwordFeedback.textContent = message;
            passwordFeedback.style.color = message.startsWith('✅') ? 'green' : 'red';
        });

        confirmPassword.addEventListener('input', () => {
            confirmFeedback.textContent =
                password.value === confirmPassword.value ?
                '✅ Passwords match' :
                '❌ Passwords do not match';
            confirmFeedback.style.color =
                password.value === confirmPassword.value ? 'green' : 'red';
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#createUserModal"]');
        const form = document.querySelector('#createUserModal form');
        const submitButton = document.querySelector('.modal-footer button[type="submit"]');
        const modalTitle = document.querySelector('#createUserModalLabel');
        const passwordFields = document.querySelectorAll('#passwordFields, #passwordConfirmationFields');
        const createButton = document.querySelector('button[data-bs-target="#createUserModal"]');

        // Handle Create New User button
        createButton.addEventListener('click', function() {
            setupCreateMode();
        });

        // Handle Edit buttons
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                if (userId) { // If userId exists, we're in edit mode
                    setupEditMode(this);
                }
            });
        });

        function setupEditMode(button) {
            // Get user data from button attributes
            const userId = button.getAttribute('data-id');
            const userName = button.getAttribute('data-name');
            const userEmail = button.getAttribute('data-email');
            const userRoles = JSON.parse(button.getAttribute('data-roles'));
            const userProgram = button.getAttribute('data-program');

            // Set form action and method for update
            form.action = `{{ url('users') }}/${userId}`;

            // Add method field for PATCH if it doesn't exist
            let methodField = form.querySelector('input[name="_method"]');
            if (!methodField) {
                methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                form.appendChild(methodField);
            }
            methodField.value = 'PATCH';

            // Update modal title and submit button
            modalTitle.textContent = 'Edit User';
            submitButton.textContent = 'Update User';

            // Populate the fields
            document.getElementById('name').value = userName;
            document.getElementById('email').value = userEmail;
            document.getElementById('roles').value = userRoles[0]; // Assuming single role selection
            document.getElementById('program').value = userProgram;

            // Hide password fields in edit mode
            passwordFields.forEach(field => {
                field.style.display = 'none';
            });

            // Remove required attribute from password fields
            const passwordInputs = form.querySelectorAll('input[type="password"]');
            passwordInputs.forEach(input => {
                input.removeAttribute('required');
            });
        }

        function setupCreateMode() {
            // Reset form
            form.reset();

            // Set form action for create
            form.action = "{{ route('users.store') }}";

            // Update modal title and submit button
            modalTitle.textContent = 'Create New User';
            submitButton.textContent = 'Create User';

            // Show password fields
            passwordFields.forEach(field => {
                field.style.display = 'block';
            });

            // Make password fields required
            const passwordInputs = form.querySelectorAll('input[type="password"]');
            passwordInputs.forEach(input => {
                input.setAttribute('required', 'required');
            });

            // Remove any existing method field or set it to POST
            let methodField = form.querySelector('input[name="_method"]');
            if (methodField) {
                methodField.value = 'POST';
            }
        }

        // Reset modal when it's closed
        const modal = document.getElementById('createUserModal');
        modal.addEventListener('hidden.bs.modal', function() {
            form.reset();
            setupCreateMode();
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        // If there are validation errors, ensure the modal remains open
        if (document.querySelector('.modal.show')) {
            const modal = new bootstrap.Modal(document.getElementById('createUserModal'), {});
            modal.show();
        }
    });
</script>

<style>
    .custom-select-wrapper {
        position: relative;
    }

    .custom-select-dropdown {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 2rem !important;
        /* space for arrow */
        height: 38px !important;
        /* match input + button height */
        line-height: 38px;
    }

    .dropdown-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #555;
    }

    .form-control,
    .btn {
        height: 38px !important;
    }

    label.form-label {
        font-weight: 600;
        margin-bottom: 4px;
    }
</style>
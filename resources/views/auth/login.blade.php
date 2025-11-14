@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-center ">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 100px;">
                        <p class="fs-5 w-75 mx-auto">Development of Social Welfare Services Management System</p>
                        <p class="fs-3 fw-semibold">LOGIN</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mx-auto col-md-10">
                            <label for="email" class="col-md-4 col-form-label w-100">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control w-100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mx-auto col-md-10 mt-2">
                            <label for="password" class="col-md-4 col-form-label w-100">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control w-100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mx-auto col-md-10 mt-4 mb-4">
                            <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@if(session('inactive'))
<div class="modal fade show" id="inactiveModal" style="display:block; background:rgba(0,0,0,0.5);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Account Deactivated</h5>
            </div>
            <div class="modal-body">
                <p>Your account is deactivated. Please contact the administrator.</p>
            </div>
            <div class="modal-footer">
                <button onclick="closeInactiveModal()" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function closeInactiveModal() {
        document.getElementById('inactiveModal').style.display = 'none';
    }
</script>
@endif

@endsection
<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config("app.name", "DSWSMS") }}</title>

    @vite(["resources/css/app.css", "resources/js/app.js"])
    @yield("scripts")
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url("/") }}">
                    <img src="{{ asset("images/logo.png") }}" alt="Logo" style="height: 40px;">
                    {{ config("app.name", "Laravel") }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __("Toggle navigation") }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has("login"))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route("login") }}">{{ __("Login") }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route("logout") }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __("Logout") }}
                                    </a>

                                    <form id="logout-form" action="{{ route("logout") }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-2">
            <!-- Back Button -->
            <div class="container">
                @php
                    $previousUrl = url()->previous();
                    $currentUrl = url()->current();
                    $isSameRoute =
                        \Illuminate\Support\Facades\Route::getRoutes()
                            ->match(\Illuminate\Support\Facades\Request::create($previousUrl))
                            ->uri() ===
                        \Illuminate\Support\Facades\Route::getRoutes()
                            ->match(\Illuminate\Support\Facades\Request::create($currentUrl))
                            ->uri();
                @endphp

                @if (
                    !$isSameRoute &&
                        !\Illuminate\Support\Str::contains(request()->path(), "dashboard") &&
                        !\Illuminate\Support\Str::contains(request()->path(), "login"))
                    <!-- Prevent looping back to the current page or query parameter variations -->
                    <a href="{{ $previousUrl }}" class="btn btn-secondary mb-3">
                        &larr; Back
                    </a>
                @endif
            </div>
            @yield("content")
        </main>

    </div>
    <!-- Modal for Duplicate Application Error -->
    <div id="duplicateApplicationModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Duplicate Application Detected</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
<style>
    #successModal .modal-header {
        background-color: #28a745;
        /* Bootstrap's success green */
        color: white;
        /* White text */
    }

    #successModal .modal-title {
        font-weight: bold;
        /* Optional: make the title bold */
    }

    #successModal .btn-close {
        color: white;
        /* White close button */
        opacity: 1;
        /* Ensure it's fully visible */
    }
</style>

</html>

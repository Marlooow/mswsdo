<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status === 'inactive') {
            Auth::logout();

            return redirect()->route('login')
                ->with('inactive', 'Your account has been deactivated. Please contact the administrator.');
        }

        return $next($request);
    }
}

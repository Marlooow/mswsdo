<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user || !$user->hasRole(...$roles)) {
            return redirect('/')->with('error', 'You do not have access to this resource.');
        }

        // Additional check for program assignment
        if ($user->hasRole('admin') || $user->hasRole('social_worker')) {
            if (!$user->program_id) {
                return redirect('/')->with('error', 'No program assigned to this account.');
            }
        }

        return $next($request);
    }
}

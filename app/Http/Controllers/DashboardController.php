<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user instanceof User) {
                if ($this->checkUserRole($user, 'super_admin')) {
                    return view('dashboards.super_admin'); // Redirecting to super admin user management
                } elseif ($this->checkUserRole($user, 'admin')) {
                    return redirect()->route('admin.dashboard');
                } elseif ($this->checkUserRole($user, 'social_worker')) {
                    return redirect()->route('social_worker.index');
                }
            }
        }

        return redirect()->route('login');
    }

    private function checkUserRole(User $user, string $roleName): bool
    {
        return $user->roles()->where('name', $roleName)->exists();
    }
}

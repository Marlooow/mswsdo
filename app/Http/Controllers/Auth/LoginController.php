<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        // BLOCK inactive accounts
        if ($user && $user->status === 'inactive') {
            // Use flash so the modal can display after redirect
            session()->flash('inactive', true);

            // Stop the login attempt
            return false;
        }

        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        if (session('inactive')) {
            return redirect()->back()->withInput($request->only('email'));
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors([
                $this->username() => __('auth.failed'),
            ]);
    }



    protected function authenticated(Request $request, $user)
    {
        session()->forget('inactive');
    }

    public function logout(Request $request)
    {
        session()->forget('inactive');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * action GET login
     */

    /**
     * action POST login
     */
    public function login(Request $request)
    {

        if ($request->getMethod() == 'GET') {
            return view('teacher.auth.login');
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $guard = Auth::guard('teacher');

        if ($guard->attempt($credentials)) {

            $userAdmin = $guard->user();
            $request->session()->regenerate();
            $email = $request->email;

            return redirect()->route('teacher.profile');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

    }
    public function logout(Request $request)
    {
        if(Auth::guard('teacher')->check()) 
    {
            Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login');
    }

        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect('teacher.login');


    }
}

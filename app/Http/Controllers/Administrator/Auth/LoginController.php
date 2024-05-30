<?php

namespace App\Http\Controllers\Administrator\Auth;

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
            return view('administrator.auth.login');
        }
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $guard = Auth::guard('administrator');

        if ($guard->attempt($credentials)) {
            $userAdmin = $guard->user();
            $request->session()->regenerate();
            // return redirect()->intended('dashboard');
            return redirect()->route('administrator.teacher');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

    }
    public function logout(Request $request)
    {
        // Auth::logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // return redirect('/administrator/login');

        if(Auth::guard('administrator')->check()) // this means that the admin was logged in.
    {
            Auth::guard('administrator')->logout();
        return redirect()->route('administrator.login');
    }

        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('administrator.login');

    }
}

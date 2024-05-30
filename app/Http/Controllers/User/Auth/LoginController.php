<?php

namespace App\Http\Controllers\User\Auth;

use Socialite;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request){
        //dd($request->getMethod() );
        //dd($request->all());
        if ($request->getMethod() == 'GET') {
            return view('user.auth.login');
        }
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $guard = Auth::guard('user');
        if ($guard->attempt($credentials)) {
            $userAdmin = $guard->user();
            $request->session()->regenerate();
            $email = $request->email;
            $user = (new User)->where('id',Auth::id())->get();
           
            return redirect()->route('home');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
        
    }
    public function loginFb(Request $request){
        
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook(){
        $user= Socialite::driver('facebook')->user();
        dd($user);
    }

    public function register(Request $request){
        $input = $request->all();
        $input['password']= bcrypt($input['password']);
        User::create($input);
        return redirect()->route('home.login');
    }

    public function logout(Request $request){
        if(Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect()->route('home');
        }
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}

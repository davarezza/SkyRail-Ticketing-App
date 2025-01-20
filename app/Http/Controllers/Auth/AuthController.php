<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            session()->flash('success', 'Login successful, enjoy the website!');

            return redirect('/');
        }

        return back()->with('loginError', 'Login Failed');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        session()->flash('success', 'Thank you for visiting this website');

        return redirect('/');
    }
}

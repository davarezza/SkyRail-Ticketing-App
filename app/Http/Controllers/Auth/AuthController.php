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
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'redirect' => url('dashboard')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Username or password is incorrect'
        ], 401);
    }

    public function registerPage()
    {
        return view('auth.register');
    }
}

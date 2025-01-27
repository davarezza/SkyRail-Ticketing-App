<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Penumpang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        if (Auth::attempt($credentials)) {
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

    private function generateUsername($fullNameParts)
    {
        $usernameBase = Str::lower(implode('', array_slice($fullNameParts, 0, 2)));
        $username = $usernameBase;

        $isDuplicate = true;
        while ($isDuplicate) {
            if (!User::where('username', $username)->exists()) {
                $isDuplicate = false;
            } else {
                $username = $usernameBase . rand(10, 99);
            }
        }

        return $username;
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $this->generateUsername(explode(' ', $request->name)),
            'password' => Hash::make($request->password),
            'plain_password' => $request->password,
        ]);

        $penumpang = Penumpang::create([
            'nama_penumpang' => $request->name,
            'user_id' => $user->id,
            'username' => $this->generateUsername(explode(' ', $request->name)),
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        session()->flash('success', 'Registration successful, please login!');

        return redirect('/login');
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
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show signup page
    public function showSignup()
    {
        return view('pages.signup');
    }

    // Handle signup
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Laravel auto-hashes the password because User model has:
        // protected function casts(): ['password' => 'hashed']
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password'], // no Hash::make needed!
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // Show login page
    public function showLogin()
    {
        return view('pages.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    // Dashboard
    public function dashboard()
    {
        $users = User::orderByDesc('id')->get();
        $totalUsers = $users->count();

        return view('pages.dashboard', compact('users', 'totalUsers'));
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.show');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Cek role dan redirect sesuai role
        $user = auth()->user();

        if ($user->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        } elseif ($user->role === 'pengelola') {
            return redirect()->route('pengelola.dashboard');
        } elseif ($user->role === 'pengguna') {
            return redirect('/pengguna.dashboard'); // kalau ada
        }

        return redirect('/'); // fallback
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
}


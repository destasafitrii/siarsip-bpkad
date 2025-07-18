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
    // Tambahkan validasi
   

    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ], [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Kata sandi wajib diisi.',
    ]);

    // Lanjutkan proses login seperti biasa
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = auth()->user();

        if ($user->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        } elseif ($user->role === 'pengelola') {
            return redirect()->route('pengelola.dashboard');
        } elseif ($user->role === 'pengguna') {
            return redirect()->route('pengguna.dashboard');
        }

        return redirect('/');
    }

   return back()->withErrors([
    'login' => 'Email atau password salah.',
])->withInput();

}



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
}


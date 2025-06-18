<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::where('role', 'pengguna')
                       ->where('opd_id', auth()->user()->opd_id)
                       ->get();

        return view('backend.pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('backend.pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengguna',
            'opd_id' => auth()->user()->opd_id,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $pengguna)
    {
        $this->authorizePengguna($pengguna);
        return view('backend.pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, User $pengguna)
{
    $this->authorizePengguna($pengguna);

    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $pengguna->id,
        'password' => 'nullable|min:6|confirmed', // ← tambahkan validasi password opsional
    ]);

    $pengguna->name = $request->name;
    $pengguna->email = $request->email;

    // Update password hanya jika diisi
    if ($request->filled('password')) {
        $pengguna->password = Hash::make($request->password);
    }

    $pengguna->save();

    return redirect()->route('pengguna.index')->with('success', 'pengguna berhasil diperbarui.');
}

    public function destroy(User $pengguna)
    {
        $this->authorizePengguna($pengguna);
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'pengguna berhasil dihapus.');
    }

    protected function authorizePengguna(User $pengguna)
    {
        if ($pengguna->opd_id !== auth()->user()->opd_id || $pengguna->role !== 'pengguna') {
            abort(403);
        }
    }
    
}

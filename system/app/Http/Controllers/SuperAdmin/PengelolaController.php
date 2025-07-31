<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PengelolaController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'pengelola')->with('opd')->get();
        return view('superadmin.pengelola.index', compact('admins'));
    }

    public function create()
    {
        $opds = Opd::all();
        return view('superadmin.pengelola.create', compact('opds'));
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'opd_id' => 'required|exists:opds,id',
        'nip' => 'nullable|string|unique:users,nip',
        'jabatan' => 'nullable|string|max:255',
        'golongan' => 'nullable|string|max:50',
    ]);

    // Buat password otomatis
   $password = Str::random(8);

User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($password),
    'password_plain' => $password, // disimpan sebagai teks biasa
    'role' => 'pengelola',
    'opd_id' => $request->opd_id,
    'nip' => $request->nip,
    'jabatan' => $request->jabatan,
    'golongan' => $request->golongan,
]);


    // Jika ingin menampilkan password yang digenerate, bisa simpan di session
    return redirect()->route('pengelola.index')
        ->with('success', 'Data Pengelola berhasil ditambahkan. Password default: ' . $password);
}


    public function edit($id)
    {
        $admin = User::findOrFail($id);
        $opds = Opd::all();
        return view('superadmin.pengelola.edit', compact('admin', 'opds'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($admin->id)],
            'opd_id' => 'required|exists:opds,id',
            'password' => 'nullable|string|min:6|confirmed',
            'nip' => ['nullable', 'string', Rule::unique('users')->ignore($admin->id)],
            'jabatan' => 'nullable|string|max:255',
            'golongan' => 'nullable|string|max:50',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->opd_id = $request->opd_id;
        $admin->nip = $request->nip;
        $admin->jabatan = $request->jabatan;
        $admin->golongan = $request->golongan;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('pengelola.index')->with('success', 'Data Pengelola berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('pengelola.index')->with('success', 'Data Pengelola berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'opd_id' => 'required|exists:opds,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengelola',
            'opd_id' => $request->opd_id,
        ]);

        return redirect()->route('pengelola.index')->with('success', 'Data Pengelola Berhasil Ditambahkan.');
    }

   public function update(Request $request, $id)
{
    $admin = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string',
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($admin->id),
        ],
        'opd_id' => 'required|exists:opds,id',
        'password' => 'nullable|string|confirmed',
    ]);

    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->opd_id = $request->opd_id;

    if ($request->filled('password')) {
        $admin->password = Hash::make($request->password);
    }

    $admin->save();

    return redirect()->route('pengelola.index')->with('success', 'Data Pengelola Berhasil Diperbarui.');
}

public function destroy($id)
{
    $admin = User::findOrFail($id);
    $admin->delete();

    return redirect()->route('pengelola.index')->with('success', 'Data Pengelola Berhasil Dihapus.');
}
}

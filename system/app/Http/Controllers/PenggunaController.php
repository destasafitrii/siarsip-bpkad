<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Opd;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::with('pegawai')
            ->where('role', 'pengguna')
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
        'pegawai_id' => 'required|exists:pegawai,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ]);

    // Cek apakah pegawai sudah memiliki akun
    $existing = User::where('pegawai_id', $request->pegawai_id)->first();
    if ($existing) {
        return back()->with('error', 'Pegawai ini sudah memiliki akun.');
    }

    // Update data pegawai
    $pegawai = Pegawai::find($request->pegawai_id);
    $pegawai->nip = $request->nip;
    $pegawai->nik = $request->nik;
    $pegawai->jabatan = $request->jabatan;
    $pegawai->golongan = $request->golongan;
    $pegawai->save();

    // 🔐 Generate password acak
    $generatedPassword = Str::random(8);

    // Simpan user
    User::create([
        'pegawai_id' => $request->pegawai_id,
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($generatedPassword),
        'role' => 'pengguna',
        'opd_id' => auth()->user()->opd_id,
    ]);

    return back()->with('success', 'Akun Pengguna berhasil ditambahkan. Password awal: ' . $generatedPassword);
}
    public function show(User $pengguna)
    {
        return view('backend.pengguna.show', compact('pengguna'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pengguna->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $pengguna->name = $request->name;
        $pengguna->email = $request->email;

        if ($request->filled('password')) {
            $pengguna->password = Hash::make($request->password);
        }

        $pengguna->save();

        return redirect()->route('pengguna.index')->with('success', 'Akun Pengguna berhasil diperbarui.');
    }

    public function destroy(User $pengguna)
    {
        $this->authorizePengguna($pengguna);
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Akun Pengguna berhasil dihapus.');
    }

    protected function authorizePengguna(User $pengguna)
    {
        if ($pengguna->opd_id !== auth()->user()->opd_id || $pengguna->role !== 'pengguna') {
            abort(403);
        }
    }

    public function getPegawaiByNipNik(Request $request)
    {
        $query = $request->nip;

        $pegawai = Pegawai::where('nip', $query)
            ->orWhere('nik', $query)
            ->first();

        if ($pegawai) {
            return response()->json([
                'nama' => $pegawai->nama,
                'jabatan' => $pegawai->jabatan,
                'golongan' => $pegawai->golongan,
                'pegawai_id' => $pegawai->id,
                'nik' => $pegawai->nik, // ✅ ditambahkan
            ]);
        } else {
            return response()->json([], 404);
        }
    }
}

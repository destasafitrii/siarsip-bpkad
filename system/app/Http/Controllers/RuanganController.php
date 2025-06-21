<?php


namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('backend.manajemen_lokasi.ruangan', compact('ruangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required|unique:ruangan,kode_ruangan',
            'nama_ruangan' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Ruangan::create([
            'kode_ruangan' => $request->kode_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/pengelola/ruangan')->with('success', 'Ruangan berhasil ditambahkan.');
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'kode_ruangan' => 'required|unique:ruangan,kode_ruangan,' . $id . ',ruangan_id',
        'nama_ruangan' => 'required|string|max:255',
        'alamat' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:255',
    ]);

    $ruangan = Ruangan::findOrFail($id);
    $ruangan->update([
        'kode_ruangan' => $request->kode_ruangan,
        'nama_ruangan' => $request->nama_ruangan,
        'alamat' => $request->alamat,
        'keterangan' => $request->keterangan,
    ]);

    return redirect('/pengelola/ruangan')->with('success', 'Ruangan berhasil diperbarui.');
}


public function destroy($id)
{
    $ruangan = Ruangan::findOrFail($id);
    $ruangan->delete();

    return redirect('/pengelola/ruangan')->with('success', 'Ruangan berhasil dihapus.');
}

}


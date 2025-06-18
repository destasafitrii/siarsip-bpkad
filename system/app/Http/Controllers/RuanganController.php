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
            'nama_ruangan' => 'required|string|max:255',
        ]);

        Ruangan::create([
            'nama_ruangan' => $request->nama_ruangan,
        ]);

        return redirect('/pengelola/ruangan')->with('success', 'Ruangan berhasil ditambahkan.');
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'nama_ruangan' => 'required|string|max:255',
    ]);

    $ruangan = Ruangan::findOrFail($id);
    $ruangan->update([
        'nama_ruangan' => $request->nama_ruangan,
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


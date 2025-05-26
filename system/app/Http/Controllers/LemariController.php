<?php

namespace App\Http\Controllers;

use App\Models\Lemari;
use App\Models\Ruangan;
use App\Models\Box;
use Illuminate\Http\Request;

class LemariController extends Controller
{
    public function index()
    {
        $lemari = Lemari::with('ruangan')->get();
        $ruangan = Ruangan::all(); // untuk dropdown tambah/ubah
        return view('backend.manajemen_lokasi.lemari', compact('lemari', 'ruangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lemari' => 'required|string|max:255',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
        ]);

        Lemari::create([
            'nama_lemari' => $request->nama_lemari,
            'ruangan_id' => $request->ruangan_id,
        ]);

        return redirect('/lemari')->with('success', 'Lemari berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lemari' => 'required|string|max:255',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
        ]);

        $lemari = Lemari::findOrFail($id);
        $lemari->update([
            'nama_lemari' => $request->nama_lemari,
            'ruangan_id' => $request->ruangan_id,
        ]);

        return redirect('/lemari')->with('success', 'Lemari berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lemari = Lemari::findOrFail($id);
        $lemari->delete();

        return redirect('/lemari')->with('success', 'Lemari berhasil dihapus.');
    }

    public function getByRuangan($id)
{
    $lemari = Lemari::where('ruangan_id', $id)->get();
    return response()->json($lemari);
}

public function getBoxByLemari($lemari_id)
{
    $box = Box::where('lemari_id', $lemari_id)->get();
    return response()->json($box);
}

}

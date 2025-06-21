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
            'kode_lemari' => 'required|unique:lemari,kode_lemari',
            'nama_lemari' => 'required',
            'jumlah_rak' => 'required|integer|min:1',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
        ]);

        Lemari::create([
            'kode_lemari' => $request->kode_lemari,
            'nama_lemari' => $request->nama_lemari,
            'jumlah_rak' => $request->jumlah_rak,
            'ruangan_id' => $request->ruangan_id,

        ]);

        return redirect('/pengelola/lemari')->with('success', 'Lemari berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_lemari' => 'required|unique:lemari,kode_lemari,' . $id . ',lemari_id',
            'nama_lemari' => 'required',
            'jumlah_rak' => 'required|integer|min:1',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
        ]);

        $lemari = Lemari::findOrFail($id);
        $lemari->update([
            'kode_lemari' => $request->kode_lemari,
            'nama_lemari' => $request->nama_lemari,
            'jumlah_rak' => $request->jumlah_rak,
            'ruangan_id' => $request->ruangan_id,
        ]);

        return redirect('/pengelola/lemari')->with('success', 'Lemari berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lemari = Lemari::findOrFail($id);
        $lemari->delete();

        return redirect('/pengelola/lemari')->with('success', 'Lemari berhasil dihapus.');
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

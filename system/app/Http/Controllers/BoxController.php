<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\Lemari;

class BoxController extends Controller
{
    // Menampilkan daftar box
    public function index()
    {
        $box = Box::with('lemari')->get();
        $lemari = Lemari::all();

        return view('backend.manajemen_lokasi.box', compact('box', 'lemari'));
    }

    // Menyimpan box baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_box' => 'required|string|max:255',
            'lemari_id' => 'required|exists:lemari,lemari_id',
        ]);

        Box::create([
            'nama_box' => $request->nama_box,
            'lemari_id' => $request->lemari_id,
        ]);

        return redirect()->back()->with('success', 'Data box berhasil ditambahkan.');
    }

    // Mengupdate data box
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_box' => 'required|string|max:255',
            'lemari_id' => 'required|exists:lemari,lemari_id',
        ]);

        $box = Box::findOrFail($id);
        $box->update([
            'nama_box' => $request->nama_box,
            'lemari_id' => $request->lemari_id,
        ]);

        return redirect()->back()->with('success', 'Data box berhasil diperbarui.');
    }

    // Menghapus data box
    public function destroy($id)
    {
        $box = Box::findOrFail($id);
        $box->delete();

        return redirect()->back()->with('success', 'Data box berhasil dihapus.');
    }

    public function getByLemari($lemari_id)
{
    $box = Box::where('lemari_id', $lemari_id)->get();
    return response()->json($box);
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    public function index()
    {
        // Mengambil semua data bidang untuk ditampilkan di halaman
        $bidang = Bidang::all();
        return view('backend.bidang.index', compact('bidang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bidang' => 'required|unique:bidang,kode_bidang',
            'nama_bidang' => 'required',
            'penanggung_jawab' => 'required',
        ]);

        Bidang::create([
            'kode_bidang' => $request->kode_bidang,
            'nama_bidang' => $request->nama_bidang,
            'penanggung_jawab' => $request->penanggung_jawab
        ]);

        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_bidang' => 'required|unique:bidang,kode_bidang',
            'nama_bidang' => 'required',
            'penanggung_jawab' => 'required',
        ]);

        $bidang = Bidang::findOrFail($id);
        $bidang->update([
            'kode_bidang' => $request->kode_bidang,
            'nama_bidang' => $request->nama_bidang,
            'penanggung_jawab' => $request->penanggung_jawab
        ]);

        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bidang = Bidang::findOrFail($id);
        $bidang->delete();

        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil dihapus.');
    }
}

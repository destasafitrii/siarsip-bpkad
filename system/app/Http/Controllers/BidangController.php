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
            'nama_bidang' => 'required|string|max:255',
        ]);

        Bidang::create([
            'nama_bidang' => $request->nama_bidang,
        ]);

        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bidang' => 'required|string|max:255',
        ]);

        $bidang = Bidang::findOrFail($id);
        $bidang->update([
            'nama_bidang' => $request->nama_bidang,
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

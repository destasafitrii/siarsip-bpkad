<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Bidang;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::with('bidang')->get(); // Ambil relasi bidang
        $bidang = Bidang::all(); // Ambil semua bidang
        return view('backend.kategori.index', compact('kategori', 'bidang'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
         'bidang_id' => 'required|exists:bidang,bidang_id',

        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'bidang_id' => $request->bidang_id,
        ]);

        // Mengembalikan view dengan data kategori dan bidang
        $kategori = Kategori::with('bidang')->get(); // Ambil relasi bidang
        $bidang = Bidang::all(); // Ambil semua bidang
        return view('backend.kategori.index', compact('kategori', 'bidang'))->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        'bidang_id' => 'required|exists:bidang,bidang_id',

        ]);

        // Ambil data kategori berdasarkan ID
        $kategori = Kategori::find($id); // Menggunakan find() untuk mendapatkan kategori berdasarkan ID

        // Pastikan kategori ditemukan
        if (!$kategori) {
            return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
        }

        // Lakukan update data kategori
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'bidang_id' => $request->bidang_id,
        ]);

        // Ambil data kategori dan bidang setelah update
        $kategori = Kategori::with('bidang')->get(); // Ambil relasi bidang
        $bidang = Bidang::all(); // Ambil semua bidang

        // Kembalikan ke halaman kategori dengan pesan sukses
        return view('backend.kategori.index', compact('kategori', 'bidang'))->with('success', 'Kategori berhasil diperbarui.');
    }
    
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        // Mengembalikan view dengan data kategori dan bidang
        $kategori = Kategori::with('bidang')->get(); // Ambil relasi bidang
        $bidang = Bidang::all(); // Ambil semua bidang
        return view('backend.kategori.index', compact('kategori', 'bidang'))->with('success', 'Kategori berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratKeluar;
use App\Models\Bidang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Log;

class ArsipSuratKeluarController extends Controller
{
    public function index()
    {
        // Menambahkan eager loading dengan relasi bidang dan kategori
        $list_arsip_surat_keluar = ArsipSuratKeluar::with(['bidang', 'kategori'])->paginate(10);
        return view('backend.arsip_keluar.index', compact('list_arsip_surat_keluar'));
    }

    public function create()
    {
        // Mendapatkan semua bidang dan kategori untuk form create
        $list_bidang = Bidang::all();
        $list_kategori = Kategori::all();
        return view('backend.arsip_keluar.create', compact('list_bidang', 'list_kategori'));
    }

    public function store(Request $request)
    {
        // Validasi input untuk menyimpan arsip surat keluar
        $validatedData = $request->validate([
            'no_surat_keluar' => 'required',
            'nama_surat_keluar' => 'required',
            'tanggal_surat_keluar' => 'required|date',
            'bidang_id' => 'required|exists:bidang,bidang_id',
            'kategori_id' => 'nullable|exists:kategori,kategori_id',
            'tujuan_surat_keluar' => 'required',
            'no_berkas_surat_keluar' => 'required',
            'urutan_surat_keluar' => 'required',
            'lokasi_surat_keluar' => 'required',
            'file_surat_keluar' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240',
            'keterangan_surat_keluar' => 'nullable',
        ]);

        // Menyimpan file jika ada
        if ($request->hasFile('file_surat_keluar')) {
            $validatedData['file_surat_keluar'] = $request->file('file_surat_keluar')->store('uploads/surat_keluar', 'public');
        }

        // Membuat arsip surat keluar baru berdasarkan input yang sudah divalidasi
        ArsipSuratKeluar::create($validatedData);

        // Redirect ke halaman arsip surat keluar dengan pesan sukses
        return redirect()->route('arsip_keluar.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Menampilkan arsip surat keluar berdasarkan ID dan memuat relasi bidang dan kategori
        $arsip_surat_keluar = ArsipSuratKeluar::with(['bidang', 'kategori'])->findOrFail($id);
        return view('backend.arsip_keluar.show', compact('arsip_surat_keluar'));
    }

    // Controller untuk mengedit arsip surat keluar
    // Controller untuk mengedit arsip surat keluar
    public function edit($id)
    {
        $arsip_surat_keluar = ArsipSuratKeluar::with(['bidang', 'kategori'])->findOrFail($id);

        // Mendapatkan semua bidang
        $list_bidang = Bidang::all();

        // Memuat kategori berdasarkan bidang yang sedang dipilih
        $list_kategori = Kategori::where('bidang_id', $arsip_surat_keluar->bidang_id)->get();

        return view('backend.arsip_keluar.edit', compact('arsip_surat_keluar', 'list_bidang', 'list_kategori'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input untuk memperbarui arsip surat keluar
        $validatedData = $request->validate([
            'no_surat_keluar' => 'required',
            'nama_surat_keluar' => 'required',
            'tanggal_surat_keluar' => 'required|date',
            'bidang_id' => 'required|exists:bidang,bidang_id',
            'kategori_id' => 'nullable|exists:kategori,kategori_id',
            'tujuan_surat_keluar' => 'required',
            'no_berkas_surat_keluar' => 'required',
            'urutan_surat_keluar' => 'required',
            'lokasi_surat_keluar' => 'required',
            'file_surat_keluar' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240',
            'keterangan_surat_keluar' => 'nullable',
        ]);

        // Menemukan arsip surat keluar yang akan diperbarui dan memperbarui data
        $arsip_surat_keluar = ArsipSuratKeluar::findOrFail($id);
        $arsip_surat_keluar->update($validatedData);

        // Redirect ke halaman arsip surat keluar dengan pesan sukses
        return redirect()->route('arsip_keluar.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Menghapus arsip surat keluar berdasarkan ID
        $arsip_surat_keluar = ArsipSuratKeluar::findOrFail($id);
        $arsip_surat_keluar->delete();

        // Redirect ke halaman arsip surat keluar dengan pesan sukses
        return redirect()->route('arsip_keluar.index')->with('success', 'Data berhasil dihapus!');
    }

    // Fungsi untuk mendapatkan kategori berdasarkan bidang yang dipilih
    public function getKategoriByBidang($bidang_id)
    {
        $list_kategori = Kategori::where('bidang_id', $bidang_id)->get(['kategori_id', 'nama_kategori']);

        if ($list_kategori->isEmpty()) {
            Log::info("Tidak ada kategori ditemukan untuk bidang_id: " . $bidang_id);
            return response()->json([], 200);
        }

        return response()->json($list_kategori, 200);
    }
}
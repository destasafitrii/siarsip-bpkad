<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\Bidang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Log;

class ArsipSuratMasukController extends Controller
{
    public function index()
    {
        // Menambahkan eager loading dengan relasi bidang dan kategori
        $list_arsip_surat_masuk = ArsipSuratMasuk::with(['bidang', 'kategori'])->paginate(10);
        return view('content.arsip_masuk.index', compact('list_arsip_surat_masuk'));
    }

    public function create()
    {
        // Mendapatkan semua bidang dan kategori untuk form create
        $list_bidang = Bidang::all();
        $list_kategori = Kategori::all();
        return view('content.arsip_masuk.create', compact('list_bidang', 'list_kategori'));
    }

    public function store(Request $request)
    {
        // Validasi input untuk menyimpan arsip surat masuk
        $validatedData = $request->validate([
            'no_surat_masuk' => 'required',
            'nama_surat_masuk' => 'required',
            'tanggal_surat_masuk' => 'required|date',
            'bidang_id' => 'required|exists:bidang,bidang_id',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'asal_surat_masuk' => 'required',
            'no_berkas_surat_masuk' => 'required',
            'urutan_surat_masuk' => 'required',
            'lokasi_surat_masuk' => 'required',
            'file_surat_masuk' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240',
            'keterangan' => 'nullable',
        ]);

        // Menyimpan file jika ada
        if ($request->hasFile('file_surat_masuk')) {
            $validatedData['file_surat_masuk'] = $request->file('file_surat_masuk')->store('uploads/surat_masuk');
        }

        // Membuat arsip surat masuk baru berdasarkan input yang sudah divalidasi
        ArsipSuratMasuk::create($validatedData);

        // Redirect ke halaman arsip surat masuk dengan pesan sukses
        return redirect()->route('arsip_masuk.index')->with('success', 'Data berhasil ditambahkan!');

    }

    public function show($id)
    {
        // Menampilkan arsip surat masuk berdasarkan ID dan memuat relasi bidang dan kategori
        $arsip_surat_masuk = ArsipSuratMasuk::with(['bidang', 'kategori'])->findOrFail($id);
        return view('content.arsip_masuk.show', compact('arsip_surat_masuk'));
    }

    // Controller untuk mengedit arsip surat masuk
// Controller untuk mengedit arsip surat masuk
public function edit($id)
{
    $arsip_surat_masuk = ArsipSuratMasuk::with(['bidang', 'kategori'])->findOrFail($id);

    // Mendapatkan semua bidang
    $list_bidang = Bidang::all();

    // Memuat kategori berdasarkan bidang yang sedang dipilih
    $list_kategori = Kategori::where('bidang_id', $arsip_surat_masuk->bidang_id)->get();

    return view('content.arsip_masuk.edit', compact('arsip_surat_masuk', 'list_bidang', 'list_kategori'));
}





    public function update(Request $request, $id)
    {
        // Validasi input untuk memperbarui arsip surat masuk
        $validatedData = $request->validate([
            'no_surat_masuk' => 'required',
            'nama_surat_masuk' => 'required',
            'tanggal_surat_masuk' => 'required|date',
            'bidang_id' => 'required|exists:bidang,bidang_id',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'asal_surat_masuk' => 'required',
            'no_berkas_surat_masuk' => 'required',
            'urutan_surat_masuk' => 'required',
            'lokasi_surat_masuk' => 'required',
            'file_surat_masuk' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240',
            'keterangan' => 'nullable',
        ]);

        // Menemukan arsip surat masuk yang akan diperbarui dan memperbarui data
        $arsip_surat_masuk = ArsipSuratMasuk::findOrFail($id);
        $arsip_surat_masuk->update($validatedData);

        // Redirect ke halaman arsip surat masuk dengan pesan sukses
        return redirect()->route('arsip_masuk.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Menghapus arsip surat masuk berdasarkan ID
        $arsip_surat_masuk = ArsipSuratMasuk::findOrFail($id);
        $arsip_surat_masuk->delete();

        // Redirect ke halaman arsip surat masuk dengan pesan sukses
        return redirect()->route('arsip_masuk.index')->with('success', 'Data berhasil dihapus!');
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

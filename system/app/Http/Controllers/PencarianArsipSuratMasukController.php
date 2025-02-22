<?php

namespace App\Http\Controllers;

use App\Models\ArsipSuratMasuk;
use App\Models\Bidang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PencarianArsipSuratMasukController extends Controller
{
    /**
     * Menampilkan halaman pencarian arsip surat masuk.
     */
    public function index(Request $request)
    {
        // Ambil data Bidang
        $bidangs = Bidang::all();

        // Ambil kategori berdasarkan bidang yang dipilih (jika ada)
        $kategoris = $request->has('bidang_id') && $request->bidang_id !== null
            ? Kategori::where('bidang_id', $request->bidang_id)->get()
            : Kategori::all(); // Jika tidak ada bidang terpilih, ambil semua kategori

        $query = ArsipSuratMasuk::query();

        // Filter berdasarkan keyword pencarian
        if ($request->has('keyword') && $request->keyword !== null) {
            $query->where(function ($q) use ($request) {
                $q->where('no_surat_masuk', 'like', '%' . $request->keyword . '%')
                    ->orWhere('nama_surat_masuk', 'like', '%' . $request->keyword . '%')
                    ->orWhere('asal_surat_masuk', 'like', '%' . $request->keyword . '%')
                    ->orWhereHas('bidang', function ($q) use ($request) {
                        $q->where('nama_bidang', 'like', '%' . $request->keyword . '%');
                    })
                    ->orWhereHas('kategori', function ($q) use ($request) {
                        $q->where('nama_kategori', 'like', '%' . $request->keyword . '%');
                    });

                // Pencarian berdasarkan tahun jika ada dalam keyword
                if (preg_match('/\d{4}/', $request->keyword, $matches)) {
                    $tahun = $matches[0]; // Ambil tahun yang ditemukan
                    $q->orWhereYear('tanggal_surat_masuk', $tahun);
                }
            });
        }

        // Filter berdasarkan Bidang
        if ($request->has('bidang_id') && $request->bidang_id !== null) {
            $query->where('bidang_id', $request->bidang_id);
        }

        // Filter berdasarkan Kategori 
        if ($request->has('kategori_id') && $request->kategori_id !== null) {
            // Pastikan kategori_id yang dipilih benar-benar ada dalam arsip
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('kategori_id', $request->kategori_id);
            });
        }

        // Filter berdasarkan tanggal surat
        if ($request->has('tanggal_surat_masuk') && $request->tanggal_surat_masuk !== null) {
            $query->whereDate('tanggal_surat_masuk', $request->tanggal_surat_masuk);
        }

        // Ambil data dengan pagination
        $arsipSuratMasuk = $query->paginate(10);

        return view('backend.arsip_masuk.pencarian_arsip_masuk', compact('arsipSuratMasuk', 'bidangs', 'kategoris'));
    }

    /**
     * Mengambil kategori berdasarkan bidang_id
     */
    public function getKategorisByBidang($bidang_id)
    {
        $kategoris = Kategori::where('bidang_id', $bidang_id)->get();
        return response()->json(['kategoris' => $kategoris]);
    }
}

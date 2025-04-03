<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;
use App\Models\Bidang;
use App\Models\Kategori;

class PencarianController extends Controller
{
    public function index()
    {
        // Ambil data Bidang & Kategori
        $bidangs = Bidang::all();
        $kategoris = Kategori::all();

        // Arahkan ke view pencarian
        return view('frontend.pencarian', compact('bidangs', 'kategoris'));
    }

    public function search(Request $request)
    {
        $keyword = $request->get('search');
        $filters = explode(" ", $keyword);

        // Ambil filter tambahan
        $bidang_id = $request->get('bidang_id');
        $kategori_id = $request->get('kategori_id');
        $tahun = $request->get('tahun'); // Hanya filter berdasarkan tahun

        // Query Arsip Surat Masuk
        $ArsipSuratMasuk = ArsipSuratMasuk::with(['bidang', 'kategori']);

        foreach ($filters as $filter) {
            $ArsipSuratMasuk->where(function ($query) use ($filter) {
                $query->where('nama_surat_masuk', 'LIKE', "%{$filter}%")
                    ->orWhere('no_surat_masuk', 'LIKE', "%{$filter}%")
                    ->orWhere('lokasi_surat_masuk', 'LIKE', "%{$filter}%")
                    ->orWhereHas('bidang', function ($q) use ($filter) {
                        $q->where('nama_bidang', 'LIKE', "%{$filter}%");
                    })
                    ->orWhereHas('kategori', function ($q) use ($filter) {
                        $q->where('nama_kategori', 'LIKE', "%{$filter}%");
                    });
            });
        }

        // Filter berdasarkan bidang
        if (!empty($bidang_id)) {
            $ArsipSuratMasuk->where('bidang_id', $bidang_id);
        }

        // Filter berdasarkan kategori
        if (!empty($kategori_id)) {
            $ArsipSuratMasuk->where('kategori_id', $kategori_id);
        }

        // Filter berdasarkan tahun saja
        if (!empty($tahun)) {
            $ArsipSuratMasuk->whereYear('tanggal_surat_masuk', '=', $tahun);
        }

        $ArsipSuratMasuk = $ArsipSuratMasuk->paginate(10);

        // Query Arsip Surat Keluar
        $ArsipSuratKeluar = ArsipSuratKeluar::with(['bidang', 'kategori']);

        foreach ($filters as $filter) {
            $ArsipSuratKeluar->where(function ($query) use ($filter) {
                $query->where('nama_surat_keluar', 'LIKE', "%{$filter}%")
                    ->orWhere('no_surat_keluar', 'LIKE', "%{$filter}%")
                    ->orWhere('lokasi_surat_keluar', 'LIKE', "%{$filter}%")
                    ->orWhereHas('bidang', function ($q) use ($filter) {
                        $q->where('nama_bidang', 'LIKE', "%{$filter}%");
                    })
                    ->orWhereHas('kategori', function ($q) use ($filter) {
                        $q->where('nama_kategori', 'LIKE', "%{$filter}%");
                    });
            });
        }

        // Filter berdasarkan bidang
        if (!empty($bidang_id)) {
            $ArsipSuratKeluar->where('bidang_id', $bidang_id);
        }

        // Filter berdasarkan kategori
        if (!empty($kategori_id)) {
            $ArsipSuratKeluar->where('kategori_id', $kategori_id);
        }

        // Filter berdasarkan tahun saja
        if (!empty($tahun)) {
            $ArsipSuratKeluar->whereYear('tanggal_surat_keluar', '=', $tahun);
        }

        $ArsipSuratKeluar = $ArsipSuratKeluar->paginate(10);

        // Ambil kembali daftar bidang dan kategori
        $bidangs = Bidang::all();
        $kategoris = Kategori::all();

        return view('frontend.hasil-pencarian', compact('ArsipSuratMasuk', 'ArsipSuratKeluar', 'keyword', 'bidangs', 'kategoris', 'tahun'));
    }

    public function showMasuk($id)
    {
        $arsip = ArsipSuratMasuk::where('surat_masuk_id', $id)->with(['bidang', 'kategori'])->firstOrFail();
        return view('frontend.show-arsip-masuk', compact('arsip'));
    }

    public function showKeluar($id)
    {
        $arsip = ArsipSuratKeluar::where('surat_keluar_id', $id)->with(['bidang', 'kategori'])->firstOrFail();
        return view('frontend.show-arsip-keluar', compact('arsip'));
    }
}

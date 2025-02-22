<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;
use App\Models\Bidang;
use Illuminate\Pagination\LengthAwarePaginator;

class PencarianArsipController extends Controller
{
    public function index(Request $request)
{
    $list_bidang = Bidang::all();
    $queryArsipSuratMasuk = ArsipSuratMasuk::query();
    $queryArsipSuratKeluar = ArsipSuratKeluar::query();

    // Filter berdasarkan input pencarian
    if ($request->filled('nama_surat')) {
        $nama_surat = $request->nama_surat;
        $queryArsipSuratMasuk->where('nama_surat_masuk', 'like', "%$nama_surat%");
        $queryArsipSuratKeluar->where('nama_surat_keluar', 'like', "%$nama_surat%");
    }

    // Filter berdasarkan tanggal
    if ($request->filled('tanggal')) {
        $tanggal = $request->tanggal;
        $queryArsipSuratMasuk->whereDate('tanggal_surat_masuk', $tanggal);
        $queryArsipSuratKeluar->whereDate('tanggal_surat_keluar', $tanggal);
    }

    // Filter berdasarkan jenis arsip
    if ($request->filled('jenis_arsip')) {
        $jenis_arsip = $request->jenis_arsip;
        if ($jenis_arsip === 'masuk') {
            $queryArsipSuratKeluar = $queryArsipSuratKeluar->whereNull('id'); // Tidak mengambil arsip surat keluar
        } elseif ($jenis_arsip === 'keluar') {
            $queryArsipSuratMasuk = $queryArsipSuratMasuk->whereNull('id'); // Tidak mengambil arsip surat masuk
        }
    }

    // Filter berdasarkan bidang
    if ($request->filled('bidang')) {
        $bidang = $request->bidang;
        $queryArsipSuratMasuk->where('bidang_id', $bidang);
        $queryArsipSuratKeluar->where('bidang_id', $bidang);
    }

    // Filter berdasarkan nomor surat
    if ($request->filled('no_surat')) {
        $no_surat = $request->no_surat;
        $queryArsipSuratMasuk->where('no_surat_masuk', 'like', "%$no_surat%");
        $queryArsipSuratKeluar->where('no_surat_keluar', 'like', "%$no_surat%");
    }

    // Ambil data arsip surat masuk dan keluar
    $arsip_surat_masuk = $queryArsipSuratMasuk->get();
    $arsip_surat_keluar = $queryArsipSuratKeluar->get();

    // Gabungkan kedua koleksi arsip
    $arsip_combined = $arsip_surat_masuk->merge($arsip_surat_keluar);

    // Membuat pagination dari gabungan arsip
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;
    $currentResults = $arsip_combined->slice(($currentPage - 1) * $perPage, $perPage)->values();
    $paginatedResults = new LengthAwarePaginator($currentResults, $arsip_combined->count(), $perPage, $currentPage);

    // Kirim data ke view
    return view('backend.pencarian_arsip.index', [
        'list_bidang' => $list_bidang,
        'paginatedResults' => $paginatedResults,
        'arsip_surat_masuk' => $arsip_surat_masuk,  // Pastikan variabel ini ada
        'arsip_surat_keluar' => $arsip_surat_keluar // Pastikan variabel ini ada
    ]);
}


}

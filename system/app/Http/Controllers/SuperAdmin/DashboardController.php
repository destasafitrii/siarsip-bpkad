<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Opd;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;
use App\Models\ArsipDokumen;

class DashboardController extends Controller
{
  public function index()
{
    $jumlahOpd = Opd::count();
    $jumlahPengelola = User::where('role', 'pengelola')->count();

    $totalArsipMasuk = ArsipSuratMasuk::count();
    $totalArsipKeluar = ArsipSuratKeluar::count();
       $totalArsipDokumen = ArsipDokumen::count(); 

    // Jumlah arsip per OPD
    $aktivitasPerOpd = Opd::withCount(['arsipSuratMasuk', 'arsipSuratKeluar', 'arsipDokumen'])
        ->get()
        ->map(function ($opd) {
            return (object)[
                'nama_opd' => $opd->nama_opd,
                'jumlah_masuk' => $opd->arsip_surat_masuk_count,
                'jumlah_keluar' => $opd->arsip_surat_keluar_count,
                 'jumlah_dokumen' => $opd->arsip_dokumen_count
            ];
        });

    // 10 Arsip terbaru (dari masuk & keluar)
    $arsipMasuk = ArsipSuratMasuk::with('opd')->latest('tanggal_surat_masuk')->limit(5)->get()->map(function ($a) {
        $a->jenis = 'Masuk';
    $a->tanggal_surat = $a->tanggal_surat_masuk;
    return $a;
    });

    $arsipKeluar = ArsipSuratKeluar::with('opd')->latest('tanggal_surat_keluar')->limit(5)->get()->map(function ($a) {
         $a->jenis = 'Keluar';
    $a->tanggal_surat = $a->tanggal_surat_keluar;
    return $a;
    });

    $arsipTerbaru = $arsipMasuk->merge($arsipKeluar)->sortByDesc('tanggal_surat')->take(10);

    return view('superadmin.dashboard', compact(
        'jumlahOpd',
        'jumlahPengelola',
        'totalArsipMasuk',
        'totalArsipKeluar',
         'totalArsipDokumen',
        'aktivitasPerOpd',
        'arsipTerbaru'
    ));
}

}

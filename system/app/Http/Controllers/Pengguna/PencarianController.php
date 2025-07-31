<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;
use App\Models\ArsipDokumen;
use App\Models\Bidang;
use App\Models\Kategori;
use App\Models\Opd;
use Illuminate\Pagination\LengthAwarePaginator;

class PencarianController extends Controller
{

    public function cari(Request $request)
{
    $user = auth()->user(); // Ambil user yang login
    $opd_id = $user->opd_id; // Ambil opd_id dari user

    $keyword = $request->input('keyword');
    $bidang_id = $request->input('bidang_id');
    $kategori_id = $request->input('kategori_id');

    // Ambil data dari masing-masing model
    $masuk = ArsipSuratMasuk::with(['bidang', 'kategori', 'box.lemari.ruangan', 'box'])
        ->whereHas('box.lemari.ruangan', function ($query) use ($opd_id) {
            $query->where('opd_id', $opd_id);
        })
        ->selectRaw("'surat_masuk' as jenis_arsip, surat_masuk_id as id, no_surat_masuk as nomor_surat, nama_surat_masuk as nama_surat, tanggal_surat_masuk as tanggal_surat, bidang_id, kategori_id, box_id, urutan_surat_masuk as urutan,  file_surat_masuk as file")
        ->when($keyword, fn($q) => $q->where(function ($q2) use ($keyword) {
            $q2->where('nama_surat_masuk', 'like', "%{$keyword}%")
               ->orWhere('no_surat_masuk', 'like', "%{$keyword}%");
        }))
        ->when($bidang_id, fn($q) => $q->where('bidang_id', $bidang_id))
        ->when($kategori_id, fn($q) => $q->where('kategori_id', $kategori_id));

    $keluar = ArsipSuratKeluar::with(['bidang', 'kategori', 'box.lemari.ruangan', 'box'])
        ->whereHas('box.lemari.ruangan', function ($query) use ($opd_id) {
            $query->where('opd_id', $opd_id);
        })
        ->selectRaw("'surat_keluar' as jenis_arsip, surat_keluar_id as id, no_surat_keluar as nomor_surat, nama_surat_keluar as nama_surat, tanggal_surat_keluar as tanggal_surat, bidang_id, kategori_id, box_id, urutan_surat_keluar as urutan, file_surat_keluar as file")
        ->when($keyword, fn($q) => $q->where(function ($q2) use ($keyword) {
            $q2->where('nama_surat_keluar', 'like', "%{$keyword}%")
               ->orWhere('no_surat_keluar', 'like', "%{$keyword}%");
        }))
        ->when($bidang_id, fn($q) => $q->where('bidang_id', $bidang_id))
        ->when($kategori_id, fn($q) => $q->where('kategori_id', $kategori_id));

    $dokumen = ArsipDokumen::with(['bidang', 'kategori', 'ruangan', 'lemari', 'box'])
        ->whereHas('ruangan', function ($query) use ($opd_id) {
            $query->where('opd_id', $opd_id);
        })
        ->selectRaw("'dokumen' as jenis_arsip, dokumen_id as id, no_dokumen as nomor_surat, nama_dokumen as nama_surat, tanggal_dokumen as tanggal_surat, bidang_id, kategori_id, ruangan_id, lemari_id, box_id, urutan as urutan, file_dokumen as file")
        ->when($keyword, fn($q) => $q->where(function ($q2) use ($keyword) {
            $q2->where('nama_dokumen', 'like', "%{$keyword}%")
               ->orWhere('no_dokumen', 'like', "%{$keyword}%");
        }))
        ->when($bidang_id, fn($q) => $q->where('bidang_id', $bidang_id))
        ->when($kategori_id, fn($q) => $q->where('kategori_id', $kategori_id));

    // Gabungkan hasil
    $masukResults = $masuk->get();
    $keluarResults = $keluar->get();
    $dokumenResults = $dokumen->get();

    $merged = $masukResults->concat($keluarResults)->concat($dokumenResults)->sortByDesc('tanggal_surat')->values();

    // Pagination manual
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;
    $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();
    $paginatedResults = new LengthAwarePaginator($currentItems, $merged->count(), $perPage, $currentPage, [
        'path' => LengthAwarePaginator::resolveCurrentPath(),
    ]);

    return view('pengguna.hasil-pencarian', [
        'arsip' => $paginatedResults,
        'bidang' => Bidang::where('opd_id', $opd_id)->get(),
    'kategori' => Kategori::whereIn('bidang_id', Bidang::where('opd_id', $opd_id)->pluck('bidang_id'))->get(),
        'jenis' => collect([
            (object)['id' => 'surat_masuk', 'nama_jenis' => 'Surat Masuk'],
            (object)['id' => 'surat_keluar', 'nama_jenis' => 'Surat Keluar'],
            (object)['id' => 'dokumen', 'nama_jenis' => 'Dokumen'],
        ])
    ]);
}

}

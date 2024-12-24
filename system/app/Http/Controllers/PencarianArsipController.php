<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;

class PencarianArsipController extends Controller
{
    public function index(Request $request)
    {
        $queryArsipSuratMasuk = ArsipSuratMasuk::query();
        $queryArsipSuratKeluar = ArsipSuratKeluar::query();

        // Filter berdasarkan input pencarian
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $queryArsipSuratMasuk->where(function ($query) use ($keyword) {
                $query->where('no_surat_masuk', 'like', "%$keyword%")
                    ->orWhere('nama_surat_masuk', 'like', "%$keyword%")
                    ->orWhere('asal_surat_masuk', 'like', "%$keyword%")
                    ->orWhere('no_berkas', 'like', "%$keyword%")
                    ->orWhere('urutan', 'like', "%$keyword%")
                    ->orWhere('lokasi', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });

            $queryArsipSuratKeluar->where(function ($query) use ($keyword) {
                $query->where('no_surat_keluar', 'like', "%$keyword%")
                    ->orWhere('nama_surat_keluar', 'like', "%$keyword%")
                    ->orWhere('tujuan_surat_keluar', 'like', "%$keyword%")
                    ->orWhere('no_berkas', 'like', "%$keyword%")
                    ->orWhere('urutan', 'like', "%$keyword%")
                    ->orWhere('lokasi', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        if ($request->filled('tanggal')) {
            $tanggal = $request->tanggal;
            $queryArsipSuratMasuk->whereDate('tanggal_surat_masuk', $tanggal);
            $queryArsipSuratKeluar->whereDate('tanggal_surat_keluar', $tanggal);
        }

        if ($request->filled('bidang')) {
            $bidang = $request->bidang;
            $queryArsipSuratMasuk->where('bidang', 'like', "%$bidang%");
            $queryArsipSuratKeluar->where('bidang', 'like', "%$bidang%");
        }

        if ($request->filled('no_surat')) {
            $no_surat = $request->no_surat;
            $queryArsipSuratMasuk->where('no_surat_masuk', 'like', "%$no_surat%");
            $queryArsipSuratKeluar->where('no_surat_keluar', 'like', "%$no_surat%");
        }

        // Ambil data yang sudah difilter
        $arsip_surat_masuk = $queryArsipSuratMasuk->paginate(10);
        $arsip_surat_keluar = $queryArsipSuratKeluar->paginate(10);

        return view('content.pencarian_arsip.index', compact('arsip_surat_masuk', 'arsip_surat_keluar'));
    }
}

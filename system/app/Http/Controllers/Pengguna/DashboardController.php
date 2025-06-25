<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;
use App\Models\ArsipDokumen;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pengguna.dashboard');
    }

    public function cariArsipMasuk(Request $request)
    {
        $user = Auth::user();

        $query = ArsipSuratMasuk::where('opd_id', $user->opd_id);

        if ($request->filled('keyword')) {
            $query->where('nama_surat_masuk', 'like', '%' . $request->keyword . '%');
        }

        $arsip = $query->paginate(10);

        return view('pengguna.cari_arsip_masuk', compact('arsip', 'request'));
    }

    public function cariArsipKeluar(Request $request)
    {
        $user = Auth::user();

        $query = ArsipSuratKeluar::where('opd_id', $user->opd_id);

        if ($request->filled('keyword')) {
            $query->where('nama_surat_keluar', 'like', '%' . $request->keyword . '%');
        }

        $arsip = $query->paginate(10);

        return view('pengguna.cari_arsip_keluar', compact('arsip', 'request'));
    }

    public function cariArsipDokumen(Request $request)
    {
        $user = Auth::user();

        $query = ArsipDokumen::where('opd_id', $user->opd_id);

        if ($request->filled('keyword')) {
            $query->where('nama_dokumen', 'like', '%' . $request->keyword . '%');
        }

        $arsip = $query->paginate(10);

        return view('pengguna.cari_arsip_dokumen', compact('arsip', 'request'));
    }
}

<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;
use App\Models\ArsipDokumen;

class DashboardController extends Controller
{
    public function index()
    {
        $opdId = Auth::user()->opd_id;

        $jumlahSuratMasuk = ArsipSuratMasuk::where('opd_id', $opdId)->count();
        $jumlahSuratKeluar = ArsipSuratKeluar::where('opd_id', $opdId)->count();
        $jumlahDokumen = ArsipDokumen::where('opd_id', $opdId)->count();

        return view('pengguna.dashboard', compact(
            'jumlahSuratMasuk',
            'jumlahSuratKeluar',
            'jumlahDokumen'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;

class QrController extends Controller
{
    public function tampilkanIsiBox($no_berkas)
    {
        $arsip = ArsipSuratMasuk::where('no_berkas_surat_masuk', $no_berkas)->get();

        return view('qr.hasil_scan', compact('arsip', 'no_berkas'));
    }
}


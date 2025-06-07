<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;

class QrController extends Controller
{
    public function tampilkanIsiBox($box_id)
{
    $arsipMasuk = ArsipSuratMasuk::where('box_id', $box_id)->get();
    $arsipKeluar = ArsipSuratKeluar::where('box_id', $box_id)->get();

    // Gabungkan dua koleksi arsip menjadi satu
    $arsipGabungan = collect();

    foreach ($arsipMasuk as $arsip) {
        $arsipGabungan->push([
            'no_surat' => $arsip->no_surat_masuk,
            'nama_surat' => $arsip->nama_surat_masuk,
            'urutan' => $arsip->urutan_surat_masuk,
            'lokasi' => $arsip->lokasi_surat_masuk,
        ]);
    }

    foreach ($arsipKeluar as $arsip) {
        $arsipGabungan->push([
            'no_surat' => $arsip->no_surat_keluar,
            'nama_surat' => $arsip->nama_surat_keluar,
            'urutan' => $arsip->urutan_surat_keluar,
            'lokasi' => $arsip->lokasi_surat_keluar,
        ]);
    }

    return view('qr.hasil_scan', [
        'arsip' => $arsipGabungan,
        'box_id' => $box_id
    ]);
}

}

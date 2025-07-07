<?php

namespace App\Http\Controllers;
use App\Models\Box;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;
use App\Models\ArsipDokumen;

class QrController extends Controller
{
    

public function tampilkanIsiBox($box_id)
{
    $arsipMasuk = ArsipSuratMasuk::where('box_id', $box_id)->get();
    $arsipKeluar = ArsipSuratKeluar::where('box_id', $box_id)->get();
    $arsipDokumen = ArsipDokumen::where('box_id', $box_id)->get();

    $box = Box::find($box_id);

    $arsipGabungan = collect();

    foreach ($arsipMasuk as $arsip) {
        $arsipGabungan->push((object)[
            'no_surat' => $arsip->no_surat_masuk,
            'nama_surat' => $arsip->nama_surat_masuk,
            'urutan' => $arsip->urutan_surat_masuk,
        ]);
    }

    foreach ($arsipKeluar as $arsip) {
        $arsipGabungan->push((object)[
            'no_surat' => $arsip->no_surat_keluar,
            'nama_surat' => $arsip->nama_surat_keluar,
            'urutan' => $arsip->urutan_surat_keluar,
        ]);
    }

    foreach ($arsipDokumen as $arsip) {
        $arsipGabungan->push((object)[
            'no_surat' => $arsip->no_dokumen,
            'nama_surat' => $arsip->nama_dokumen,
            'urutan' => $arsip->urutan,
        ]);
    }

    return view('qr.hasil_scan', [
        'arsip' => $arsipGabungan,
        'box' => $box,
    ]);
}
}

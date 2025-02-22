<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;

class PencarianController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('search');

        // Pencarian arsip surat masuk dengan pagination
        $ArsipSuratMasuk = ArsipSuratMasuk::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama_surat_masuk', 'LIKE', "%{$keyword}%")
                      ->orWhere('no_surat_masuk', 'LIKE', "%{$keyword}%")
                      ->orWhere('asal_surat_masuk', 'LIKE', "%{$keyword}%");
            })
            ->paginate(10);

        // Pencarian arsip surat keluar dengan pagination
        $ArsipSuratKeluar = ArsipSuratKeluar::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama_surat_keluar', 'LIKE', "%{$keyword}%")
                      ->orWhere('no_surat_keluar', 'LIKE', "%{$keyword}%")
                      ->orWhere('tujuan_surat_keluar', 'LIKE', "%{$keyword}%");
            })
            ->paginate(10);

        return view('frontend.hasil-pencarian', compact('ArsipSuratMasuk', 'ArsipSuratKeluar', 'keyword'));
    }
}

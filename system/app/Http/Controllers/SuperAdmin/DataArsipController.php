<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;
use App\Models\ArsipDokumen;
use Yajra\DataTables\Facades\DataTables;

class DataArsipController extends Controller
{
    public function index()
    {
        return view('superadmin.data_arsip.index');
    }

    public function getData(Request $request)
    {
        $dataGabungan = collect();

        // Arsip Surat Masuk
        $suratMasuk = ArsipSuratMasuk::with(['opd', 'bidang', 'kategori', 'ruangan', 'lemari', 'box'])->get();
        foreach ($suratMasuk as $item) {
            $dataGabungan->push([
                'jenis' => 'Surat Masuk',
                'no_surat' => $item->no_surat_masuk,
                'nama_surat' => $item->nama_surat_masuk,
                'opd' => $item->opd->nama_opd ?? '-',
                'bidang' => $item->bidang->nama_bidang ?? '-',
                'kategori' => $item->kategori->nama_kategori ?? '-',
                'ruangan' => $item->box->lemari->ruangan->nama_ruangan ?? '-',
                'lemari' => $item->box->lemari->nama_lemari ?? '-',

                'box' => $item->box->nama_box ?? '-',
                'tanggal' => $item->tanggal_surat_masuk,
                'aksi' => '<a href="' . route('data_arsip.show', ['Surat Masuk', $item->surat_masuk_id]) . '" class="btn btn-sm btn-info">Detail</a>',
            ]);
        }

        // Arsip Surat Keluar
        $suratKeluar = ArsipSuratKeluar::with(['opd', 'bidang', 'kategori', 'ruangan', 'lemari', 'box'])->get();
        foreach ($suratKeluar as $item) {
            $dataGabungan->push([
                'jenis' => 'Surat Keluar',
                'no_surat' => $item->no_surat_keluar,
                'nama_surat' => $item->nama_surat_keluar,
                'opd' => $item->opd->nama_opd ?? '-',
                'bidang' => $item->bidang->nama_bidang ?? '-',
                'kategori' => $item->kategori->nama_kategori ?? '-',
                'ruangan' => $item->box->lemari->ruangan->nama_ruangan ?? '-',
                'lemari' => $item->box->lemari->nama_lemari ?? '-',

                'box' => $item->box->nama_box ?? '-',
                'tanggal' => $item->tanggal_surat_keluar,
                'aksi' => '<a href="' . route('data_arsip.show', ['Surat Keluar', $item->surat_keluar_id]) . '" class="btn btn-sm btn-info">Detail</a>',
            ]);
        }

        // Arsip Dokumen
        $dokumen = ArsipDokumen::with(['opd', 'bidang', 'kategori', 'ruangan', 'lemari', 'box'])->get();
        foreach ($dokumen as $item) {
            $dataGabungan->push([
                'jenis' => 'Dokumen',
                'no_surat' => $item->no_dokumen ?? '-',
                'nama_surat' => $item->nama_dokumen,
                'opd' => $item->opd->nama_opd ?? '-',
                'bidang' => $item->bidang->nama_bidang ?? '-',
                'kategori' => $item->kategori->nama_kategori ?? '-',
                'ruangan' => $item->ruangan->nama_ruangan ?? '-',
                'lemari' => $item->lemari->nama_lemari ?? '-',
                'box' => $item->box->nama_box ?? '-',
                'tanggal' => $item->tanggal_dokumen,
                'aksi' => '<a href="' . route('data_arsip.show', ['Dokumen', $item->dokumen_id]) . '" class="btn btn-sm btn-info">Detail</a>',
            ]);
        }

        return DataTables::of($dataGabungan)->rawColumns(['aksi'])->make(true);
    }

    public function show($jenis, $id)
    {
        if ($jenis == 'Surat Masuk') {
            $arsip = ArsipSuratMasuk::with(['opd', 'bidang', 'kategori', 'ruangan', 'lemari', 'box'])->findOrFail($id);
        } elseif ($jenis == 'Surat Keluar') {
            $arsip = ArsipSuratKeluar::with(['opd', 'bidang', 'kategori', 'ruangan', 'lemari', 'box'])->findOrFail($id);
        } elseif ($jenis == 'Dokumen') {
            $arsip = ArsipDokumen::with(['opd', 'bidang', 'kategori', 'ruangan', 'lemari', 'box'])->findOrFail($id);
        } else {
            abort(404);
        }

        return view('superadmin.data_arsip.show', compact('arsip', 'jenis'));
    }
}

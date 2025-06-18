<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;
use App\Models\Opd;
use App\Models\Bidang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataArsipController extends Controller
{
    public function index()
    {
        $opds = Opd::all();
        $bidangs = Bidang::all();
        $kategoris = Kategori::all();

        return view('superadmin.data_arsip.index', compact('opds', 'bidangs', 'kategoris'));
    }

    public function getData(Request $request)
    {
        $filteredJenis = $request->jenis_arsip;

        $dataMasuk = collect();
        $dataKeluar = collect();

        if (!$filteredJenis || $filteredJenis === 'masuk') {
            $dataMasuk = ArsipSuratMasuk::with(['bidang', 'kategori', 'box.lemari.ruangan'])
                ->when($request->opd_id, fn($q) => $q->where('opd_id', $request->opd_id))
                ->when($request->bidang_id, fn($q) => $q->where('bidang_id', $request->bidang_id))
                ->when($request->kategori_id, fn($q) => $q->where('kategori_id', $request->kategori_id))
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'no_surat' => $item->no_surat_masuk,
                        'nama_surat' => $item->nama_surat_masuk,
                        'bidang' => optional($item->bidang)->nama_bidang ?? '-',
                        'kategori' => optional($item->kategori)->nama_kategori ?? '-',
                        'ruangan' => optional(optional(optional($item->box)->lemari)->ruangan)->nama_ruangan ?? '-',
                        'lemari' => optional(optional($item->box)->lemari)->nama_lemari ?? '-',
                        'box' => optional($item->box)->nama_box ?? '-',
                        'urutan' => $item->urutan_surat_masuk,
                        'tanggal' => $item->tanggal_surat_masuk,
                        'asal' => $item->asal_surat_masuk,
                        'jenis_arsip' => 'masuk',
                    ];
                });
        }

        if (!$filteredJenis || $filteredJenis === 'keluar') {
            $dataKeluar = ArsipSuratKeluar::with(['bidang', 'kategori', 'box.lemari.ruangan'])
                ->when($request->opd_id, fn($q) => $q->where('opd_id', $request->opd_id))
                ->when($request->bidang_id, fn($q) => $q->where('bidang_id', $request->bidang_id))
                ->when($request->kategori_id, fn($q) => $q->where('kategori_id', $request->kategori_id))
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'no_surat' => $item->no_surat_keluar,
                        'nama_surat' => $item->nama_surat_keluar,
                        'bidang' => optional($item->bidang)->nama_bidang ?? '-',
                        'kategori' => optional($item->kategori)->nama_kategori ?? '-',
                        'ruangan' => optional(optional(optional($item->box)->lemari)->ruangan)->nama_ruangan ?? '-',
                        'lemari' => optional(optional($item->box)->lemari)->nama_lemari ?? '-',
                        'box' => optional($item->box)->nama_box ?? '-',
                        'urutan' => $item->urutan_surat_keluar,
                        'tanggal' => $item->tanggal_surat_keluar,
                        'asal' => $item->asal_surat_keluar,
                        'jenis_arsip' => 'keluar',
                    ];
                });
        }

        $merged = $dataMasuk->concat($dataKeluar);

        return DataTables::of($merged)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<a href="#" class="btn btn-info btn-sm">Detail</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}

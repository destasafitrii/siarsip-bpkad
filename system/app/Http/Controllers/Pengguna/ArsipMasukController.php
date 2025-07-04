<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\Bidang;
use App\Models\Kategori;
use App\Models\Opd;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ArsipMasukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();

            $data = ArsipSuratMasuk::with(['bidang', 'kategori', 'box.lemari.ruangan', 'opd'])
                ->where('opd_id', $user->opd_id) // Filter sesuai OPD pengguna
                ->select('arsip_surat_masuk.*');

            if ($request->filled('bidang_id')) {
                $data->where('bidang_id', $request->bidang_id);
            }

            if ($request->filled('kategori_id')) {
                $data->where('kategori_id', $request->kategori_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
    return '<a href="' . route('pengguna.arsip_masuk.show', $row->surat_masuk_id) . '" class="btn btn-info btn-sm" title="Detail">
                <i class="mdi mdi-eye-outline" style="font-size: 14px;"></i>
            </a>';
})

                ->editColumn('bidang_id', fn($row) => $row->bidang->nama_bidang ?? 'Tidak ada bidang')
                ->editColumn('kategori_id', fn($row) => $row->kategori->nama_kategori ?? 'Tidak ada kategori')
                ->editColumn('box_id', fn($row) => $row->box->nama_box ?? 'Tidak ada box')
                ->editColumn('tanggal_surat_masuk', fn($row) => date('d-m-Y', strtotime($row->tanggal_surat_masuk)))
                ->rawColumns(['action'])
                ->make(true);
        }

        $user = Auth::user();
        $bidangs = Bidang::where('opd_id', $user->opd_id)->orderBy('nama_bidang')->get();
        $kategoris = Kategori::whereIn('bidang_id', $bidangs->pluck('bidang_id'))->orderBy('nama_kategori')->get();

        return view('pengguna.arsip_masuk.index', compact('bidangs', 'kategoris'));
    }

    public function show($id)
    {
        $user = Auth::user();

        $arsip_surat_masuk = ArsipSuratMasuk::with(['bidang', 'kategori', 'box.lemari.ruangan', 'opd'])
            ->where('opd_id', $user->opd_id)
            ->findOrFail($id);

        return view('pengguna.arsip_masuk.show', compact('arsip_surat_masuk'));
    }

    public function getBidangByOpd($opd_id)
    {
        $bidangs = Bidang::where('opd_id', $opd_id)
            ->orderBy('nama_bidang')
            ->get(['bidang_id', 'nama_bidang']);
        return response()->json($bidangs);
    }

    public function getKategoriByBidang($bidang_id)
    {
        $kategoris = Kategori::where('bidang_id', $bidang_id)
            ->orderBy('nama_kategori')
            ->get(['kategori_id', 'nama_kategori']);
        return response()->json($kategoris);
    }


}

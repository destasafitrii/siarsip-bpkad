<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\Bidang;
use App\Models\Box;
use App\Models\Lemari;
use App\Models\Kategori;
use App\Models\Opd;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class DataArsipMasukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ArsipSuratMasuk::with(['bidang', 'kategori', 'box.lemari.ruangan', 'opd'])
                ->select('arsip_surat_masuk.*');

            // Filter berdasarkan OPD
            if ($request->has('opd_id') && $request->opd_id != '') {
                $data->where('opd_id', $request->opd_id);
            }

            // Filter berdasarkan Bidang
            if ($request->has('bidang_id') && $request->bidang_id != '') {
                $data->where('bidang_id', $request->bidang_id);
            }

            // Filter berdasarkan Kategori
            if ($request->has('kategori_id') && $request->kategori_id != '') {
                $data->where('kategori_id', $request->kategori_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('opd', function ($row) {
                    return $row->opd ? $row->opd->nama_opd : '-';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('superadmin.arsip_masuk.show', $row->surat_masuk_id) . '" class="btn btn-info btn-sm" title="Detail">
                                <i class="mdi mdi-eye-outline" style="font-size: 10px"></i>
                            </a>';
                    return $btn;
                })
                ->editColumn('bidang_id', function ($row) {
                    return $row->bidang ? $row->bidang->nama_bidang : 'Tidak ada bidang';
                })
                ->editColumn('kategori_id', function ($row) {
                    return $row->kategori ? $row->kategori->nama_kategori : 'Tidak ada kategori';
                })
                ->editColumn('box_id', function ($row) {
                    return $row->box ? $row->box->nama_box : 'Tidak ada box';
                })
                ->editColumn('tanggal_surat_masuk', function ($row) {
                    return date('d-m-Y', strtotime($row->tanggal_surat_masuk));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Load all OPDs for the filter dropdown
        $opds = Opd::orderBy('nama_opd')->get();

        return view('superadmin.arsip_masuk.index', compact('opds'));
    }

    public function show($id)
    {
        // Menampilkan detail arsip surat masuk
        $arsip_surat_masuk = ArsipSuratMasuk::with(['bidang', 'kategori', 'box.lemari.ruangan', 'opd'])->findOrFail($id);
        return view('superadmin.arsip_masuk.show', compact('arsip_surat_masuk'));
    }

    // API endpoints for cascading dropdowns
    public function getBidangByOpd($opd_id)
    {
        // Debug: tambahkan log
        Log::info('getBidangByOpd called with ID: ' . $opd_id);

        $bidang = Bidang::where('opd_id', $opd_id)
            ->orderBy('nama_bidang')
            ->get(['bidang_id', 'nama_bidang']);

        // Debug: log hasil
        Log::info('Bidang found: ' . $bidang->count());

        return response()->json($bidang);
    }

    public function getKategoriByBidang($bidang_id)
    {
        $list_kategori = Kategori::where('bidang_id', $bidang_id)
            ->orderBy('nama_kategori')
            ->get(['kategori_id', 'nama_kategori']);
        return response()->json($list_kategori);
    }

    public function getKategoriByOpd($opd_id)
    {
        $bidang_ids = Bidang::where('opd_id', $opd_id)->pluck('bidang_id');
        $kategoris = Kategori::whereIn('bidang_id', $bidang_ids)
            ->orderBy('nama_kategori')
            ->get(['kategori_id', 'nama_kategori']);

        return response()->json($kategoris);
    }
}
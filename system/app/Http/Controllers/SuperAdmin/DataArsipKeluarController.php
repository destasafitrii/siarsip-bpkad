<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArsipSuratKeluar;
use App\Models\Bidang;
use App\Models\Box;
use App\Models\Lemari;
use App\Models\Kategori;
use App\Models\Opd;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class DataArsipKeluarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ArsipSuratKeluar::with(['bidang', 'kategori', 'box.lemari.ruangan', 'opd'])
                ->select('arsip_surat_keluar.*');

            if ($request->has('opd_id') && $request->opd_id != '') {
                $data->where('opd_id', $request->opd_id);
            }

            if ($request->has('bidang_id') && $request->bidang_id != '') {
                $data->where('bidang_id', $request->bidang_id);
            }

            if ($request->has('kategori_id') && $request->kategori_id != '') {
                $data->where('kategori_id', $request->kategori_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('opd', function ($row) {
                    return $row->opd ? $row->opd->nama_opd : '-';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('superadmin.arsip_keluar.show', $row->surat_keluar_id) . '" class="btn btn-info btn-sm" title="Detail">
                                <i class="fas fa-eye" style="font-size: 10px"></i>
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
                ->editColumn('tanggal_surat_keluar', function ($row) {
                    return date('d-m-Y', strtotime($row->tanggal_surat_keluar));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $opds = Opd::orderBy('nama_opd')->get();
        return view('superadmin.arsip_keluar.index', compact('opds'));
    }

    public function show($id)
    {
        $arsip_surat_keluar = ArsipSuratKeluar::with(['bidang', 'kategori', 'box.lemari.ruangan', 'opd'])->findOrFail($id);
        return view('superadmin.arsip_keluar.show', compact('arsip_surat_keluar'));
    }

    public function getBidangByOpd($opd_id)
    {
        Log::info('getBidangByOpd called with ID: ' . $opd_id);

        $bidang = Bidang::where('opd_id', $opd_id)
            ->orderBy('nama_bidang')
            ->get(['bidang_id', 'nama_bidang']);

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

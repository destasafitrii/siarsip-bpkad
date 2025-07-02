<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArsipDokumen;
use App\Models\Opd;
use App\Models\Bidang;
use App\Models\Kategori;
use Yajra\DataTables\Facades\DataTables;

class DataArsipDokumenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ArsipDokumen::with(['opd', 'bidang', 'kategori', 'box.lemari.ruangan']);

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
                    return $row->opd->nama_opd ?? '-';
                })
                ->editColumn('bidang_id', function ($row) {
                    return $row->bidang->nama_bidang ?? 'Tidak ada bidang';
                })
                ->editColumn('kategori_id', function ($row) {
                    return $row->kategori->nama_kategori ?? 'Tidak ada kategori';
                })
                ->editColumn('box_id', function ($row) {
                    return $row->box->nama_box ?? 'Tidak ada box';
                })
                ->editColumn('tanggal_dokumen', function ($row) {
                    return date('d-m-Y', strtotime($row->tanggal_dokumen));
                })
                ->addColumn('action', function ($row) {
                    $url = route('superadmin.arsip_dokumen.show', $row->dokumen_id);
                    return '<a href="' . $url . '" class="btn btn-info btn-sm" title="Detail">
                                <i class="fas fa-eye" style="font-size: 10px"></i>
                            </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $opds = Opd::orderBy('nama_opd')->get();
        return view('superadmin.arsip_dokumen.index', compact('opds'));
    }

    public function show($id)
    {
        $arsip_dokumen = ArsipDokumen::with([
            'opd', 'bidang', 'kategori',
            'box.lemari.ruangan'
        ])->findOrFail($id);

        return view('superadmin.arsip_dokumen.show', compact('arsip_dokumen'));
    }

    public function getBidangByOpd($opd_id)
    {
        $bidang = Bidang::where('opd_id', $opd_id)->get();
        return response()->json($bidang);
    }

    public function getKategoriByBidang($bidang_id)
    {
        $kategori = Kategori::where('bidang_id', $bidang_id)->get();
        return response()->json($kategori);
    }

    public function getKategoriByOpd($opd_id)
    {
        $kategori = Kategori::where('opd_id', $opd_id)->get();
        return response()->json($kategori);
    }
}

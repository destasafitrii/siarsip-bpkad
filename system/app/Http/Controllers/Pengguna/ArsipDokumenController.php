<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArsipDokumen;
use App\Models\Bidang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ArsipDokumenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();

            $data = ArsipDokumen::with(['bidang', 'kategori', 'box.lemari.ruangan', 'opd'])
                ->where('opd_id', $user->opd_id)
                ->select('arsip_dokumen.*');

            if ($request->filled('bidang_id')) {
                $data->where('bidang_id', $request->bidang_id);
            }

            if ($request->filled('kategori_id')) {
                $data->where('kategori_id', $request->kategori_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('pengguna.arsip_dokumen.show', $row->dokumen_id) . '" class="btn btn-info btn-sm" title="Detail">
                                <i class="mdi mdi-eye-outline" style="font-size: 10px"></i>
                            </a>';
                })
                ->editColumn('bidang_id', fn($row) => $row->bidang->nama_bidang ?? 'Tidak ada bidang')
                ->editColumn('kategori_id', fn($row) => $row->kategori->nama_kategori ?? 'Tidak ada kategori')
                ->editColumn('tanggal_dokumen', fn($row) => date('d-m-Y', strtotime($row->tanggal_dokumen)))
                ->rawColumns(['action'])
                ->make(true);
        }

        $user = Auth::user();
        $bidangs = Bidang::where('opd_id', $user->opd_id)->orderBy('nama_bidang')->get();
        $kategoris = Kategori::whereIn('bidang_id', $bidangs->pluck('bidang_id'))->orderBy('nama_kategori')->get();

        return view('pengguna.arsip_dokumen.index', compact('bidangs', 'kategoris'));
    }

    public function show($id)
    {
        $user = Auth::user();

        $arsip_dokumen = ArsipDokumen::with(['bidang', 'kategori', 'box.lemari.ruangan', 'opd'])
            ->where('opd_id', $user->opd_id)
            ->findOrFail($id);

        return view('pengguna.arsip_dokumen.show', compact('arsip_dokumen'));
    }

    public function getKategoriByBidang($bidang_id)
    {
        $kategoris = Kategori::where('bidang_id', $bidang_id)
            ->orderBy('nama_kategori')
            ->get(['kategori_id', 'nama_kategori']);
        return response()->json($kategoris);
    }
}

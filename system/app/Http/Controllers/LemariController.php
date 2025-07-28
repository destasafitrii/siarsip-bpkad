<?php

namespace App\Http\Controllers;

use App\Models\Lemari;
use App\Models\Ruangan;
use App\Models\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;


class LemariController extends Controller
{
    public function index()
{
    $opdId = Auth::user()->opd_id;

    // Ambil ruangan milik OPD
    $ruangan = Ruangan::where('opd_id', $opdId)->get();

    // Ambil lemari yang ruangan-nya milik OPD user yang login
    $lemari = Lemari::with('ruangan')
        ->whereHas('ruangan', function ($query) use ($opdId) {
            $query->where('opd_id', $opdId);
        })
        ->get();

    return view('backend.manajemen_lokasi.lemari', compact('lemari', 'ruangan'));
}

public function data()
{
    $opdId = Auth::user()->opd_id;

    $data = Lemari::with('ruangan')
        ->whereHas('ruangan', function ($query) use ($opdId) {
            $query->where('opd_id', $opdId);
        })
        ->latest()
        ->get();

    return DataTables::of($data)
        ->addIndexColumn()
         ->addColumn('nomor_lemari', function ($row) {
        return $row->nomor_lemari;
    })
        ->addColumn('ruangan', function ($row) {
            return $row->ruangan ? $row->ruangan->nama_ruangan : '-';
        })
        ->addColumn('aksi', function ($row) {
            return '
                <button class="btn btn-warning btn-sm btn-edit" data-id="' . $row->lemari_id . '">
                    <i class="mdi mdi-pencil"></i>
                </button>
                <button class="btn btn-danger btn-sm btn-hapus" data-id="' . $row->lemari_id . '" data-namalemari="' . $row->nama_lemari . '">
                    <i class="mdi mdi-trash-can-outline"></i>
                </button>
            ';
        })
        ->rawColumns(['aksi'])
        ->make(true);
}


    public function store(Request $request)
    {
        $request->validate([
            'nomor_lemari' => 'required|unique:lemari,nomor_lemari',
            'nama_lemari' => 'required',
            'jumlah_rak' => 'required|integer|min:1',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
        ]);

        Lemari::create([
            'nomor_lemari' => $request->nomor_lemari,
            'nama_lemari' => $request->nama_lemari,
            'jumlah_rak' => $request->jumlah_rak,
            'ruangan_id' => $request->ruangan_id,

        ]);

        return redirect('/pengelola/lemari')->with('success', 'Data Lemari berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_lemari' => 'required|unique:lemari,nomor_lemari,' . $id . ',lemari_id',
            'nama_lemari' => 'required',
            'jumlah_rak' => 'required|integer|min:1',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
        ]);

        $lemari = Lemari::findOrFail($id);
        $lemari->update([
            'nomor_lemari' => $request->nomor_lemari,
            'nama_lemari' => $request->nama_lemari,
            'jumlah_rak' => $request->jumlah_rak,
            'ruangan_id' => $request->ruangan_id,
        ]);

        return redirect('/pengelola/lemari')->with('success', 'Data Lemari berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lemari = Lemari::findOrFail($id);
        $lemari->delete();

        return redirect('/pengelola/lemari')->with('success', 'Data Lemari berhasil dihapus.');
    }
    public function edit($id)
{
    $lemari = Lemari::findOrFail($id);
    return response()->json($lemari);
}


    public function getByRuangan($id)
    {
        $lemari = Lemari::where('ruangan_id', $id)->get();
        return response()->json($lemari);
    }

    public function getBoxByLemari($lemari_id)
    {
        $box = Box::where('lemari_id', $lemari_id)->get();
        return response()->json($box);
    }
}

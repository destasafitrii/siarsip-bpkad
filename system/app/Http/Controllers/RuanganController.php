<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;


class RuanganController extends Controller
{
    public function index()
    {
        return view('backend.manajemen_lokasi.ruangan');
    }

    public function data(Request $request)
{
    $data = Ruangan::where('opd_id', Auth::user()->opd_id)->get();

    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function ($row) {
            return '
                <button class="btn btn-info btn-sm btn-detail" data-id="' . $row->ruangan_id . '">
                    <i class="mdi mdi-eye-outline"></i>
                </button>
                <button class="btn btn-warning btn-sm btn-edit" data-id="' . $row->ruangan_id . '">
                    <i class="mdi mdi-pencil"></i>
                </button>
                <button class="btn btn-danger btn-sm btn-hapus" data-id="' . $row->ruangan_id . '" data-namaruangan="' . $row->nama_ruangan . '">
                    <i class="mdi mdi-trash-can-outline"></i>
                </button>
            ';
        })
        ->editColumn('alamat', fn($r) => $r->alamat ?? '-')
        ->editColumn('keterangan', fn($r) => \Str::limit($r->keterangan, 30, '...'))
        ->rawColumns(['aksi'])
        ->make(true);
}


   public function store(Request $request)
{
    $request->validate([
        'kode_ruangan' => 'required|string|max:255',
        'nama_ruangan' => 'required|string|max:255',
        'alamat' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:255',
    ]);

    // Cek apakah sudah ada ruangan dengan kode yang sama di OPD ini
    $exists = Ruangan::where('kode_ruangan', $request->kode_ruangan)
        ->where('opd_id', Auth::user()->opd_id)
        ->exists();

    if ($exists) {
        return back()->with('error', 'Kode ruangan sudah digunakan dalam OPD Anda.');
    }

    // Simpan jika belum ada
    Ruangan::create([
        'kode_ruangan' => $request->kode_ruangan,
        'nama_ruangan' => $request->nama_ruangan,
        'alamat' => $request->alamat,
        'keterangan' => $request->keterangan,
        'opd_id' => Auth::user()->opd_id,
    ]);

    return back()->with('success', 'Ruangan berhasil ditambahkan.');
}


   public function update(Request $request, $id)
{
    $request->validate([
        'kode_ruangan' => 'required|string|max:255',
        'nama_ruangan' => 'required|string|max:255',
        'alamat' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:255',
    ]);

    // Cek jika kode ruangan bentrok dengan ruangan lain di OPD yang sama
    $exists = Ruangan::where('kode_ruangan', $request->kode_ruangan)
        ->where('opd_id', Auth::user()->opd_id)
        ->where('ruangan_id', '!=', $id)
        ->exists();

    if ($exists) {
        return back()->with('error', 'Kode ruangan sudah digunakan di OPD Anda.');
    }

    $ruangan = Ruangan::findOrFail($id);
    $ruangan->update([
        'kode_ruangan' => $request->kode_ruangan,
        'nama_ruangan' => $request->nama_ruangan,
        'alamat' => $request->alamat,
        'keterangan' => $request->keterangan,
    ]);

    return back()->with('success', 'Ruangan berhasil diperbarui.');
}


    public function destroy($id)
    {
        Ruangan::findOrFail($id)->delete();
        return back()->with('success', 'Ruangan berhasil dihapus.');
    }
    public function edit($id)
{
    $ruangan = Ruangan::findOrFail($id);
    return response()->json($ruangan);
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidang;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BidangController extends Controller
{
    public function index()
    {
        return view('backend.bidang.index');
    }

    public function data()
    {
        $data = Bidang::where('opd_id', Auth::user()->opd_id)->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editBtn = '<button class="btn btn-warning btn-sm btn-edit me-1"
                    data-id="' . $row->bidang_id . '">
                    <i class="mdi mdi-pencil"></i></button>';
                $deleteBtn = '<button class="btn btn-danger btn-sm btn-delete"
                    data-id="' . $row->bidang_id . '"
                    data-nama="' . $row->nama_bidang . '">
                    <i class="mdi mdi-trash-can-outline"></i></button>';
                return $editBtn . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // ✅ Tambahan: tampilkan form tambah dengan kode otomatis
    public function create()
    {
        $lastKode = Bidang::where('opd_id', Auth::user()->opd_id)
                    ->orderBy('id', 'desc')
                    ->value('kode_bidang');

        if ($lastKode) {
            $lastNumber = intval(substr($lastKode, 3));
            $nextKode = 'BD-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextKode = 'BD-001';
        }

        return view('backend.bidang.create', compact('nextKode'));
    }

    public function store(Request $request)
{
    $request->validate([
        'kode_bidang' => 'required|string|unique:bidang,kode_bidang',
        'nama_bidang' => 'required|string|max:100',
        'penanggung_jawab' => 'required|string|max:100',
    ]);

    Bidang::create([
        'opd_id' => Auth::user()->opd_id,
        'kode_bidang' => $request->kode_bidang, // gunakan yang dikirim dari form
        'nama_bidang' => $request->nama_bidang,
        'penanggung_jawab' => $request->penanggung_jawab,
    ]);

    return redirect()->route('bidang.index')->with('success', 'Data Bidang berhasil ditambahkan!');
}


    public function edit($id)
    {
        $bidang = Bidang::findOrFail($id);
        return response()->json($bidang);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bidang' => 'required|string|max:100',
            'penanggung_jawab' => 'required|string|max:100',
        ]);

        $bidang = Bidang::findOrFail($id);
        $bidang->update([
            // kode_bidang tidak diubah!
            'nama_bidang' => $request->nama_bidang,
            'penanggung_jawab' => $request->penanggung_jawab,
        ]);

        return redirect()->route('bidang.index')->with('success', 'Data Bidang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $bidang = Bidang::findOrFail($id);
        $bidang->delete();

        return redirect()->route('bidang.index')->with('success', 'Data Bidang berhasil dihapus!');
    }

   public function generateKode()
{
    $lastKode = Bidang::where('opd_id', Auth::user()->opd_id)
        ->pluck('kode_bidang')
        ->map(function ($kode) {
            return (int) substr($kode, 3); // ambil angka setelah BD-
        })->max();

    $nextKode = 'BD-' . str_pad(($lastKode + 1), 3, '0', STR_PAD_LEFT);

    return response()->json(['kode' => $nextKode]);
}


}

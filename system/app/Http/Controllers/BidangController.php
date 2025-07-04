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

    public function store(Request $request)
    {
        $request->validate([
            'kode_bidang' => 'required|string|max:50',
            'nama_bidang' => 'required|string|max:100',
            'penanggung_jawab' => 'required|string|max:100',
        ]);

        Bidang::create([
            'opd_id' => Auth::user()->opd_id,
            'kode_bidang' => $request->kode_bidang,
            'nama_bidang' => $request->nama_bidang,
            'penanggung_jawab' => $request->penanggung_jawab,
            
        ]);

        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $bidang = Bidang::findOrFail($id);
        return response()->json($bidang);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_bidang' => 'required|string|max:50',
            'nama_bidang' => 'required|string|max:100',
            'penanggung_jawab' => 'required|string|max:100',
        ]);

        $bidang = Bidang::findOrFail($id);
        $bidang->update([
            'kode_bidang' => $request->kode_bidang,
            'nama_bidang' => $request->nama_bidang,
            'penanggung_jawab' => $request->penanggung_jawab,
        ]);

        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $bidang = Bidang::findOrFail($id);
        $bidang->delete();

        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil dihapus!');
    }
}

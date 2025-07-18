<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Bidang;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bidang_opd = Bidang::where('opd_id', Auth::user()->opd_id)->pluck('bidang_id');

            $data = Kategori::with('bidang')
                        ->whereIn('bidang_id', $bidang_opd)
                        ->select('kategori.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('bidang', function ($row) {
                    return $row->bidang->nama_bidang ?? '-';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-warning btn-sm btn-edit" data-id="' . $row->kategori_id . '">
                            <i class="mdi mdi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $row->kategori_id . '" data-nama="' . $row->nama_kategori . '">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $bidang = Bidang::where('opd_id', Auth::user()->opd_id)->get();
        return view('backend.kategori.index', compact('bidang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'bidang_id' => 'required|exists:bidang,bidang_id',
        ]);

        $bidang = Bidang::where('bidang_id', $request->bidang_id)
                        ->where('opd_id', Auth::user()->opd_id)
                        ->first();

        if (!$bidang) {
            return redirect()->route('kategori.index')->with('error', 'Anda tidak berhak menambahkan kategori ke bidang ini.');
        }

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'bidang_id' => $request->bidang_id,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Data Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'bidang_id' => 'required|exists:bidang,bidang_id',
        ]);

        $kategori = Kategori::findOrFail($id);

        $bidang = Bidang::where('bidang_id', $request->bidang_id)
                        ->where('opd_id', Auth::user()->opd_id)
                        ->first();

        if (!$bidang) {
            return redirect()->route('kategori.index')->with('error', 'Anda tidak berhak mengubah kategori ini.');
        }

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'bidang_id' => $request->bidang_id,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Data Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->bidang->opd_id !== Auth::user()->opd_id) {
            return redirect()->route('kategori.index')->with('error', 'Anda tidak berhak menghapus kategori ini.');
        }

        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Data Kategori berhasil dihapus.');
    }

    public function edit(Kategori $kategori)
    {
        if ($kategori->bidang->opd_id !== Auth::user()->opd_id) {
            return response()->json(['error' => 'Tidak berhak mengakses data ini'], 403);
        }

        return response()->json($kategori);
    }
    public function data()
{
    $bidang_opd = Bidang::where('opd_id', Auth::user()->opd_id)->pluck('bidang_id');

    $data = Kategori::with('bidang')
                ->whereIn('bidang_id', $bidang_opd)
                ->select('kategori.*');

    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('bidang', function ($row) {
            return $row->bidang->nama_bidang ?? '-';
        })
        ->addColumn('action', function ($row) {
            return '
                <button class="btn btn-warning btn-sm btn-edit" data-id="' . $row->kategori_id . '">
                    <i class="mdi mdi-pencil"></i>
                </button>
                <button class="btn btn-danger btn-sm btn-delete" data-id="' . $row->kategori_id . '" data-nama="' . $row->nama_kategori . '">
                    <i class="mdi mdi-trash-can-outline"></i>
                </button>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
}

}

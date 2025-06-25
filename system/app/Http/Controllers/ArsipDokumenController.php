<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipDokumen;
use App\Models\Bidang;
use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\Lemari;
use App\Models\Box;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class ArsipDokumenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ArsipDokumen::with(['bidang', 'kategori', 'box.lemari.ruangan'])->select('arsip_dokumen.*');

            if ($request->has('bidang_id') && $request->bidang_id != '') {
                $data->where('bidang_id', $request->bidang_id);
            }

            if ($request->has('kategori_id') && $request->kategori_id != '') {
                $data->where('kategori_id', $request->kategori_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('arsip_dokumen.show', $row->dokumen_id) . '" class="btn btn-info btn-sm" title="Detail">
                                <i class="fas fa-eye" style="font-size: 10px"></i>
                            </a>
                            <a href="' . route('arsip_dokumen.edit', $row->dokumen_id) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit" style="font-size: 10px"></i>
                            </a>
                            <form action="' . route('arsip_dokumen.destroy', $row->dokumen_id) . '" method="POST" style="display:inline-block;">
                                ' . csrf_field() . method_field('DELETE') . '
                                                            <button type="button" class="btn btn-danger btn-sm btn-delete" 
        data-id="' . $row->dokumen_id . '" 
        data-nama="' . $row->nama_dokumen . '" 
        data-bs-toggle="modal" data-bs-target="#deleteModal">
        <i class="fas fa-trash-alt" style="font-size: 13px"></i>
    </button>
                            </form>';
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
                ->rawColumns(['action'])
                ->make(true);
        }

        $list_bidang = Bidang::all();
        return view('backend.arsip_dokumen.index', compact('list_bidang'));
    }

    public function getKategoriByBidang($bidang_id)
    {
        $list_kategori = Kategori::where('bidang_id', $bidang_id)->get(['kategori_id', 'nama_kategori']);
        return response()->json($list_kategori);
    }

    public function getLemariByRuangan($ruangan_id)
    {
        $lemari = Lemari::where('ruangan_id', $ruangan_id)->get(['lemari_id', 'nama_lemari']);
        return response()->json($lemari);
    }

    public function getBoxByLemari($lemari_id)
    {
        $box = Box::where('lemari_id', $lemari_id)->get(['box_id', 'nama_box']);
        return response()->json($box);
    }


    public function create()
    {
        $list_bidang = Bidang::all();
        $list_kategori = Kategori::all();
        $list_ruangan = Ruangan::all();
        $list_lemari = Lemari::all();
        $list_box = Box::all();

        return view('backend.arsip_dokumen.create', compact('list_bidang', 'list_kategori', 'list_ruangan', 'list_lemari', 'list_box',));
    }

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*******  9f7f5ad6-d864-4da1-a467-a9c6cdda50cb  *******/
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_dokumen' => 'required',
            'nama_dokumen' => 'required',
            'bidang_id' => 'required|exists:bidang,bidang_id',
            'kategori_id' => 'nullable|exists:kategori,kategori_id',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
            'lemari_id' => 'required|exists:lemari,lemari_id',
            'box_id' => 'required|exists:box,box_id',
            'tanggal_dokumen' => 'required|date',
            'file_dokumen' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240',
            'keterangan' => 'nullable',
        ]);
        
        $validatedData['opd_id'] = auth()->user()->opd_id;

        if ($request->hasFile('file_dokumen')) {
            $validatedData['file_dokumen'] = $request->file('file_dokumen')->store('uploads/dokumen', 'public');
        }

        ArsipDokumen::create($validatedData);
        return redirect()->route('arsip_dokumen.index')->with('success', 'Data dokumen berhasil ditambahkan!');
    }

    public function show($id)
    {
        $arsip_dokumen = ArsipDokumen::with(['bidang', 'kategori', 'box.lemari.ruangan', 'ruangan', 'lemari'])->findOrFail($id);
        return view('backend.arsip_dokumen.show', compact('arsip_dokumen'));
    }

    public function edit($id)
    {
        $arsip_dokumen = ArsipDokumen::with(['bidang', 'kategori', 'box.lemari.ruangan'])->findOrFail($id);

        $list_bidang = Bidang::all();

        // Memuat kategori berdasarkan bidang yang sedang dipilih
        $list_kategori = Kategori::where('bidang_id', $arsip_dokumen->bidang_id)->get();
        $list_ruangan = Ruangan::all();
        $list_lemari = Lemari::where('ruangan_id', $arsip_dokumen->box->lemari->ruangan_id)->get();
        $list_box = Box::where('lemari_id', $arsip_dokumen->box->lemari_id)->get();

        return view('backend.arsip_dokumen.edit', compact('arsip_dokumen', 'list_bidang', 'list_kategori', 'list_ruangan', 'list_lemari', 'list_box'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_dokumen' => 'required',
            'nama_dokumen' => 'required',
            'bidang_id' => 'required|exists:bidang,bidang_id',
            'kategori_id' => 'nullable|exists:kategori,kategori_id',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
            'lemari_id' => 'required|exists:lemari,lemari_id',
            'box_id' => 'required|exists:box,box_id',
            'tanggal_dokumen' => 'required|date',
            'file_dokumen' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240',
            'keterangan' => 'nullable',
        ]);

        $arsip_dokumen = ArsipDokumen::findOrFail($id);

        if ($request->hasFile('file_dokumen')) {
            $validatedData['file_dokumen'] = $request->file('file_dokumen')->store('uploads/dokumen', 'public');
        }

        $arsip_dokumen->update($validatedData);
        return redirect()->route('arsip_dokumen.index')->with('success', 'Data dokumen berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $arsip_dokumen = ArsipDokumen::findOrFail($id);
        $arsip_dokumen->delete();
        return redirect()->route('arsip_dokumen.index')->with('success', 'Data dokumen berhasil dihapus!');
    }
}

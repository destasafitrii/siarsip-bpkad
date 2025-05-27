<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratKeluar;
use App\Models\Bidang;
use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\Lemari;
use App\Models\Box;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class ArsipSuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ArsipSuratKeluar::with(['bidang', 'kategori', 'box.lemari.ruangan'])
                ->select('arsip_surat_keluar.*');

            // Filter berdasarkan bidang
            if ($request->has('bidang_id') && $request->bidang_id != '') {
                $data->where('bidang_id', $request->bidang_id);
            }

            // Filter berdasarkan kategori
            if ($request->has('kategori_id') && $request->kategori_id != '') {
                $data->where('kategori_id', $request->kategori_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('arsip_keluar.show', $row->surat_keluar_id).'" class="btn btn-info btn-sm" title="Detail">
                                <i class="fas fa-eye" style="font-size: 10px"></i>
                            </a>
                            <a href="'.route('arsip_keluar.edit', $row->surat_keluar_id).'" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit" style="font-size: 10px"></i>
                            </a>
                            <form action="'.route('arsip_keluar.destroy', $row->surat_keluar_id).'" method="POST" style="display:inline-block;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm(\'Apakah Anda yakin ingin menghapus arsip ini?\')">
                                    <i class="fas fa-trash-alt" style="font-size: 13px"></i>
                                </button>
                            </form>';
                    return $btn;
                })
                ->editColumn('bidang_id', function($row) {
                    return $row->bidang ? $row->bidang->nama_bidang : 'Tidak ada bidang';
                })
                ->editColumn('kategori_id', function($row) {
                    return $row->kategori ? $row->kategori->nama_kategori : 'Tidak ada kategori';
                })
                ->editColumn('box_id', function ($row) {
                    return $row->box ? $row->box->nama_box : 'Tidak ada box';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $list_bidang = Bidang::all();
        return view('backend.arsip_keluar.index', compact('list_bidang'));
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
        // Mendapatkan semua bidang dan kategori untuk form create
        $list_bidang = Bidang::all();
        $list_kategori = Kategori::all();
        $list_ruangan = Ruangan::all();
        $list_lemari = Lemari::all();
        $list_box = Box::all();
        return view('backend.arsip_keluar.create', compact('list_bidang', 'list_kategori', 'list_ruangan', 'list_lemari', 'list_box'));
    }

    public function store(Request $request)
    {
        // Validasi input untuk menyimpan arsip surat keluar
        $validatedData = $request->validate([
            'no_surat_keluar' => 'required',
            'nama_surat_keluar' => 'required',
            'bidang_id' => 'required|exists:bidang,bidang_id',
            'kategori_id' => 'nullable|exists:kategori,kategori_id',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
            'urutan_surat_keluar' => 'required',
            'lemari_id' => 'required|exists:lemari,lemari_id',
            'box_id' => 'required|exists:box,box_id',
            'tanggal_surat_keluar' => 'required|date',
            'tujuan_surat_keluar' => 'required',
            'file_surat_keluar' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240',
            'keterangan_surat_keluar' => 'nullable',
        ]);

        // Menyimpan file jika ada
        if ($request->hasFile('file_surat_keluar')) {
            $validatedData['file_surat_keluar'] = $request->file('file_surat_keluar')->store('uploads/surat_keluar', 'public');
        }

        // Membuat arsip surat keluar baru berdasarkan input yang sudah divalidasi
        ArsipSuratKeluar::create($validatedData);

        // Redirect ke halaman arsip surat keluar dengan pesan sukses
        return redirect()->route('arsip_keluar.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Menampilkan arsip surat keluar berdasarkan ID dan memuat relasi bidang dan kategori
        $arsip_surat_keluar = ArsipSuratKeluar::with(['bidang', 'kategori', 'box.lemari.ruangan', 'ruangan', 'lemari'])->findOrFail($id);
        return view('backend.arsip_keluar.show', compact('arsip_surat_keluar'));
    }

    // Controller untuk mengedit arsip surat keluar
    // Controller untuk mengedit arsip surat keluar
    public function edit($id)
    {
        $arsip_surat_keluar = ArsipSuratKeluar::with(['bidang', 'kategori', 'box.lemari.ruangan'])->findOrFail($id);

        // Mendapatkan semua bidang
        $list_bidang = Bidang::all();

        // Memuat kategori berdasarkan bidang yang sedang dipilih
        $list_kategori = Kategori::where('bidang_id', $arsip_surat_keluar->bidang_id)->get();
        $list_ruangan = Ruangan::all();
        $list_lemari = Lemari::where('ruangan_id', $arsip_surat_keluar->box->lemari->ruangan_id)->get();
        $list_box = Box::where('lemari_id', $arsip_surat_keluar->box->lemari_id)->get();

        return view('backend.arsip_keluar.edit', compact('arsip_surat_keluar', 'list_bidang', 'list_kategori', 'list_ruangan', 'list_lemari', 'list_box'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input untuk memperbarui arsip surat keluar
        $validatedData = $request->validate([
            'no_surat_keluar' => 'required',
            'nama_surat_keluar' => 'required',
            'tanggal_surat_keluar' => 'required|date',
            'bidang_id' => 'required|exists:bidang,bidang_id',
            'kategori_id' => 'nullable|exists:kategori,kategori_id',
            'tujuan_surat_keluar' => 'required',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
            'lemari_id' => 'required|exists:lemari,lemari_id',
            'box_id' => 'required|exists:box,box_id',
            'urutan_surat_keluar' => 'required',
            'file_surat_keluar' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240',
            'keterangan_surat_keluar' => 'nullable',
        ]);

        // Menemukan arsip surat keluar yang akan diperbarui dan memperbarui data
        $arsip_surat_keluar = ArsipSuratKeluar::findOrFail($id);
        $arsip_surat_keluar->update($validatedData);

        // Redirect ke halaman arsip surat keluar dengan pesan sukses
        return redirect()->route('arsip_keluar.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Menghapus arsip surat keluar berdasarkan ID
        $arsip_surat_keluar = ArsipSuratKeluar::findOrFail($id);
        $arsip_surat_keluar->delete();

        // Redirect ke halaman arsip surat keluar dengan pesan sukses
        return redirect()->route('arsip_keluar.index')->with('success', 'Data berhasil dihapus!');
    }

}
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
    ->where('opd_id', auth()->user()->opd_id)
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
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('arsip_keluar.show', $row->surat_keluar_id) . '" class="btn btn-info btn-sm" title="Detail">
                                <i class="mdi mdi-eye-outline" ></i>
                            </a>
                            <a href="' . route('arsip_keluar.edit', $row->surat_keluar_id) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="mdi mdi-pencil" ></i>
                            </a>
                            <form action="' . route('arsip_keluar.destroy', $row->surat_keluar_id) . '" method="POST" style="display:inline-block;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="button" class="btn btn-danger btn-sm btn-delete" 
        data-id="' . $row->surat_keluar_id . '" 
        data-nama="' . $row->nama_surat_keluar . '" 
        data-bs-toggle="modal" data-bs-target="#deleteModal">
        <i class="mdi mdi-trash-can-outline" ></i>
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

       $list_bidang = Bidang::where('opd_id', auth()->user()->opd_id)->get();
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
         $list_bidang = Bidang::where('opd_id', auth()->user()->opd_id)->get();
        $list_kategori = Kategori::all();
        $list_ruangan = Ruangan::where('opd_id', auth()->user()->opd_id)->get();

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
            'file_surat_keluar' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:5120',
            'keterangan_surat_keluar' => 'nullable',
        ],[
    'file_surat_keluar.mimes' => 'Format file harus PDF, JPG, atau PNG.',
    'file_surat_keluar.max' => 'Ukuran file tidak boleh melebihi 5 MB.',]);
        $validatedData['opd_id'] = auth()->user()->opd_id;
        // Menyimpan file jika ada
        if ($request->hasFile('file_surat_keluar')) {
            $validatedData['file_surat_keluar'] = $request->file('file_surat_keluar')->store('uploads/surat_keluar', 'public');
        }

        // Membuat arsip surat keluar baru berdasarkan input yang sudah divalidasi
        ArsipSuratKeluar::create($validatedData);

        // Redirect ke halaman arsip surat keluar dengan pesan sukses
        return redirect()->route('arsip_keluar.index')->with('success', 'Data Arsip Surat Keluar berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Menampilkan arsip surat keluar berdasarkan ID dan memuat relasi bidang dan kategori
        $arsip_surat_keluar = ArsipSuratKeluar::with(['bidang', 'kategori', 'box.lemari.ruangan', 'ruangan', 'lemari'])->findOrFail($id);
        return view('backend.arsip_keluar.show', compact('arsip_surat_keluar'));
    }

    
    public function edit($id)
    {
        $arsip_surat_keluar = ArsipSuratKeluar::with(['bidang', 'kategori', 'box.lemari.ruangan'])->findOrFail($id);

        
         $list_bidang = Bidang::where('opd_id', auth()->user()->opd_id)->get();
        $list_kategori = Kategori::where('bidang_id', $arsip_surat_keluar->bidang_id)->get();
       $list_ruangan = Ruangan::where('opd_id', auth()->user()->opd_id)->get();
        $list_lemari = Lemari::where('ruangan_id', $arsip_surat_keluar->box->lemari->ruangan_id)->get();
        $list_box = Box::where('lemari_id', $arsip_surat_keluar->box->lemari_id)->get();

        return view('backend.arsip_keluar.edit', compact('arsip_surat_keluar', 'list_bidang', 'list_kategori', 'list_ruangan', 'list_lemari', 'list_box'));
    }

public function update(Request $request, $id)
{
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
        'file_surat_keluar' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:10240',
        'keterangan_surat_keluar' => 'nullable',
    ]);

    $arsip_surat_keluar = ArsipSuratKeluar::findOrFail($id);

    // Jika ada file baru diupload
    if ($request->hasFile('file_surat_keluar')) {
        // Simpan file baru
        $validatedData['file_surat_keluar'] = $request->file('file_surat_keluar')->store('uploads/surat_keluar', 'public');

        // (Opsional) Hapus file lama jika diperlukan
        // Storage::disk('public')->delete($arsip_surat_keluar->file_surat_keluar);
    }

    $arsip_surat_keluar->update($validatedData);

    return redirect()->route('arsip_keluar.index')->with('success', 'Data Arsip Surat Keluar berhasil diperbarui!');
}


    public function destroy($id)
    {
        // Menghapus arsip surat keluar berdasarkan ID
        $arsip_surat_keluar = ArsipSuratKeluar::findOrFail($id);
        $arsip_surat_keluar->delete();

        // Redirect ke halaman arsip surat keluar dengan pesan sukses
        return redirect()->route('arsip_keluar.index')->with('success', 'Data Arsip Surat Keluar berhasil dihapus!');
    }
}

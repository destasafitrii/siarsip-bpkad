<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\Bidang;
use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\Lemari;
use App\Models\Box;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class ArsipSuratMasukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ArsipSuratMasuk::with(['bidang', 'kategori', 'box.lemari.ruangan'])
    ->where('opd_id', auth()->user()->opd_id)
    ->select('arsip_surat_masuk.*');

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
                    $btn = '<a href="' . route('arsip_masuk.show', $row->surat_masuk_id) . '" class="btn btn-info btn-sm" title="Detail">
                                <i class="mdi mdi-eye-outline" ></i>
                            </a>
                            <a href="' . route('arsip_masuk.edit', $row->surat_masuk_id) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="mdi mdi-pencil" ></i>
                            </a>
                            <form action="' . route('arsip_masuk.destroy', $row->surat_masuk_id) . '" method="POST" style="display:inline-block;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                 <button type="button" class="btn btn-danger btn-sm btn-delete" 
        data-id="' . $row->surat_masuk_id . '" 
        data-nama="' . $row->nama_surat_masuk . '" 
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
        return view('backend.arsip_masuk.index', compact('list_bidang'));
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

        return view('backend.arsip_masuk.create', compact('list_bidang', 'list_kategori', 'list_ruangan', 'list_lemari', 'list_box',));
    }

    public function store(Request $request)
    {
        // Validasi input untuk menyimpan arsip surat masuk
   $validatedData = $request->validate([
    'no_surat_masuk' => 'required|unique:arsip_surat_masuk,no_surat_masuk',
    'nama_surat_masuk' => 'required',
    'bidang_id' => 'required|exists:bidang,bidang_id',
    'kategori_id' => 'nullable|exists:kategori,kategori_id',
    'ruangan_id' => 'required|exists:ruangan,ruangan_id',
    'urutan_surat_masuk' => 'required|integer|min:1',
    'lemari_id' => 'required|exists:lemari,lemari_id',
    'box_id' => 'required|exists:box,box_id',
    'tanggal_surat_masuk' => 'required|date',
    'asal_surat_masuk' => 'required',
    'file_surat_masuk' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:5120',
    'keterangan' => 'nullable',
], [
    'no_surat_masuk.required' => 'Nomor surat wajib diisi.',
    'no_surat_masuk.unique' => 'Nomor surat sudah digunakan.',
    'nama_surat_masuk.required' => 'Nama surat wajib diisi.',
    'bidang_id.required' => 'Bidang wajib dipilih.',
    'bidang_id.exists' => 'Bidang tidak ditemukan.',
    'kategori_id.exists' => 'Kategori tidak ditemukan.',
    'ruangan_id.required' => 'Ruangan wajib dipilih.',
    'ruangan_id.exists' => 'Ruangan tidak ditemukan.',
    'lemari_id.required' => 'Lemari wajib dipilih.',
    'lemari_id.exists' => 'Lemari tidak ditemukan.',
    'box_id.required' => 'Box wajib dipilih.',
    'box_id.exists' => 'Box tidak ditemukan.',
    'urutan_surat_masuk.required' => 'Urutan dokumen wajib diisi.',
    'urutan_surat_masuk.integer' => 'Urutan harus berupa angka.',
    'urutan_surat_masuk.min' => 'Urutan minimal 1.',
    'tanggal_surat_masuk.required' => 'Tanggal surat wajib diisi.',
    'tanggal_surat_masuk.date' => 'Format tanggal tidak valid.',
    'asal_surat_masuk.required' => 'Asal surat wajib diisi.',
    'file_surat_masuk.mimes' => 'Format file harus PDF, JPG, PNG, DOC, atau DOCX.',
    'file_surat_masuk.max' => 'Ukuran file tidak boleh lebih dari 5 MB.',
]);

  $validatedData['opd_id'] = auth()->user()->opd_id;
        // Menyimpan file jika ada
        if ($request->hasFile('file_surat_masuk')) {
            $validatedData['file_surat_masuk'] = $request->file('file_surat_masuk')->store('uploads/surat_masuk', 'public');
        }

        // Membuat arsip surat masuk baru berdasarkan input yang sudah divalidasi
        ArsipSuratMasuk::create($validatedData);

        // Redirect ke halaman arsip surat masuk dengan pesan sukses
        return redirect()->route('arsip_masuk.index')->with('success', 'Data Arsip Surat Masuk berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Menampilkan arsip surat masuk berdasarkan ID dan memuat relasi bidang dan kategori
        $arsip_surat_masuk = ArsipSuratMasuk::with(['bidang', 'kategori', 'box.lemari.ruangan', 'ruangan', 'lemari',])->findOrFail($id);
        return view('backend.arsip_masuk.show', compact('arsip_surat_masuk'));
    }

    // Controller untuk mengedit arsip surat masuk
    // Controller untuk mengedit arsip surat masuk
    public function edit($id)
    {
        $arsip_surat_masuk = ArsipSuratMasuk::with(['bidang', 'kategori', 'box.lemari.ruangan'])->findOrFail($id);

        // Mendapatkan semua bidang
        $list_bidang = Bidang::where('opd_id', auth()->user()->opd_id)->get();

        // Memuat kategori berdasarkan bidang yang sedang dipilih
        $list_kategori = Kategori::where('bidang_id', $arsip_surat_masuk->bidang_id)->get();
       $list_ruangan = Ruangan::where('opd_id', auth()->user()->opd_id)->get();

        $list_lemari = Lemari::where('ruangan_id', $arsip_surat_masuk->box->lemari->ruangan_id)->get();
        $list_box = Box::where('lemari_id', $arsip_surat_masuk->box->lemari_id)->get();
        
        return view('backend.arsip_masuk.edit', compact('arsip_surat_masuk', 'list_bidang', 'list_kategori', 'list_ruangan', 'list_lemari', 'list_box'));
    }

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'no_surat_masuk' => 'required|unique:arsip_surat_masuk,no_surat_masuk,' . $id . ',surat_masuk_id',
        'nama_surat_masuk' => 'required',
        'bidang_id' => 'required|exists:bidang,bidang_id',
        'kategori_id' => 'nullable|exists:kategori,kategori_id',
        'ruangan_id' => 'required|exists:ruangan,ruangan_id',
        'lemari_id' => 'required|exists:lemari,lemari_id',
        'box_id' => 'required|exists:box,box_id',
        'urutan_surat_masuk' => 'required|integer|min:1',
        'tanggal_surat_masuk' => 'required|date',
        'asal_surat_masuk' => 'required',
        'file_surat_masuk' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:5120',
        'keterangan' => 'nullable',
    ], [
    'no_surat_masuk.required' => 'Nomor surat wajib diisi.',
    'no_surat_masuk.unique' => 'Nomor surat sudah digunakan.',
    'nama_surat_masuk.required' => 'Nama surat wajib diisi.',
    'bidang_id.required' => 'Bidang wajib dipilih.',
    'bidang_id.exists' => 'Bidang tidak ditemukan.',
    'kategori_id.exists' => 'Kategori tidak ditemukan.',
    'ruangan_id.required' => 'Ruangan wajib dipilih.',
    'ruangan_id.exists' => 'Ruangan tidak ditemukan.',
    'lemari_id.required' => 'Lemari wajib dipilih.',
    'lemari_id.exists' => 'Lemari tidak ditemukan.',
    'box_id.required' => 'Box wajib dipilih.',
    'box_id.exists' => 'Box tidak ditemukan.',
    'urutan_surat_masuk.required' => 'Urutan dokumen wajib diisi.',
    'urutan_surat_masuk.integer' => 'Urutan harus berupa angka.',
    'urutan_surat_masuk.min' => 'Urutan minimal 1.',
    'tanggal_surat_masuk.required' => 'Tanggal surat wajib diisi.',
    'tanggal_surat_masuk.date' => 'Format tanggal tidak valid.',
    'asal_surat_masuk.required' => 'Asal surat wajib diisi.',
    'file_surat_masuk.mimes' => 'Format file harus PDF, JPG, PNG, DOC, atau DOCX.',
    'file_surat_masuk.max' => 'Ukuran file tidak boleh lebih dari 5 MB.',
]);

    $arsip_surat_masuk = ArsipSuratMasuk::findOrFail($id);

    // Kalau ada file baru diupload
    if ($request->hasFile('file_surat_masuk')) {
        // Optional: hapus file lama kalau ada
        if ($arsip_surat_masuk->file_surat_masuk && \Storage::disk('public')->exists($arsip_surat_masuk->file_surat_masuk)) {
            \Storage::disk('public')->delete($arsip_surat_masuk->file_surat_masuk);
        }

        // Simpan file baru
        $validatedData['file_surat_masuk'] = $request->file('file_surat_masuk')->store('uploads/surat_masuk', 'public');
    }

    $arsip_surat_masuk->update($validatedData);

    return redirect()->route('arsip_masuk.index')->with('success', 'Data Arsip Surat Masuk berhasil diperbarui!');
}


    public function destroy($id)
    {
        // Menghapus arsip surat masuk berdasarkan ID
        $arsip_surat_masuk = ArsipSuratMasuk::findOrFail($id);
        $arsip_surat_masuk->delete();

        // Redirect ke halaman arsip surat masuk dengan pesan sukses
        return redirect()->route('arsip_masuk.index')->with('success', 'Data Arsip Surat Masuk berhasil dihapus!');
    }
}
                
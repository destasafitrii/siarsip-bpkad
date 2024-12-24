<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratKeluar;

class ArsipSuratKeluarController extends Controller
{
    public function index()
    {
        // Menampilkan semua arsip surat keluar dengan paginasi
        $list_arsip_surat_keluar = ArsipSuratKeluar::paginate(10);
        return view('content.arsip_keluar.index', compact('list_arsip_surat_keluar'));
    }

    public function create()
    {
        // Menampilkan form untuk menambah arsip surat keluar
        return view('content.arsip_keluar.create');
    }

    public function store(Request $request)
    {
        // Validasi data form
        $request->validate([
            'no_surat_keluar' => 'required',
            'nama_surat_keluar' => 'required',
            'tanggal_surat_keluar' => 'required|date',
            'bidang' => 'required',
            'jenis_arsip' => 'required',
            'tujuan_surat_keluar' => 'required',
            'no_berkas_surat_keluar' => 'required',
            'urutan_surat_keluar' => 'required',
            'lokasi_surat_keluar' => 'required',
            'file_surat_keluar' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240', // Menambahkan validasi file
            'keterangan' => 'nullable',
        ]);

        // Mengatur path untuk file
        $filePath = null;
        if ($request->hasFile('file_surat_keluar')) {
            // Memproses unggahan file
            $file = $request->file('file_surat_keluar');
            $filePath = $file->store('uploads/surat_keluar', 'public'); // Simpan file di folder public/uploads/surat_keluar
        }

        // Menyimpan data ke database
        ArsipSuratKeluar::create([
            'no_surat_keluar' => $request->no_surat_keluar,
            'nama_surat_keluar' => $request->nama_surat_keluar,
            'tanggal_surat_keluar' => $request->tanggal_surat_keluar,
            'bidang' => $request->bidang,
            'jenis_arsip' => $request->jenis_arsip,
            'tujuan_surat_keluar' => $request->tujuan_surat_keluar,
            'no_berkas_surat_keluar' => $request->no_berkas_surat_keluar,
            'urutan_surat_keluar' => $request->urutan_surat_keluar,
            'lokasi_surat_keluar' => $request->lokasi_surat_keluar,
            'file_surat_keluar' => $filePath, // Menyimpan path file
            'keterangan' => $request->keterangan,
        ]);

        // Redirect ke halaman arsip surat keluar dengan pesan sukses
        return redirect()->route('arsip_keluar.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Menampilkan detail arsip surat keluar
        $arsip_surat_keluar = ArsipSuratKeluar::findOrFail($id);
        return view('content.arsip_keluar.show', compact('arsip_surat_keluar'));
    }

    public function edit($id)
    {
        // Menampilkan form untuk edit arsip surat keluar
        $arsip_surat_keluar = ArsipSuratKeluar::findOrFail($id);
        return view('content.arsip_keluar.edit', compact('arsip_surat_keluar'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data form
        $request->validate([
            'no_surat_keluar' => 'required',
            'nama_surat_keluar' => 'required',
            'tanggal_surat_keluar' => 'required|date',
            // 'bidang' => 'required',
            // 'jenis_arsip' => 'required',
            'tujuan_surat_keluar' => 'required',
            'no_berkas_surat_keluar' => 'required',
            'urutan_surat_keluar' => 'required',
            'lokasi_surat_keluar' => 'required',
            'file_surat_keluar' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240', // Validasi file
            'keterangan' => 'nullable',
        ]);
        if ($request->hasFile('file_surat_keluar')) {
            // Hapus file lama jika ada
            if ($arsip_surat_keluar->file_surat_keluar) {
                \Storage::disk('public')->delete($arsip_surat_keluar->file_surat_keluar);
            }
        
            // Simpan file baru
            $file = $request->file('file_surat_keluar');
            $filePath = $file->store('uploads/surat_keluar', 'public');
            $arsip_surat_keluar->file_surat_keluar = $filePath;
        }
        

        // Mengambil data arsip surat keluar berdasarkan ID
        $arsip_surat_keluar = ArsipSuratKeluar::findOrFail($id);

        // Update data arsip surat keluar
        $arsip_surat_keluar->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('arsip_keluar.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Mengambil data arsip surat keluar berdasarkan ID
        $arsip_surat_keluar = ArsipSuratKeluar::findOrFail($id);

        // Menghapus arsip surat keluar
        $arsip_surat_keluar->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('arsip_keluar.index')->with('success', 'Data berhasil dihapus!');
    }
}

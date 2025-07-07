<?php

namespace App\Http\Controllers;

use App\Models\{ArsipSuratKeluar, Bidang, Kategori, Box};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportSuratKeluarController extends Controller
{
    public function showForm()
    {
        return view('backend.arsip_keluar.import');
    }

    public function preview(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls|max:3072',
    ]);

    $rows = (new FastExcel)->import($request->file('file'));

    // Validasi struktur kolom
    $expectedHeaders = ['Nomor Surat', 'Nama Surat', 'Tanggal Surat', 'Tujuan Surat', 'Urutan', 'Bidang', 'Jenis Arsip', 'Ruangan', 'Lemari', 'Box'];

    $actualHeaders = array_keys($rows[0]); // Ambil kolom dari baris pertama

    // Ubah jadi lowercase untuk case-insensitive perbandingan
    $expected = array_map('strtolower', $expectedHeaders);
    $actual = array_map('strtolower', $actualHeaders);

    if (array_diff($expected, $actual)) {
        return back()->withErrors(['File Excel tidak sesuai dengan format Arsip Surat Keluar.']);
    }

    return view('backend.arsip_keluar.preview', compact('rows'));
}


    public function save(Request $request)
    {
        $data = json_decode($request->input('data'), true);

        foreach ($data as $row) {
            $bidang = Bidang::where('nama_bidang', $row['Bidang'])->first();
            $kategori = Kategori::where('nama_kategori', $row['Jenis Arsip'])->first();

            $box = Box::whereHas('lemari', function ($query) use ($row) {
                $query->where('nama_lemari', $row['Lemari'])
                    ->whereHas('ruangan', function ($q) use ($row) {
                        $q->where('nama_ruangan', $row['Ruangan']);
                    });
            })->where('nama_box', $row['Box'])->first();

            $tanggalSurat = $row['Tanggal Surat'];
            if (is_numeric($tanggalSurat)) {
                $tanggal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tanggalSurat)->format('Y-m-d');
            } elseif ($tanggalSurat instanceof \DateTimeInterface) {
                $tanggal = $tanggalSurat->format('Y-m-d');
            } else {
                $tanggal = date('Y-m-d', strtotime($tanggalSurat));
            }

            ArsipSuratKeluar::create([
                'no_surat_keluar' => $row['Nomor Surat'],
                'nama_surat_keluar' => $row['Nama Surat'],
                'tanggal_surat_keluar' => $tanggal,
                'tujuan_surat_keluar' => $row['Tujuan Surat'],
                'urutan_surat_keluar' => $row['Urutan'],
                'bidang_id' => $bidang?->bidang_id,
                'kategori_id' => $kategori?->kategori_id,
                'box_id' => $box?->box_id,
                'opd_id' => Auth::user()->opd_id, 
            ]);
        }

        return redirect()->route('arsip_keluar.index')->with('success', 'Data berhasil diimport.');
    }
}

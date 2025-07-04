<?php

namespace App\Http\Controllers;

use App\Models\{ArsipDokumen, Bidang, Kategori, Box};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportDokumenController extends Controller
{
    public function showForm()
    {
        return view('backend.arsip_dokumen.import');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $rows = (new FastExcel)->import($request->file('file'));
        $expectedHeaders = ['Nomor Dokumen', 'Nama Dokumen', 'Tanggal Dokumen', 'Urutan', 'Keterangan', 'Bidang', 'Jenis Arsip', 'Ruangan', 'Lemari', 'Box'];

        $actualHeaders = array_keys($rows[0]);
        $expected = array_map('strtolower', $expectedHeaders);
        $actual = array_map('strtolower', $actualHeaders);

        if (array_diff($expected, $actual)) {
            return back()->withErrors(['File Excel tidak sesuai dengan format Arsip Dokumen.']);
        }

        return view('backend.arsip_dokumen.preview', compact('rows'));
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

            $tanggalDokumen = $row['Tanggal Dokumen'];
            if (is_numeric($tanggalDokumen)) {
                $tanggal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tanggalDokumen)->format('Y-m-d');
            } elseif ($tanggalDokumen instanceof \DateTimeInterface) {
                $tanggal = $tanggalDokumen->format('Y-m-d');
            } else {
                $tanggal = date('Y-m-d', strtotime($tanggalDokumen));
            }

            ArsipDokumen::create([
                'no_dokumen' => $row['Nomor Dokumen'],
                'nama_dokumen' => $row['Nama Dokumen'],
                'tanggal_dokumen' => $tanggal,
                'urutan' => $row['Urutan'],
                'keterangan' => $row['Keterangan'],
                'bidang_id' => $bidang?->bidang_id,
                'kategori_id' => $kategori?->kategori_id,
                'box_id' => $box?->box_id,
                'opd_id' => Auth::user()->opd_id,
            ]);
        }

        return redirect()->route('arsip_dokumen.index')->with('success', 'Data berhasil diimport.');
    }
}

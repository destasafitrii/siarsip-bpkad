<?php

namespace App\Http\Controllers;

use App\Models\{ArsipSuratMasuk, Bidang, Kategori, Box};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportSuratMasukController extends Controller
{
    public function showForm()
    {
        return view('backend.arsip_masuk.import');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:3072',
        ]);

        $rows = (new FastExcel)->import($request->file('file'));

        if ($rows->isEmpty()) {
            return back()->withErrors(['File Excel tidak berisi data. Mohon unggah file yang valid.']);
        }

        // Format tanggal
        $rows = collect($rows)->map(function ($row) {
            foreach ($row as $key => $value) {
                if ($value instanceof \DateTimeInterface) {
                    $row[$key] = $value->format('Y-m-d');
                }
            }
            return $row;
        })->values();

        $expectedHeaders = ['Nomor Surat', 'Nama Surat', 'Tanggal Surat', 'Asal Surat', 'Urutan', 'Bidang', 'Jenis Arsip', 'Ruangan', 'Lemari', 'Box'];
        $actualHeaders = array_keys($rows[0]);

        $expected = array_map('strtolower', $expectedHeaders);
        $actual = array_map('strtolower', $actualHeaders);

        if (array_diff($expected, $actual)) {
            return back()->withErrors(['File Excel tidak sesuai dengan format Arsip Surat Masuk.']);
        }

        // Deteksi duplikat dalam Excel
        $countByNoSurat = $rows->countBy('Nomor Surat');
        $existingNoSurat = ArsipSuratMasuk::pluck('no_surat_masuk')->toArray();

        // Tambahkan status & keterangan
        $rows = $rows->map(function ($row) use ($countByNoSurat, $existingNoSurat) {
            $isDuplicateExcel = $countByNoSurat[$row['Nomor Surat']] > 1;
            $isDuplicateDatabase = in_array($row['Nomor Surat'], $existingNoSurat);

            $row['Status Nomor Surat'] = $isDuplicateExcel || $isDuplicateDatabase
                ? 'Nomor sudah digunakan'
                : 'Nomor tersedia';

            $row['Status'] = $isDuplicateExcel || $isDuplicateDatabase
                ? 'Tidak dapat diimpor (Nomor duplikat)'
                : 'Siap diimpor';

            return $row;
        })->toArray();

        return view('backend.arsip_masuk.preview', compact('rows'));
    }

    public function save(Request $request)
    {
        $data = json_decode($request->input('data'), true);

       foreach ($data as $row) {
    if (strtolower($row['Status'] ?? '') !== 'siap diimpor') {
        continue;
    }

    $bidang = Bidang::where('nama_bidang', trim($row['Bidang']))->first();
    $kategori = Kategori::where('nama_kategori', trim($row['Jenis Arsip']))->first();

    $box = Box::whereHas('lemari', function ($query) use ($row) {
        $query->where('nama_lemari', trim($row['Lemari']))
              ->whereHas('ruangan', function ($q) use ($row) {
                  $q->where('nama_ruangan', trim($row['Ruangan']));
              });
    })->where('nama_box', trim($row['Box']))->first();

    if (!$bidang || !$kategori || !$box) {
        \Log::warning("Data relasi tidak lengkap", $row);
        continue;
    }

    if (!is_numeric($row['Urutan'])) {
        continue;
    }

    $isDuplicate = ArsipSuratMasuk::where('no_surat_masuk', trim($row['Nomor Surat']))->exists();
    if ($isDuplicate) {
        continue;
    }

    $tanggalSurat = $row['Tanggal Surat'];
    $tanggal = date('Y-m-d', strtotime($tanggalSurat));
    if ($tanggal === '1970-01-01') {
        continue;
    }

    try {
        ArsipSuratMasuk::create([
            'no_surat_masuk' => trim($row['Nomor Surat']),
            'nama_surat_masuk' => trim($row['Nama Surat']),
            'tanggal_surat_masuk' => $tanggal,
            'asal_surat_masuk' => trim($row['Asal Surat']),
            'urutan_surat_masuk' => $row['Urutan'],
            'bidang_id' => $bidang->bidang_id,
            'kategori_id' => $kategori->kategori_id,
            'box_id' => $box->box_id,
            'opd_id' => Auth::user()->opd_id,
        ]);
    } catch (\Exception $e) {
        \Log::error('Gagal simpan arsip surat masuk: ' . $e->getMessage());
    }
}


        return redirect()->route('arsip_masuk.index')->with('success', 'Data Arsip Surat Masuk berhasil diimport.');
    }
}

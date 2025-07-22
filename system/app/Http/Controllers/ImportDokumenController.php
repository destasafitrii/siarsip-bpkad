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
        'file' => 'required|mimes:xlsx,xls|max:3072',
    ]);

    $rows = (new FastExcel)->import($request->file('file'));
      if ($rows->isEmpty()) {
        return back()->withErrors(['File Excel tidak berisi data, mohon unggah file dengan minimal satu baris data yang valid.']);
    }

    // Format tanggal jika ada DateTimeInterface
    $rows = collect($rows)->map(function ($row) {
        foreach ($row as $key => $value) {
            if ($value instanceof \DateTimeInterface) {
                $row[$key] = $value->format('Y-m-d');
            }
        }
        return $row;
    })->values();

    $expectedHeaders = ['Nomor Dokumen', 'Nama Dokumen', 'Tanggal Dokumen', 'Urutan', 'Keterangan', 'Bidang', 'Jenis Arsip', 'Ruangan', 'Lemari', 'Box'];
    $actualHeaders = array_keys($rows[0]);
    $expected = array_map('strtolower', $expectedHeaders);
    $actual = array_map('strtolower', $actualHeaders);

    if (array_diff($expected, $actual)) {
        return back()->withErrors(['File Excel tidak sesuai dengan format Arsip Dokumen.']);
    }

    // Deteksi duplikat dalam file Excel
    $countByNoDokumen = $rows->countBy('Nomor Dokumen');

    // Ambil nomor dokumen yang sudah ada di database
    $existingNoDokumen = ArsipDokumen::pluck('no_dokumen')->toArray();

    // Tambahkan kolom is_duplicate dan status
    $rows = $rows->map(function ($row) use ($countByNoDokumen, $existingNoDokumen) {
        $isDuplicateExcel = $countByNoDokumen[$row['Nomor Dokumen']] > 1;
        $isDuplicateDatabase = in_array($row['Nomor Dokumen'], $existingNoDokumen);
      $row['Status Nomor Dokumen'] = $isDuplicateExcel || $isDuplicateDatabase
    ? 'Nomor sudah digunakan'
    : 'Nomor tersedia';

$row['Status'] = $isDuplicateExcel || $isDuplicateDatabase
    ? 'Tidak dapat diimpor (Nomor duplikat)'
    : 'Siap diimpor';


        return $row;
    })->toArray();

    return view('backend.arsip_dokumen.preview', compact('rows'));
}



 public function save(Request $request)
{
    $data = json_decode($request->input('data'), true);
    $dataBerhasil = 0;

    foreach ($data as $row) {
        // Lewati jika tidak siap diimpor
        if (strtolower($row['Status'] ?? '') !== 'siap diimpor') {
            continue;
        }

        // Validasi: lewati jika 'urutan' tidak valid (bukan angka)
        if (!is_numeric($row['Urutan'])) {
            continue;
        }

        // Validasi: lewati jika nomor dokumen sudah ada di database
        $isDuplicate = ArsipDokumen::where('no_dokumen', $row['Nomor Dokumen'])->exists();
        if ($isDuplicate) {
            continue;
        }

        // Relasi
        $bidang = Bidang::where('nama_bidang', $row['Bidang'])->first();
        $kategori = Kategori::where('nama_kategori', $row['Jenis Arsip'])->first();
        $box = Box::whereHas('lemari', function ($query) use ($row) {
            $query->where('nama_lemari', $row['Lemari'])
                  ->whereHas('ruangan', function ($q) use ($row) {
                      $q->where('nama_ruangan', $row['Ruangan']);
                  });
        })->where('nama_box', $row['Box'])->first();

        if (!$bidang || !$kategori || !$box) {
            \Log::warning("Data relasi tidak lengkap", $row);
            continue;
        }

        // Format tanggal
        $tanggalDokumen = $row['Tanggal Dokumen'];
        if (is_numeric($tanggalDokumen)) {
            $tanggal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tanggalDokumen)->format('Y-m-d');
        } elseif ($tanggalDokumen instanceof \DateTimeInterface) {
            $tanggal = $tanggalDokumen->format('Y-m-d');
        } else {
            $tanggal = date('Y-m-d', strtotime($tanggalDokumen));
        }

        try {
            ArsipDokumen::create([
                'no_dokumen' => $row['Nomor Dokumen'],
                'nama_dokumen' => $row['Nama Dokumen'],
                'tanggal_dokumen' => $tanggal,
                'urutan' => $row['Urutan'],
                'keterangan' => $row['Keterangan'],
                'bidang_id' => $bidang->bidang_id,
                'kategori_id' => $kategori->kategori_id,
                'box_id' => $box->box_id,
                'opd_id' => Auth::user()->opd_id,
            ]);
            $dataBerhasil++;
        } catch (\Exception $e) {
            \Log::error('Gagal simpan arsip dokumen: ' . $e->getMessage());
        }
    }

    // Notifikasi hasil impor
    if ($dataBerhasil === 0) {
        return redirect()->route('arsip_dokumen.index')
            ->with('warning', 'Tidak ada data baru yang diimpor. Semua data sudah ada atau gagal divalidasi.');
    }

    return redirect()->route('arsip_dokumen.index')
        ->with('success', "$dataBerhasil data arsip dokumen berhasil diimpor.");
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportArsip;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ArsipImportController extends Controller
{
    public function showImportForm()
    {
        return view('backend.import.form');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048'
        ]);
    
        $file = $request->file('file');
        $path = $file->store('temp');
    
        try {
            $sheets = (new FastExcel)->importSheets(Storage::path($path));
    
            $importedCount = 0;
    
            foreach ($sheets as $rows) {
    
                if (empty($rows) || count($rows) < 2) continue;
    
                // Temukan baris dengan header yang valid
                foreach ($rows as $index => $row) {
                    if (isset($row['No']) && isset($row['Uraian Informasi Arsip'])) {
                        $rows = array_slice($rows, $index); // mulai dari baris header
                        break;
                    }
                }
    
                foreach ($rows as $row) {
                    try {
                        // Skip jika kolom Uraian Informasi Arsip kosong
                        if (empty($row['Uraian Informasi Arsip'])) continue;
                
                        // Normalisasi key agar whitespace tidak bikin gagal (TRIM SEMUA KEY)
                        $row = collect($row)->mapWithKeys(function ($value, $key) {
                            return [trim($key) => $value];
                        })->toArray();
                
                        $data = [
                            'no' => $row['No'] ?? null,
                            'uraian_informasi_arsip' => $row['Uraian Informasi Arsip'],
                            'nomor_surat' => $row['Nomor Surat'] ?? null,
                            'tanggal' => $this->parseDate($row['Tanggal'] ?? null),
                            'tujuan_atau_dari' => $row['Tujuan atau Dari'] ?? null,
                            'no_berkas' => $row['No Berkas'] ?? null,
                            'urutan' => $row['Urutan'] ?? null, // ← ini akan terbaca dengan benar sekarang
                            'lokasi' => $row['Lokasi'] ?? null,
                            'keterangan' => $row['Keterangan'] ?? null,
                            'tahun' => $row['Tahun'] ?? null,
                        ];
                
                        ImportArsip::create($data);
                        $importedCount++;
                    } catch (\Exception $e) {
                        continue;
                    }
                }
                
            }
    
            Storage::disk('local')->delete($path);
    
            return redirect()->route('import.index')
                   ->with('success', "Berhasil mengimpor $importedCount data arsip!");
    
        } catch (\Exception $e) {
            Storage::delete($path);
            return back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage())
                         ->withInput();
        }
    }
    

    
    // Helper untuk parsing tanggal
    private function parseDate($date)
    {
        if (empty($date)) {
            return null;
        }
    
        try {
            if (is_numeric($date)) {
                // Format tanggal dari Excel (angka)
                return \Carbon\Carbon::instance(
                    \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)
                )->format('Y-m-d');
            }
    
            // Format string
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null; // Kalau gagal parsing, jangan paksa return tanggal sekarang
        }
    }
    
    

    // Tambahkan method untuk menampilkan data yang sudah diimport
    public function index(Request $request)
{
    if ($request->ajax()) {
        $query = ImportArsip::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    return view('backend.import.index');
}
}
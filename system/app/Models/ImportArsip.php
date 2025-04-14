<?php

// app/Models/ImportArsip.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportArsip extends Model
{
    use HasFactory;

    protected $table = 'import_arsips';

    protected $fillable = [
        'sheet_name',
        'no',
        'uraian_informasi_arsip',
        'nomor_surat',
        'tanggal',
        'tujuan_atau_dari',
        'no_berkas',
        'urutan',
        'lokasi',
        'keterangan',
        'tahun'
    ];

    // Scope untuk filter berdasarkan sheet name
    public function scopeBySheet($query, $sheetName)
    {
        return $query->where('sheet_name', $sheetName);
    }

    // Scope untuk filter berdasarkan no berkas
    public function scopeByBerkas($query, $noBerkas)
    {
        return $query->where('no_berkas', $noBerkas);
    }
}
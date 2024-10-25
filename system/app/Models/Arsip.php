<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $table = 'arsip';

    protected $primaryKey = 'arsip_id';

    protected $fillable = [
        'nomor_surat',
        'tanggal',
        'bidang',
        'jenis_arsip',
        'tujuan_dari',
        'no_berkas',
        'urutan',
        'lokasi',
        'keterangan',
    ];
}

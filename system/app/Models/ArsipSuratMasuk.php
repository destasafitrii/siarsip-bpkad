<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipSuratMasuk extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'arsip_surat_masuk';

    // Nama primary key
    protected $primaryKey = 'surat_masuk_id';

    // Tentukan apakah model menggunakan timestamps
    public $timestamps = true;

    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'no_surat_masuk',
        'nama_surat_masuk',
        'tanggal_surat_masuk',
        'bidang_id',  // Relasi dengan tabel Bidang
        'kategori_id', // Relasi dengan tabel Kategori
        'asal_surat_masuk',
        'no_berkas_surat_masuk',
        'urutan_surat_masuk',
        'lokasi_surat_masuk',
        'keterangan',
    ];

    // Relasi ke Bidang
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'bidang_id');
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }
}
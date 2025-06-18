<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSuratKeluar extends Model
{
    protected $table = 'arsip_surat_keluar';
    protected $primaryKey = 'surat_keluar_id';

    protected $fillable = [
        'no_surat_keluar',
        'nama_surat_keluar',
        'tanggal_surat_keluar',
        'bidang_id',
        'kategori_id',
        'tujuan_surat_keluar',
        'box_id',
        'urutan_surat_keluar',
        'lokasi_surat_keluar',
        'file_surat_keluar',
        'keterangan_surat_keluar',
        'opd_id',
    ];
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'bidang_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'ruangan_id');
    }

    public function lemari()
    {
        return $this->belongsTo(Lemari::class, 'lemari_id', 'lemari_id');
    }

    public function box()
    {
        return $this->belongsTo(Box::class, 'box_id', 'box_id');
    }

    public function opd()
{
    return $this->belongsTo(Opd::class);
}

}

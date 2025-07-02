<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipDokumen extends Model
{
    use HasFactory;

    protected $table = 'arsip_dokumen';
    protected $primaryKey = 'dokumen_id';

    protected $fillable = [
        'no_dokumen',
        'nama_dokumen',
        'tanggal_dokumen',
        'bidang_id',
        'kategori_id',
        'ruangan_id',
        'lemari_id',
        'box_id',
        'urutan',
        'file_dokumen',
        'keterangan',
        'opd_id',
    ];

    // Relasi ke Bidang
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi ke Ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    // Relasi ke Lemari
    public function lemari()
    {
        return $this->belongsTo(Lemari::class, 'lemari_id');
    }

    // Relasi ke Box
    public function box()
    {
        return $this->belongsTo(Box::class, 'box_id');
    }
public function opd()
{
    return $this->belongsTo(Opd::class, 'opd_id', 'id');
}


}

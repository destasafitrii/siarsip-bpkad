<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Opd extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';  // sudah kamu tambahkan ✅
    public $incrementing = true; // kalau opd_id bertipe INT AUTO_INCREMENT
    protected $keyType = 'int'; // sesuaikan dengan tipe kolom opd_id di database

    protected $fillable = [
        'kode_opd',
        'nama_opd',
        'alamat',
        'surel',
        'maps',
        'kepala_dinas',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function arsipSuratMasuk()
    {
        return $this->hasMany(ArsipSuratMasuk::class, 'opd_id');
    }

    public function arsipSuratKeluar()
    {
        return $this->hasMany(ArsipSuratKeluar::class, 'opd_id');
    }

    public function arsipDokumen()
    {
        return $this->hasMany(ArsipDokumen::class, 'opd_id');
    }
}
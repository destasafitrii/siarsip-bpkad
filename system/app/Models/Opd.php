<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opd extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_opd', // sesuaikan dengan kolom yang ada di tabel `opds`
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

}

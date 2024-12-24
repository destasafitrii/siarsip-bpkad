<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Nama tabel di database
    protected $primaryKey = 'kategori_id'; // Primary key sesuai dengan kolom 'kategori_id'
    
    // Menentukan kolom-kolom yang bisa diisi
    protected $fillable = [
        'bidang_id', // Bidang yang menjadi relasi
        'nama_kategori', // Nama kategori
        'kategori', // Deskripsi kategori atau jenis kategori (sesuai dengan struktur tabel Anda)
    ];

    /**
     * Relasi Kategori ke Bidang (Many to One).
     * 
     * Menyatakan bahwa satu kategori hanya milik satu bidang.
     */
    public function bidang()
    {
        // Menghubungkan dengan model Bidang melalui bidang_id
        return $this->belongsTo(Bidang::class, 'bidang_id', 'bidang_id');
    }
    
}

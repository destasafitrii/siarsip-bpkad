<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidang'; // Nama tabel di database
    protected $primaryKey = 'bidang_id'; // Primary key sesuai dengan kolom 'bidang_id'
    
    // Menentukan kolom-kolom yang bisa diisi
    protected $fillable = [
        'nama_bidang',
    ];

    /**
     * Relasi Bidang ke Kategori (One to Many).
     * 
     * Mengambil semua kategori yang terkait dengan bidang ini
     */
    public function kategori()
    {
        // Menggunakan 'bidang_id' sebagai foreign key di tabel kategori
        return $this->hasMany(Kategori::class, 'bidang_id', 'bidang_id');
    }
}

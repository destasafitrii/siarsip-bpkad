<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidang'; // Nama tabel di database
    protected $primaryKey = 'bidang_id'; // Primary key sesuai kolom 'bidang_id'
    public $incrementing = true; // Jika primary key auto increment
    protected $keyType = 'int'; // Tipe data primary key

    // Menentukan kolom-kolom yang bisa diisi
   protected $fillable = [
    'kode_bidang',
    'nama_bidang',
    'penanggung_jawab',
    'opd_id', // ini penting!
];



    /**
     * Relasi Bidang ke Kategori (One to Many).
     */
    public function kategori()
    {
        // Menggunakan 'bidang_id' sebagai foreign key di tabel kategori
        return $this->hasMany(Kategori::class, 'bidang_id', 'bidang_id');
    }
    
    public function getByOpd($opd_id)
{
    return response()->json(Bidang::where('opd_id', $opd_id)->get());
}

public function opd()
{
    return $this->belongsTo(Opd::class, 'opd_id', 'id');
}


}

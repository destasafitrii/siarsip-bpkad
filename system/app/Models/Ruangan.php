<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $primaryKey = 'ruangan_id';
    public $timestamps = true;

    protected $fillable = [
        'nama_ruangan'
    ];

    // Relasi ke lemaris
    public function lemari()
    {
        return $this->hasMany(Lemari::class, 'ruangan_id', 'ruangan_id');
    }
}

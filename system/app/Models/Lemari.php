<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lemari extends Model
{
    protected $table = 'lemari';
    protected $primaryKey = 'lemari_id';
    public $timestamps = true;

    protected $fillable = [
        'nama_lemari',
        'ruangan_id'
    ];

    // Relasi ke ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'ruangan_id');
    }

    // Relasi ke box
    public function box()
    {
        return $this->hasMany(Box::class, 'lemari_id', 'lemari_id');
    }

    public function getByRuangan($id)
{
    return Lemari::where('ruangan_id', $id)->get();
}

}

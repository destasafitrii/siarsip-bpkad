<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = 'box';
    protected $primaryKey = 'box_id';
    public $timestamps = true;

    protected $fillable = [
        'nama_box',
        'lemari_id',
    ];

    public function lemari()
    {
        return $this->belongsTo(Lemari::class, 'lemari_id', 'lemari_id');
    }

    // Tambahkan relasi ke map jika ada nanti
}

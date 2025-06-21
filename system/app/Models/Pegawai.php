<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $fillable = [
        'nip',
        'nik',
        'nama',
        'golongan',
        'jabatan',
        'status_kepegawaian',
        'opd_id',
    ];


    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function user()
{
    return $this->hasOne(User::class);
}

}

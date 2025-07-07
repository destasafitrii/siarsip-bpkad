<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $opdId = 15; // Ganti dengan ID OPD yang sesuai

        // ASN
        Pegawai::create([
            'nip' => '197901012005011002',
            'nik' => null,
            'nama' => 'Ahmad Suryana, S.E.',
            'golongan' => 'III/c',
            'jabatan' => 'Kepala Sub Bagian Umum',
            'status_kepegawaian' => 'ASN',
            'opd_id' => $opdId,
        ]);

        Pegawai::create([
            'nip' => '198402222010012003',
            'nik' => null,
            'nama' => 'Dina Rahmawati, S.Kom.',
            'golongan' => 'III/b',
            'jabatan' => 'Analis Kepegawaian',
            'status_kepegawaian' => 'ASN',
            'opd_id' => $opdId,
        ]);

        // Honorer
        Pegawai::create([
            'nip' => null,
            'nik' => '6102031501990001',
            'nama' => 'Rizky Hidayat',
            'golongan' => null,
            'jabatan' => null,
            'status_kepegawaian' => 'Honor',
            'opd_id' => $opdId,
        ]);

        Pegawai::create([
            'nip' => null,
            'nik' => '6102032202000002',
            'nama' => 'Lina Marlina',
            'golongan' => null,
            'jabatan' => null,
            'status_kepegawaian' => 'Honor',
            'opd_id' => $opdId,
        ]);
    }
}

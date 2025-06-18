<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Opd;

class OpdSeeder extends Seeder
{
    public function run(): void
    {
        Opd::create([
            'nama_opd' => 'Dinas Contoh'
        ]);
    }
}

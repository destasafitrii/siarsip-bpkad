<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
    $this->call([
        OpdSeeder::class,
        UserSeeder::class,
        SuperadminSeeder::class,
         ArsipSuratMasukSeeder::class,
         ArsipSuratKeluarSeeder::class,
         ArsipDokumenSeeder::class,
         PegawaiSeeder::class
    ]);
}

}

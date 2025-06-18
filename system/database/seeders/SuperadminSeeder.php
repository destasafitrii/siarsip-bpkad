<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah user superadmin sudah ada
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'superadmin',
                'opd_id' => null, // superadmin tidak terikat OPD
            ]);
        }
    }
}

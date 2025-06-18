<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // ✅ tambahkan ini
use Illuminate\Support\Facades\Hash; // ✅ dan ini

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    User::create([
        'name' => 'Pengelola',
        'email' => 'pengelola@gmail.com',
        'password' => Hash::make('password123'),
        'role' => 'pengelola',
        'opd_id' => 1,
    ]);
}
}
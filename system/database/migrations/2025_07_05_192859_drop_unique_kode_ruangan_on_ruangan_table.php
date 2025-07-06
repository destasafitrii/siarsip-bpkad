<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('ruangan', function (Blueprint $table) {
            // Hapus index unik lama
            $table->dropUnique('ruangan_kode_ruangan_unique');
        });
    }

    public function down(): void {
        Schema::table('ruangan', function (Blueprint $table) {
            $table->unique('kode_ruangan');
        });
    }
};

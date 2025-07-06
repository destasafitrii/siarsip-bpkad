<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ruangan', function (Blueprint $table) {
            // Tambah index unik gabungan kode_ruangan + opd_id
            $table->unique(['kode_ruangan', 'opd_id'], 'kode_opd_unik');
        });
    }

    public function down(): void
    {
        Schema::table('ruangan', function (Blueprint $table) {
            // Rollback: hapus index jika diperlukan
            $table->dropUnique('kode_opd_unik');
        });
    }
};

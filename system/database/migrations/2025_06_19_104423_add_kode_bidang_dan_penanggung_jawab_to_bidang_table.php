<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::table('bidang', function (Blueprint $table) {
        $table->string('kode_bidang')->unique()->after('bidang_id');
        $table->string('penanggung_jawab')->after('nama_bidang');
    });
}

public function down(): void
{
    Schema::table('bidang', function (Blueprint $table) {
        $table->dropColumn(['kode_bidang', 'penanggung_jawab']);
    });
}

};

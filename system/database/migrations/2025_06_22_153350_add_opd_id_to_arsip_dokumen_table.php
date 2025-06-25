<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('arsip_dokumen', function (Blueprint $table) {
        $table->unsignedBigInteger('opd_id')->nullable()->after('dokumen_id');

        // Kalau sudah ada relasi ke tabel opd:
        $table->foreign('opd_id')->references('id')->on('opds')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('arsip_dokumen', function (Blueprint $table) {
        $table->dropForeign(['opd_id']);
        $table->dropColumn('opd_id');
    });
}

};

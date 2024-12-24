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
        Schema::table('arsip_surat_masuk', function (Blueprint $table) {
            $table->unsignedBigInteger('bidang_id')->after('lokasi_surat_masuk');
            $table->unsignedBigInteger('kategori_id')->after('bidang_id');

            $table->foreign('bidang_id')->references('bidang_id')->on('bidang')->onDelete('cascade');
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('arsip_surat_masuk', function (Blueprint $table) {
            $table->dropForeign(['bidang_id']);
            $table->dropForeign(['kategori_id']);
            $table->dropColumn(['bidang_id', 'kategori_id']);
        });
    }
};

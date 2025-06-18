<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('arsip_surat_masuk', function (Blueprint $table) {
    $table->unsignedBigInteger('opd_id')->nullable(); // tanpa after('id')
    $table->foreign('opd_id', 'fk_arsip_masuk_opd')
        ->references('id')->on('opds')->onDelete('cascade');
});

Schema::table('arsip_surat_keluar', function (Blueprint $table) {
    $table->unsignedBigInteger('opd_id')->nullable();
    $table->foreign('opd_id', 'fk_arsip_keluar_opd')
        ->references('id')->on('opds')->onDelete('cascade');
});

    }

    public function down(): void
    {
        Schema::table('arsip_surat_masuk', function (Blueprint $table) {
            $table->dropForeign('fk_arsip_masuk_opd');
            $table->dropColumn('opd_id');
        });

        Schema::table('arsip_surat_keluar', function (Blueprint $table) {
            $table->dropForeign('fk_arsip_keluar_opd');
            $table->dropColumn('opd_id');
        });
    }
};

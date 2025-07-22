<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('arsip_surat_keluar', function (Blueprint $table) {
            $table->integer('urutan_surat_keluar')->change();
        });
    }

    public function down(): void
    {
        Schema::table('arsip_surat_keluar', function (Blueprint $table) {
            $table->string('urutan_surat_keluar')->change(); // sesuaikan jika sebelumnya varchar atau string
        });
    }
};

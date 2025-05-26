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
        Schema::create('box_arsips', function (Blueprint $table) {
            $table->id();
            $table->string('kode_box')->unique(); // misal: BOX-A1
            $table->string('lokasi_rak')->nullable(); // rak tempat box disimpan
            $table->text('deskripsi_jilid')->nullable(); // isi box: daftar jilid/judul surat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_arsips');
    }
};

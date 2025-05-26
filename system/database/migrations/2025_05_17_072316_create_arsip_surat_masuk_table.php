<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipSuratMasukTable extends Migration
{
    public function up(): void
    {
        Schema::create('arsip_surat_masuk', function (Blueprint $table) {
            $table->id('surat_masuk_id');
            $table->string('no_surat_masuk')->nullable();
            $table->string('nama_surat_masuk')->nullable();
            $table->date('tanggal_surat_masuk')->nullable();
            $table->string('asal_surat_masuk')->nullable();
            $table->unsignedBigInteger('box_id')->nullable(); // ⬅️ Tambahan kolom relasi ke box
            $table->string('urutan_surat_masuk')->nullable();
            $table->unsignedBigInteger('bidang_id'); // Diperlukan sebelum foreign key
            $table->unsignedBigInteger('kategori_id')->nullable(); // Diperlukan sebelum foreign key
            $table->string('file_surat_masuk')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Relasi foreign key
            $table->foreign('bidang_id')->references('bidang_id')->on('bidang')->onDelete('cascade');
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori')->onDelete('set null');
            $table->foreign('box_id')->references('box_id')->on('box')->onDelete('set null'); // ⬅️ Relasi ke box
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_surat_masuk');
    }
}

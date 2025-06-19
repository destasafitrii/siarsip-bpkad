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
     Schema::create('arsip_dokumen', function (Blueprint $table) {
    $table->id('dokumen_id');
    $table->string('no_dokumen')->nullable();
    $table->string('nama_dokumen');
    $table->date('tanggal_dokumen');

    $table->unsignedBigInteger('bidang_id');
    $table->unsignedBigInteger('kategori_id');
    $table->unsignedBigInteger('ruangan_id')->nullable();
    $table->unsignedBigInteger('lemari_id')->nullable();
    $table->unsignedBigInteger('box_id')->nullable();

    $table->string('file_dokumen')->nullable();
    $table->text('keterangan')->nullable();
    $table->timestamps();

    // Foreign key sesuai dengan nama primary key masing-masing tabel
    $table->foreign('bidang_id')->references('bidang_id')->on('bidang')->onDelete('cascade');
    $table->foreign('kategori_id')->references('kategori_id')->on('kategori')->onDelete('cascade');
    $table->foreign('ruangan_id')->references('ruangan_id')->on('ruangan')->onDelete('set null');
    $table->foreign('lemari_id')->references('lemari_id')->on('lemari')->onDelete('set null');
    $table->foreign('box_id')->references('box_id')->on('box')->onDelete('set null');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_dokumens');
    }
};

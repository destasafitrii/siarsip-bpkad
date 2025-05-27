<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipSuratKeluarTable extends Migration
{
    public function up(): void
    {
        Schema::create('arsip_surat_keluar', function (Blueprint $table) {
            $table->id('surat_keluar_id');
            $table->string('no_surat_keluar')->nullable();
            $table->string('nama_surat_keluar')->nullable();
            $table->date('tanggal_surat_keluar')->nullable();
            $table->string('tujuan_surat_keluar')->nullable();
            $table->unsignedBigInteger('box_id')->nullable(); // ⬅️ Tambahan kolom relasi ke box
            $table->string('urutan_surat_keluar')->nullable();
            $table->unsignedBigInteger('bidang_id');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->string('file_surat_keluar')->nullable();
            $table->text('keterangan_surat_keluar')->nullable();
            $table->timestamps();

            $table->foreign('bidang_id')
                ->references('bidang_id')
                ->on('bidang')
                ->onDelete('cascade');

            $table->foreign('kategori_id')
                ->references('kategori_id')
                ->on('kategori')
                ->onDelete('set null');
            $table->foreign('box_id')->references('box_id')->on('box')->onDelete('set null'); // ⬅️ Relasi ke box
        
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('arsip_surat_keluar');
    }
}

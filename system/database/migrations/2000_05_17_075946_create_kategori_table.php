<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTable extends Migration
{
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('kategori_id');
            $table->string('nama_kategori')->nullable();
            $table->unsignedBigInteger('bidang_id')->nullable();
            $table->timestamps();

            $table->foreign('bidang_id')
                ->references('bidang_id')
                ->on('bidang')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
}

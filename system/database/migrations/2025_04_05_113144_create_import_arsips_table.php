<?php

// database/migrations/xxxx_create_import_arsips_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('import_arsips', function (Blueprint $table) {
            $table->id();
            $table->string('sheet_name');
            $table->integer('no')->nullable();
            $table->text('uraian_informasi_arsip')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('tujuan_atau_dari')->nullable();
            $table->string('no_berkas')->nullable();
            $table->integer('urutan')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            // Tambahkan index untuk pencarian lebih cepat
            $table->index('sheet_name');
            $table->index('no_berkas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('import_arsips');
    }
};
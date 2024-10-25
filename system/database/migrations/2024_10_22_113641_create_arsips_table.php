<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsip', function (Blueprint $table) {
            $table->id('arsip_id');
            $table->string('nomor_surat')->unique();
            $table->date('tanggal');

            // Arsip Produksi (Bidang) - Enum dengan beberapa opsi
            $table->enum('bidang', [
                'anggaran', 
                'pembendaharaan', 
                'akuntansi', 
                'sekretariat'
            ]);

            // Jenis Arsip berdasarkan bidang yang dipilih
            $table->enum('jenis_arsip', [
                'APBD', 
                'SPD', 
                'SP2D', 
                'SPJ', 
                'masuk', 
                'keluar'
            ]);

            $table->string('tujuan_dari');
            $table->string('no_berkas');
            $table->integer('urutan');
            $table->string('lokasi');
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arsip_produksi');
    }
}

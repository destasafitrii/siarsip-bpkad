<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id(); // id pegawai
            $table->string('nip')->unique()->nullable(); // untuk honor bisa null
            $table->string('nama');
            $table->string('golongan')->nullable(); // bisa kosong untuk honor
            $table->string('jabatan');
            $table->foreignId('opd_id')->constrained('opd')->onDelete('cascade'); // relasi ke tabel OPD
            $table->enum('status_kepegawaian', ['ASN', 'Honor'])->default('ASN');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}

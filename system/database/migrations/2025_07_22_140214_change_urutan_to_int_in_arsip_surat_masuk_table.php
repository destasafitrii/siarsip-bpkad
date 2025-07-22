<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUrutanToIntInArsipSuratMasukTable extends Migration
{
    public function up()
    {
        Schema::table('arsip_surat_masuk', function (Blueprint $table) {
            $table->integer('urutan_surat_masuk')->change();
        });
    }

    public function down()
    {
        Schema::table('arsip_surat_masuk', function (Blueprint $table) {
            $table->string('urutan_surat_masuk')->change();
        });
    }
}

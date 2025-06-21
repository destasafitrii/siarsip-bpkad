<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('lemari', function (Blueprint $table) {
            $table->string('kode_lemari')->unique()->after('lemari_id');
            $table->integer('jumlah_rak')->nullable()->after('nama_lemari');
        });
    }

    public function down()
    {
        Schema::table('lemari', function (Blueprint $table) {
            $table->dropColumn('kode_lemari');
            $table->dropColumn('jumlah_rak');
        });
    }
};

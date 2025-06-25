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
        Schema::table('opds', function (Blueprint $table) {
            $table->string('kode_opd')->unique()->after('id');
            $table->string('alamat')->nullable()->after('nama_opd');
            $table->string('surel')->nullable()->after('alamat');
            $table->string('maps')->nullable()->after('surel');
            $table->string('kepala_dinas')->nullable()->after('maps');
        });
    }

    public function down()
    {
        Schema::table('opds', function (Blueprint $table) {
            $table->dropColumn(['kode_opd', 'alamat', 'surel', 'maps', 'kepala_dinas']);
        });
    }
};

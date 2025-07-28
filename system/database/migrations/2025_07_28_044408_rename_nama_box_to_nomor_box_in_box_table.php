<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameNamaBoxToNomorBoxInBoxTable extends Migration
{
    public function up()
    {
        Schema::table('box', function (Blueprint $table) {
            $table->renameColumn('nama_box', 'nomor_box');
        });
    }

    public function down()
    {
        Schema::table('box', function (Blueprint $table) {
            $table->renameColumn('nomor_box', 'nama_box');
        });
    }
}

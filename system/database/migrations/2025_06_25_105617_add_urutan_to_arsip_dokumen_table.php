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
    Schema::table('arsip_dokumen', function (Blueprint $table) {
        $table->integer('urutan')->nullable()->after('box_id');
    });
}

public function down()
{
    Schema::table('arsip_dokumen', function (Blueprint $table) {
        $table->dropColumn('urutan');
    });
}

};

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
    Schema::table('bidang', function (Blueprint $table) {
        $table->unsignedBigInteger('opd_id')->nullable()->after('bidang_id');
        $table->foreign('opd_id')->references('id')->on('opd')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('bidang', function (Blueprint $table) {
        $table->dropForeign(['opd_id']);
        $table->dropColumn('opd_id');
    });
}

};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ruangan', function (Blueprint $table) {
            $table->unsignedBigInteger('opd_id')->after('ruangan_id');

            // Jika tabel OPD ada:
            // $table->foreign('opd_id')->references('id')->on('opd')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('ruangan', function (Blueprint $table) {
            $table->dropColumn('opd_id');
        });
    }
};


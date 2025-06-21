<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('nip')->nullable()->change();
            $table->string('golongan')->nullable()->change();
            $table->string('jabatan')->nullable()->change();
        });
    }

    public function down(): void {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('nip')->nullable(false)->change();
            $table->string('golongan')->nullable(false)->change();
            $table->string('jabatan')->nullable(false)->change();
        });
    }
};

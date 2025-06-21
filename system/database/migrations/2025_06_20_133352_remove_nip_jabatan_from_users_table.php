<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['nip', 'jabatan']);
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('nip')->nullable();
        $table->string('jabatan')->nullable();
    });
}

};

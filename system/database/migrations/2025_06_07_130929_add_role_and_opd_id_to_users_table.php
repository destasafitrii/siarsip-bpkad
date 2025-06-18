<?php

// database/migrations/xxxx_add_role_and_opd_id_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
    if (!Schema::hasColumn('users', 'opd_id')) {
        $table->unsignedBigInteger('opd_id')->nullable()->after('email');
        $table->foreign('opd_id')->references('id')->on('opds')->onDelete('cascade');
    }

    if (!Schema::hasColumn('users', 'role')) {
        $table->enum('role', ['superadmin', 'pengelola', 'pengguna'])->default('pengguna')->after('opd_id');
    }
});

    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['opd_id']);
            $table->dropColumn(['role', 'opd_id']);
        });
    }
};

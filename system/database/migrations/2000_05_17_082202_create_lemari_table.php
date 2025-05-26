<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLemariTable extends Migration
{
    public function up(): void
    {
        Schema::create('lemari', function (Blueprint $table) {
            $table->id('lemari_id');
            $table->string('nama_lemari');
            $table->unsignedBigInteger('ruangan_id');
            $table->timestamps();

            $table->foreign('ruangan_id')->references('ruangan_id')->on('ruangan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lemari');
    }
}

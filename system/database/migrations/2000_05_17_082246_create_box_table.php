<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxTable extends Migration
{
    public function up(): void
    {
        Schema::create('box', function (Blueprint $table) {
            $table->id('box_id');
            $table->string('nama_box');
            $table->unsignedBigInteger('lemari_id');
            $table->timestamps();

            $table->foreign('lemari_id')->references('lemari_id')->on('lemari')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('box');
    }
}

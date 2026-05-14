<?php
// database/migrations/2026_05_14_000020_create_jenis_ujian_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jenis_ujian', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->integer('bobot')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_ujian');
    }
};
<?php
// database/migrations/2026_05_14_000012_create_kitab_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kitab', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kitab', 100);
            $table->string('pengarang', 100)->nullable();
            $table->string('penerbit', 100)->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitab');
    }
};
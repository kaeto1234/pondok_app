<?php
// database/migrations/2026_05_14_000022_create_materi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 200);
            $table->text('deskripsi')->nullable();
            $table->string('path_file', 255);
            $table->integer('ukuran_file')->nullable();
            $table->foreignId('mapel_id')->nullable()->constrained('mata_pelajaran')->onDelete('set null');
            $table->foreignId('tingkat_id')->nullable()->constrained('tingkat_diniyah')->onDelete('set null');
            $table->foreignId('diupload_oleh')->constrained('users')->onDelete('cascade');
            $table->integer('diunduh')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materi');
    }
};
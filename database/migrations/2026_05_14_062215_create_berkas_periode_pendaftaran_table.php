<?php
// database/migrations/2026_05_14_000004_create_berkas_periode_pendaftaran_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('berkas_periode_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_pendaftaran_id')->constrained('periode_pendaftaran')->onDelete('cascade');
            $table->foreignId('jenis_berkas_id')->constrained('jenis_berkas')->onDelete('cascade');
            $table->boolean('is_required')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('berkas_periode_pendaftaran');
    }
};
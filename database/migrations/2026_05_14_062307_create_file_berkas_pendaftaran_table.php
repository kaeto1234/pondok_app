<?php
// database/migrations/2026_05_14_000006_create_file_berkas_pendaftaran_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('file_berkas_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            $table->foreignId('berkas_periode_pendaftaran_id')->constrained('berkas_periode_pendaftaran')->onDelete('cascade');
            $table->string('path_file', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_berkas_pendaftaran');
    }
};
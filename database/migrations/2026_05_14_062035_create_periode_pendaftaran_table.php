<?php
// database/migrations/2026_05_14_000003_create_periode_pendaftaran_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('periode_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran', 20);
            $table->string('nama', 100);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('periode_pendaftaran');
    }
};
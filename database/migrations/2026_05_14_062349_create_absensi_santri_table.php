<?php
// database/migrations/2026_05_14_000019_create_absensi_santri_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('absensi_santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('absensi_guru_id')->constrained('absensi_guru')->onDelete('cascade');
            $table->foreignId('santri_tingkat_id')->constrained('santri_tingkat')->onDelete('cascade');
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alpha']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi_santri');
    }
};
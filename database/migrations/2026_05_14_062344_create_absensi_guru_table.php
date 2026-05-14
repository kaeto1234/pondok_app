<?php
// database/migrations/2026_05_14_000018_create_absensi_guru_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('absensi_guru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_mengajar_id')->constrained('jadwal_mengajar')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('pertemuan_ke');
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alpha']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->unique(['jadwal_mengajar_id', 'tanggal']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi_guru');
    }
};
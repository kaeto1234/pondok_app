<?php
// database/migrations/2026_05_14_000021_create_nilai_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_tingkat_id')->constrained('santri_tingkat')->onDelete('cascade');
            $table->foreignId('kurikulum_id')->constrained('kurikulum')->onDelete('cascade');
            $table->foreignId('jenis_ujian_id')->constrained('jenis_ujian')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->decimal('nilai', 5, 2);
            $table->date('tanggal_ujian');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai');
    }
};
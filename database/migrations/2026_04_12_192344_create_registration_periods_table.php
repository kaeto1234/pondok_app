<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registration_periods', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year', 20); // tahun ajaran (2025/2026)
            $table->string('name', 100); // nama periode (Gelombang 1, Reguler)
            $table->date('start_date'); // tanggal mulai
            $table->date('end_date'); // tanggal tutup
            $table->boolean('is_active')->default(true); // apakah periode aktif
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registration_periods');
    }
};
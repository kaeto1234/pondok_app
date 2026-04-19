<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teaching_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade'); // id guru
            $table->foreignId('subject_level_id')->constrained('subject_levels')->onDelete('cascade'); // id mapel_tingkat
            $table->enum('day', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']); // hari
            $table->time('start_time'); // jam mulai
            $table->time('end_time'); // jam selesai
            $table->string('room', 50)->nullable(); // ruangan
            $table->string('academic_year', 20); // tahun ajaran
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teaching_schedules');
    }
};
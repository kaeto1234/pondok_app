<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_level_id')->constrained('student_levels')->onDelete('cascade'); // id student_level
            $table->foreignId('subject_level_id')->constrained('subject_levels')->onDelete('cascade'); // id mapel_tingkat
            $table->foreignId('exam_type_id')->constrained('exam_types')->onDelete('cascade'); // id jenis ujian
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade'); // id guru
            $table->decimal('score', 5, 2); // nilai (0-100)
            $table->date('exam_date'); // tanggal ujian
            $table->text('notes')->nullable(); // catatan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
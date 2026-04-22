<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // id santri
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade'); // id tingkat
            $table->string('academic_year', 20); // tahun ajaran
            $table->date('start_date'); // tanggal mulai
            $table->date('end_date')->nullable(); // tanggal selesai
            $table->enum('status', ['active', 'graduated', 'transferred'])->default('active'); // status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_levels');
    }
};
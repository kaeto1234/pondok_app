<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // id santri
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // id user wali (opsional)
            $table->string('father_name', 100)->nullable(); // nama ayah
            $table->string('father_education', 50)->nullable(); // pendidikan ayah
            $table->string('father_job', 100)->nullable(); // pekerjaan ayah
            $table->string('father_phone', 20)->nullable(); // no telepon ayah
            $table->string('mother_name', 100)->nullable(); // nama ibu
            $table->string('mother_education', 50)->nullable(); // pendidikan ibu
            $table->string('mother_job', 100)->nullable(); // pekerjaan ibu
            $table->string('mother_phone', 20)->nullable(); // no telepon ibu
            $table->string('guardian_name', 100)->nullable(); // nama wali
            $table->string('guardian_relation', 50)->nullable(); // hubungan wali
            $table->string('guardian_phone', 20)->nullable(); // no telepon wali
            $table->text('address')->nullable(); // alamat
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_parents');
    }
};
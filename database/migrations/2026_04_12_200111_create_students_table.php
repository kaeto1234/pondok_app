<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 50)->unique(); // nomor induk santri
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // id user (opsional)
            $table->foreignId('registration_id')->nullable()->constrained('registrations')->onDelete('set null'); // id pendaftaran
            $table->string('full_name', 100); // nama lengkap
            $table->string('place_of_birth', 50)->nullable(); // tempat lahir
            $table->date('date_of_birth')->nullable(); // tanggal lahir
            $table->enum('gender', ['L', 'P']); // jenis kelamin
            $table->text('address')->nullable(); // alamat
            $table->string('phone', 20)->nullable(); // no telepon santri
            $table->string('photo', 255)->nullable(); // foto
            $table->enum('status', ['active', 'graduated', 'quit'])->default('active'); // status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
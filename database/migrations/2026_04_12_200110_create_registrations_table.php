<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number', 50)->unique(); // no pendaftaran
            $table->foreignId('registration_period_id')->constrained('registration_periods'); // id periode
            $table->string('full_name', 100); // nama lengkap
            $table->string('place_of_birth', 50)->nullable(); // tempat lahir
            $table->date('date_of_birth')->nullable(); // tanggal lahir
            $table->enum('gender', ['L', 'P']); // jenis kelamin
            $table->string('origin_school', 100)->nullable(); // asal sekolah
            $table->text('address')->nullable(); // alamat
            $table->string('parent_name', 100)->nullable(); // nama orang tua
            $table->string('parent_phone', 20)->nullable(); // no telepon orang tua
            $table->datetime('registration_date')->useCurrent(); // tanggal daftar
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending'); // status
            $table->text('notes')->nullable(); // catatan
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // diverifikasi oleh
            $table->datetime('verified_at')->nullable(); // diverifikasi pada
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registrations');
    }
};
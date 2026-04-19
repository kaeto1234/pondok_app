<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // id user
            $table->string('nip', 50)->unique()->nullable(); // nip
            $table->string('full_name', 100); // nama lengkap
            $table->string('phone', 20)->nullable(); // no telepon
            $table->string('email', 100)->nullable(); // email
            $table->text('specialty')->nullable(); // keahlian
            $table->date('join_date')->nullable(); // tanggal masuk
            $table->boolean('is_active')->default(true); // aktif/tidak
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
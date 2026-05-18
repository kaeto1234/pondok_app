<?php
// database/migrations/2026_05_14_000008_create_orang_tua_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orang_tua', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('nama_ayah', 100)->nullable();
            $table->string('pendidikan_ayah', 50)->nullable();
            $table->string('pekerjaan_ayah', 100)->nullable();
            $table->string('telepon_ayah', 20)->nullable();
            $table->string('nama_ibu', 100)->nullable();
            $table->string('pendidikan_ibu', 50)->nullable();
            $table->string('pekerjaan_ibu', 100)->nullable();
            $table->string('telepon_ibu', 20)->nullable();
            $table->string('nama_wali', 100)->nullable();
            $table->string('hubungan_wali', 50)->nullable();
            $table->string('telepon_wali', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orang_tua');
    }
};
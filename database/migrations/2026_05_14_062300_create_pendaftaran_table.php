<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran', 50)->unique();
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran'); // ← ganti dari periode_pendaftaran_id
            $table->string('nama_lengkap', 100);
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('asal_sekolah', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('nama_orang_tua', 100)->nullable();
            $table->string('telepon_orang_tua', 20)->nullable();
            $table->datetime('tanggal_daftar')->useCurrent();
            $table->enum('status', ['pending', 'diverifikasi', 'ditolak'])->default('pending');
            $table->text('catatan')->nullable();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->datetime('diverifikasi_pada')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
};

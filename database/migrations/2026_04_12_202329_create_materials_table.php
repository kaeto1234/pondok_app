<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200); // judul materi
            $table->text('description')->nullable(); // deskripsi
            $table->string('file_path', 255); // path file
            $table->integer('file_size')->nullable(); // ukuran file (KB)
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->onDelete('set null'); // id mapel
            $table->foreignId('program_id')->nullable()->constrained('programs')->onDelete('set null'); // id program
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade'); // diupload oleh
            $table->integer('downloads')->default(0); // jumlah download
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materials');
    }
};
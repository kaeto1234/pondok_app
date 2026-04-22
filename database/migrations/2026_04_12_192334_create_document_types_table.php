<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // nama berkas (ijazah, akta, dll)
            $table->string('file_type', 50)->default('pdf,jpg,png'); // tipe file yang diizinkan
            $table->integer('max_size')->default(2048); // ukuran maksimal (KB)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_types');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // nama mapel (Tauhid, Fiqih)
            $table->string('book_name', 100)->nullable(); // nama kitab
            $table->string('author', 100)->nullable(); // pengarang
            $table->text('description')->nullable(); // deskripsi
            $table->boolean('is_active')->default(true); // aktif/tidak
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
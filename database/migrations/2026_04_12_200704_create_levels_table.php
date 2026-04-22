<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade'); // id program
            $table->string('name', 50); // nama tingkat (Kelas 1, Kelas 2)
            $table->integer('order')->default(0); // urutan
            $table->boolean('is_active')->default(true); // aktif/tidak
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('levels');
    }
};
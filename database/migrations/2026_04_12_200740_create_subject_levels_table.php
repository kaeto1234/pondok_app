<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subject_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade'); // id tingkat
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade'); // id mapel
            $table->integer('order')->default(0); // urutan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subject_levels');
    }
};
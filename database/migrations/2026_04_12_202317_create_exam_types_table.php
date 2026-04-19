<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exam_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50); // nama (Tugas, UTS, UAS)
            $table->integer('weight')->default(0); // bobot nilai
            $table->text('description')->nullable(); // keterangan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_types');
    }
};
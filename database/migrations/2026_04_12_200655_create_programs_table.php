<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50); // nama program (Ula, Wustha)
            $table->text('description')->nullable(); // deskripsi
            $table->integer('order')->default(0); // urutan
            $table->boolean('is_active')->default(true); // aktif/tidak
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('programs');
    }
};
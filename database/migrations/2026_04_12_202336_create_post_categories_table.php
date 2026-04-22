<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // nama kategori (Berita, Kegiatan)
            $table->string('slug', 100)->unique(); // slug untuk URL
            $table->text('description')->nullable(); // deskripsi
            $table->string('icon', 50)->nullable(); // icon
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_categories');
    }
};
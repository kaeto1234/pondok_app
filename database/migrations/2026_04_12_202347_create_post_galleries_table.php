<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('post_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // id post
            $table->string('image_path', 255); // path gambar
            $table->string('caption', 255)->nullable(); // caption/keterangan
            $table->boolean('is_primary')->default(false); // gambar utama?
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_galleries');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200); // judul
            $table->longText('content')->nullable(); // konten
            $table->enum('post_type', ['post', 'page'])->default('post'); // tipe post
            $table->foreignId('post_category_id')->nullable()->constrained('post_categories')->onDelete('set null'); // id kategori
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // id penulis
            $table->datetime('published_at')->nullable(); // tanggal publikasi
            $table->string('slug', 200)->unique(); // slug untuk URL
            $table->integer('menu_order')->default(0); // urutan menu
            $table->string('featured_image', 255)->nullable(); // gambar unggulan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
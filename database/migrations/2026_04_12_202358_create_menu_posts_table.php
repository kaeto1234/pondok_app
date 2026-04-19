<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menu_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade'); // id menu
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // id post
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_posts');
    }
};
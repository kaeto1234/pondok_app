<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menu_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade'); // id menu
            $table->string('url', 255); // url link
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_links');
    }
};
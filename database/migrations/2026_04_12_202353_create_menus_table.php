<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('label', 100); // label menu
            $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade'); // id parent (untuk sub menu)
            $table->integer('order')->default(0); // urutan
            $table->boolean('is_active')->default(true); // aktif/tidak
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
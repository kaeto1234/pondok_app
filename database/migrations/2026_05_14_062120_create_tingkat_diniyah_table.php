<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tingkat_diniyah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tingkat', 50);
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tingkat_diniyah');
    }
};
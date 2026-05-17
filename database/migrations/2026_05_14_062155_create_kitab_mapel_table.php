<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kitab_mapel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kitab_id')->constrained('kitab')->onDelete('cascade');
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->integer('urutan')->default(0);
            $table->timestamps();
            
            $table->unique(['kitab_id', 'mata_pelajaran_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitab_mapel');
    }
};
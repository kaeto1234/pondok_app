<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jenis_berkas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('tipe_file', 50)->default('pdf,jpg,png');
            $table->integer('ukuran_maksimal')->default(2048);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_berkas');
    }
};
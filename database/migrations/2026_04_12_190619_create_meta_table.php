<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('meta', function (Blueprint $table) {
            $table->id();
            $table->string('meta_key', 100); // kunci (sejarah, visi, alamat, dll)
            $table->text('meta_value')->nullable(); // nilai
            $table->string('meta_group', 50)->default('profil'); // grup (profil, kontak, pengaturan)
            $table->integer('order')->default(0); // urutan
            $table->boolean('is_active')->default(true); // aktif/tidak
            $table->timestamps();
            
            $table->unique(['meta_key', 'meta_group']); // kombinasi unique
        });
    }

    public function down()
    {
        Schema::dropIfExists('meta');
    }
};
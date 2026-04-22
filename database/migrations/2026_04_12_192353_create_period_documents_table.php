<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('period_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_period_id')->constrained('registration_periods')->onDelete('cascade'); // id periode
            $table->foreignId('document_type_id')->constrained('document_types')->onDelete('cascade'); // id jenis berkas
            $table->boolean('is_required')->default(true); // apakah wajib
            $table->integer('order')->default(0); // urutan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('period_documents');
    }
};
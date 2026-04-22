<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registration_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade'); // id pendaftaran
            $table->foreignId('period_document_id')->constrained('period_documents')->onDelete('cascade'); // id berkas periode
            $table->string('file_path', 255); // path file
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registration_files');
    }
};
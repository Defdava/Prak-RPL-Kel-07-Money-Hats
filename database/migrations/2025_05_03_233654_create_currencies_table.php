<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama mata uang, misalnya "Rupiah"
            $table->string('code'); // Kode mata uang, misalnya "IDR"
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};

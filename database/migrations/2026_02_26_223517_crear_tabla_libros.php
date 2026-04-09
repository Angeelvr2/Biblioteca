<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 250);
            $table->string('isbn', 100);
            $table->string('autor', 255);
            $table->string('editorial', 250);
            $table->smallInteger('estatus')->default(0);
            $table->unsignedBigInteger('id_categoria');
            
            // Clave foránea
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
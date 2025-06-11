<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id(); 
            $table->string('direccion');
            $table->enum('genero', ['masculino', 'femenino']);
            $table->timestamps();

            // Relación con la tabla usuarios
            $table->foreign('id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};


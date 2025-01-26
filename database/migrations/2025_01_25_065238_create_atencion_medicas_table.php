<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atencion_medicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_medica_id')->constrained('cita_medicas')->onDelete('cascade');
            $table->text('paciente_nombre');
            $table->text('medico_nombre');
            $table->text('diagnostico');
            $table->text('tratamiento');
            $table->text('receta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atencion_medicas');
    }
};

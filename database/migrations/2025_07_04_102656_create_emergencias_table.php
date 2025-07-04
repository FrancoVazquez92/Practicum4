<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciasTable extends Migration
{
    public function up()
    {
        Schema::create('emergencias', function (Blueprint $table) {
            $table->id('id_emergencia');
            $table->string('nombre_paciente');
            $table->string('numero_identificacion')->unique();
            $table->date('fecha_nacimiento');
            $table->enum('genero', ['Masculino', 'Femenino']);
            $table->timestamps();

         });
    }

    public function down()
    {
        Schema::dropIfExists('emergencias');
    }
}


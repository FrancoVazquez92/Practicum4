<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriajesTable extends Migration
{
    public function up()
    {
        Schema::create('triajes', function (Blueprint $table) {
            $table->id('id_triaje');
            $table->unsignedBigInteger('id_emergencia')->nullable();
            $table->integer('frecuencia_cardiaca');
            $table->integer('frecuencia_respiratoria');
            $table->integer('presion_arterial_sistolica');
            $table->integer('saturacion_oxigeno');
            $table->enum('nivel_conciencia', ['Alerta', 'Respuesta a voz', 'Respuesta al dolor', 'Inconsciente']);
            $table->timestamps();

            // Clave foránea hacia emergencia (relación 1:1)
            $table->foreign('id_emergencia')->references('id_emergencia')->on('emergencias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('triajes');
    }
}

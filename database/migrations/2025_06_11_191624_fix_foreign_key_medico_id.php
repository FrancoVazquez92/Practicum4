<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixForeignKeyMedicoId extends Migration
{
    public function up()
    {
        // Quitar la clave foránea de cita_medicas
        Schema::table('cita_medicas', function (Blueprint $table) {
            $table->dropForeign(['medico_id']);
        });

        // Modificar la tabla medicos
        Schema::table('medicos', function (Blueprint $table) {
            $table->dropColumn(['nombre', 'apellido']); // si no lo has hecho
            // Aquí ya no necesitas cambiar id si ya es bigint unsigned
        });

        // Volver a agregar la clave foránea
        Schema::table('cita_medicas', function (Blueprint $table) {
            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');
        });
    }

    public function down()
    {
        // En reversa
        Schema::table('cita_medicas', function (Blueprint $table) {
            $table->dropForeign(['medico_id']);
        });

        Schema::table('medicos', function (Blueprint $table) {
            $table->string('nombre');
            $table->string('apellido');
        });

        Schema::table('cita_medicas', function (Blueprint $table) {
            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');
        });
    }
}
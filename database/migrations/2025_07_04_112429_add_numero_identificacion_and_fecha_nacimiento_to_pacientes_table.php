<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumeroIdentificacionAndFechaNacimientoToPacientesTable extends Migration
{
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
                $table->string('numero_identificacion')->after('id')->unique();
                $table->date('fecha_nacimiento')->nullable()->after('numero_identificacion');
        });
    }

    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropColumn('numero_identificacion');
            $table->dropColumn('fecha_nacimiento');
        });
    }
}
Schema::table('pacientes', function (Blueprint $table) {

});

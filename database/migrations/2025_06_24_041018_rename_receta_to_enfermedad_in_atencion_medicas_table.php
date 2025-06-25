<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameRecetaToEnfermedadInAtencionMedicasTable extends Migration
{
    public function up()
    {
        Schema::table('atencion_medicas', function (Blueprint $table) {
            $table->renameColumn('receta', 'enfermedad');
        });
    }

    public function down()
    {
        Schema::table('atencion_medicas', function (Blueprint $table) {
            $table->renameColumn('enfermedad', 'receta');
        });
    }
}


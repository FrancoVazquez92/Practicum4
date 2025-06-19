<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDiaColumnTypeInAgendasTable extends Migration
{
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->date('dia')->change(); // Cambiar el tipo de string a date
        });
    }

    public function down()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->string('dia')->change(); // Revertir si es necesario
        });
    }
}


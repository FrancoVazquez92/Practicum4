<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('medicos', function (Blueprint $table) {
        $table->dropColumn(['nombre', 'apellido']); // elimina los campos innecesarios

        $table->unsignedBigInteger('id')->change(); // asegurarse que id sea unsigned
        $table->foreign('id')->references('id')->on('usuarios')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('medicos', function (Blueprint $table) {
        $table->dropForeign(['id']);
        $table->string('nombre');
        $table->string('apellido');
    });
}

};

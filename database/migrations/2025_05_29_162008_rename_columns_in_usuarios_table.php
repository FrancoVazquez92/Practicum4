<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->renameColumn('correoelectronico', 'email');
            $table->renameColumn('contrasena', 'password');
        });
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->renameColumn('email', 'correoelectronico');
            $table->renameColumn('password', 'contrasena');
        });
    }
};

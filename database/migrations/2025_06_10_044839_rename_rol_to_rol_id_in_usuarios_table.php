<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends \Illuminate\Database\Migrations\Migration {
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->renameColumn('rol', 'rol_id');
        });
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->renameColumn('rol_id', 'rol');
        });
    }
};


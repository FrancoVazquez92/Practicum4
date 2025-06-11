<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("ALTER TABLE usuarios MODIFY rol_id BIGINT UNSIGNED NULL");
    }

    public function down()
    {
        DB::statement("ALTER TABLE usuarios MODIFY rol_id VARCHAR(255) NULL");
    }

};

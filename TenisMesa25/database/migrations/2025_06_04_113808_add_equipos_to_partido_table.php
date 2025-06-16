<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEquiposToPartidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('partido', function (Blueprint $table) {
        $table->string('equipo_local')->nullable()->after('equipo');
        $table->string('equipo_visitante')->nullable()->after('equipo_local');
    });
}

public function down()
{
    Schema::table('partido', function (Blueprint $table) {
        $table->dropColumn(['equipo_local', 'equipo_visitante']);
    });
}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGanadorToPartidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('partido', function (Blueprint $table) {
        $table->string('ganador', 100)->nullable()->after('usuario_id');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('partido', function (Blueprint $table) {
        $table->dropColumn('ganador');
    });
    }
}

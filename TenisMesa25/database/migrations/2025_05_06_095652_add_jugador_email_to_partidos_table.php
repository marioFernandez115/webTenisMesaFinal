<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJugadorEmailToPartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partido', function (Blueprint $table) {
        $table->string('jugador_email')->after('id');  // Asegúrate de colocar la columna después del ID o donde prefieras.
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
            $table->dropColumn('jugador_email');
        });
    }
}

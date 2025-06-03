<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveJugadorEmailFromPartido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partido', function (Blueprint $table) {
            $table->dropColumn('jugador_email'); // Elimina el campo jugador_email
        });
    }
    
    public function down()
    {
        Schema::table('partido', function (Blueprint $table) {
            $table->string('jugador_email'); // Si es necesario, lo puedes volver a añadir en el método down
        });
    }
    
}

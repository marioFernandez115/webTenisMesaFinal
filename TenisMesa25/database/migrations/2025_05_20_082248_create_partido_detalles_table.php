<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partido_detalles', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->unsignedBigInteger('partido_id');
            $table->unsignedBigInteger('usuario_local_id')->nullable(); // <- Aquí permitimos null

            // Jugadores
            $table->string('jugador_local')->nullable();
            $table->string('jugador_visitante');

            // Juegos: formato tipo "11-9"
            $table->string('juego_1', 10)->nullable();
            $table->string('juego_2', 10)->nullable();
            $table->string('juego_3', 10)->nullable();
            $table->string('juego_4', 10)->nullable();
            $table->string('juego_5', 10)->nullable();
            $table->string('juego_6', 10)->nullable();

            $table->timestamps();

            // Relaciones
            $table->foreign('partido_id')
                  ->references('id')
                  ->on('partido')
                  ->onDelete('cascade');

            $table->foreign('usuario_local_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partido_detalles');
    }
}

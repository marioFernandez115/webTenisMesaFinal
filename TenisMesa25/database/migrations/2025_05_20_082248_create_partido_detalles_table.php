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

            // Relaciones
            $table->unsignedBigInteger('partido_id');
            $table->unsignedBigInteger('usuario_local_id')->nullable(); // id del usuario (jugador local)

            // Datos de jugadores (se guardan los nombres en texto plano también)
            $table->string('jugador_local')->nullable(); // redundancia opcional
            $table->string('jugador_visitante');

            // Juegos individuales (hasta 6)
            $table->string('juego_1', 10)->nullable();
            $table->string('juego_2', 10)->nullable();
            $table->string('juego_3', 10)->nullable();
            $table->string('juego_4', 10)->nullable();
            $table->string('juego_5', 10)->nullable();
            $table->string('juego_6', 10)->nullable();

            // Resultado parcial (opcional: puedes usarlo para mostrar quién ganó el enfrentamiento)
            $table->string('ganador')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('partido_id')->references('id')->on('partido')->onDelete('cascade');
            $table->foreign('usuario_local_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes para rendimiento
            $table->index('partido_id');
            $table->index('usuario_local_id');
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

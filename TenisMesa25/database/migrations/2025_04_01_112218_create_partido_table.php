<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id'); // Se añadió el campo para el usuario
            $table->string('nombrePartido', 50);
            $table->string('nombre', 50);
            $table->date('fecha');
            $table->integer('jornada');
            $table->string('division');
            $table->string('equipo');
            $table->string('resultado');
            $table->unsignedBigInteger('id_liga')->nullable(); // Liga puede ser nula
            $table->unsignedBigInteger('id_instalacion')->nullable(); // Instalación puede ser nula
            $table->timestamps();
    
            // Relaciones
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_liga')->references('id')->on('liga')->onDelete('set null'); // Liga puede ser nula
            $table->foreign('id_instalacion')->references('id')->on('instalacion')->onDelete('set null'); // Instalación puede ser nula
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partido');
    }
}

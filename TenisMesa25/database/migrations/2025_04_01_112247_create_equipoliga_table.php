<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoligaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipoliga', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('id_liga');
            $table->unsignedBigInteger('id_socio');
            $table->foreign('id_liga')->references('id')->on('liga')->onDelete('cascade');
            $table->foreign('id_socio')->references('id')->on('socio')->onDelete('cascade');
            $table->boolean('es_responsable')->default(0);
            $table->dateTime('fecha_inclusion')->nullable();
            $table->dateTime('fecha_baja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipoliga');
    }
}

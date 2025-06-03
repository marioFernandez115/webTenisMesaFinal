<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimiento', function (Blueprint $table) {
           
            $table->id();
            $table->foreignId('id_socio')->constrained('socio')->onDelete('cascade');
            $table->foreignId('id_temporada')->constrained('temporada')->onDelete('cascade');
            $table->foreignId('id_evolucion')->constrained('evolucion')->onDelete('cascade');
            $table->dateTime('fecha');
            $table->text('descripcion'); 
            $table->text('propuesta');
            $table->text('resultado');
            $table->boolean('activo')->default(1);
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
        Schema::dropIfExists('seguimiento');
    }
}

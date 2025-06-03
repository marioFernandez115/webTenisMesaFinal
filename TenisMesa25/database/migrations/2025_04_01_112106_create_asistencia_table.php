<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('asistencia', function (Blueprint $table) {
         
        $table->id();
        $table->dateTime('fecha');
        $table->unsignedBigInteger('id_socio');
        $table->unsignedBigInteger('id_instalacion');
        $table->foreign('id_socio')->references('id')->on('socio')
            ->onUpdate('cascade')
            ->onDelete('cascade'); 
        $table->foreign('id_instalacion')->references('id')->on('instalacion')
            ->onUpdate('cascade')
            ->onDelete('cascade'); 
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
        Schema::dropIfExists('asistencia');
    }
}

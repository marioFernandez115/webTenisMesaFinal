<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlineacionpartidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alineacionpartido', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('id_partido');
            $table->unsignedBigInteger('id_socio');
            $table->foreign('id_partido')->references('id')->on('partido')
                ->onUpdate('cascade')
                ->onDelete('cascade'); 
            $table->foreign('id_socio')->references('id')->on('socio')
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
        Schema::dropIfExists('alineacionpartido');
    }
}

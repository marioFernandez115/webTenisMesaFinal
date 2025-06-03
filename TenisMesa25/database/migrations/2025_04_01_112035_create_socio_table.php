<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socio', function (Blueprint $table) {
            
            $table->id();
            $table->string('nombre', 50);
            $table->string('apellido_1', 50);
            $table->string('apellido_2', 50)->nullable();
            $table->dateTime('fecha_nacimiento');
            $table->string('dni', 10)->unique();
            $table->string('telefono', 10);
            $table->string('email', 100)->unique();
            $table->boolean('autorizacion_rrss')->default(0);
            $table->boolean('activo')->default(1);
            $table->unsignedBigInteger('id_tipo_socio'); 
            $table->foreign('id_tipo_socio')->references('id')->on('tiposocio')
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
        Schema::dropIfExists('socio');
    }
}

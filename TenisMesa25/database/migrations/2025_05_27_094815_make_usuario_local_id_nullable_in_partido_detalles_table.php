<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUsuarioLocalIdNullableInPartidoDetallesTable extends Migration
{
    public function up()
    {
        Schema::table('partido_detalles', function (Blueprint $table) {
            // Cambia usuario_local_id para que acepte valores nulos
            $table->unsignedBigInteger('usuario_local_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('partido_detalles', function (Blueprint $table) {
            // Revertimos el cambio para que no acepte nulos
            $table->unsignedBigInteger('usuario_local_id')->nullable(false)->change();
        });
    }
}

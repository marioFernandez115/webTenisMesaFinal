<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
{
    Schema::create('partido_usuario', function (Blueprint $table) {
        $table->id();
        $table->foreignId('partido_id')->constrained()->onDelete('cascade');
        $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('partido_usuario');
    }
}

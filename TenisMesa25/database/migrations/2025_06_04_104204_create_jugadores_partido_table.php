<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadoresPartidoTable extends Migration
{
    public function up()
    {
        Schema::create('jugadores_partido', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partido_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jugadores_partido');
    }
}

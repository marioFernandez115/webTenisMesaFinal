<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre de la liga
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ligas');
    }
}

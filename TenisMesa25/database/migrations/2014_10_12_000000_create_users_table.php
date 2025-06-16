<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
   
            $table->id();
            $table->string('nombreyapellidos', 50);
            $table->string('email', 100)->unique();
            $table->string('password'); 
            $table->string('telefono', 10); 
            $table->boolean('activo')->default(1); 
            $table->string('rol')->default('user'); 
            $table->string('equipo')->nullable();
            $table->string('division')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

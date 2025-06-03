<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIdInstalacionNullableOnPartidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partido', function (Blueprint $table) {
            $table->integer('id_instalacion')->nullable()->change(); // Hace que id_instalacion pueda ser null
        });
    }
    
    public function down()
    {
        Schema::table('partido', function (Blueprint $table) {
            $table->integer('id_instalacion')->nullable(false)->change(); // Revertir a no-nullable si se hace rollback
        });
    }
    
}

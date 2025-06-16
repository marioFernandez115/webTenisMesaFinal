<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArbitroToPartidoTable extends Migration
{
    public function up()
    {
    Schema::table('partido', function (Blueprint $table) {
    $table->string('arbitro')->nullable()->after('fecha');
});
    }

    public function down()
    {
        Schema::table('partido', function (Blueprint $table) {
            $table->dropColumn('arbitro');
        });
    }
}


<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposCompletosToPartidosTable extends Migration
{
    public function up()
    {
        Schema::table('partido', function (Blueprint $table) {
            if (!Schema::hasColumn('partido', 'usuario_id')) {
                $table->unsignedBigInteger('usuario_id')->after('id');
                $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('partido', 'jornada')) {
                $table->integer('jornada')->nullable();
            }

            if (!Schema::hasColumn('partido', 'division')) {
                $table->string('division')->nullable();
            }

            if (!Schema::hasColumn('partido', 'equipo')) {
                $table->unsignedTinyInteger('equipo')->nullable();
            }

            if (!Schema::hasColumn('partido', 'resultado')) {
                $table->string('resultado')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('partido', function (Blueprint $table) {
            if (Schema::hasColumn('partido', 'usuario_id')) {
                $table->dropForeign(['usuario_id']);
                $table->dropColumn('usuario_id');
            }
            if (Schema::hasColumn('partido', 'jornada')) {
                $table->dropColumn('jornada');
            }
            if (Schema::hasColumn('partido', 'division')) {
                $table->dropColumn('division');
            }
            if (Schema::hasColumn('partido', 'equipo')) {
                $table->dropColumn('equipo');
            }
            if (Schema::hasColumn('partido', 'resultado')) {
                $table->dropColumn('resultado');
            }
        });
    }
}
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('partido_detalles', function (Blueprint $table) {
            // ❌ NO AÑADIMOS usuario_local_id porque ya existe en la tabla original

            // Añadir el sexto juego si no existe y aún no se añadió como string
            if (!Schema::hasColumn('partido_detalles', 'juego_6')) {
                $table->string('juego_6', 10)->nullable()->after('juego_5');
            }
        });
    }

    public function down(): void
    {
        Schema::table('partido_detalles', function (Blueprint $table) {
            // ✅ No eliminamos usuario_local_id aquí tampoco

            if (Schema::hasColumn('partido_detalles', 'juego_6')) {
                $table->dropColumn('juego_6');
            }
        });
    }
};


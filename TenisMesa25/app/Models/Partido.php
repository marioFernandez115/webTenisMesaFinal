<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $table = 'partido';

    protected $fillable = [
        'usuario_id',
        'nombrePartido',
        'nombre',
        'fecha',
        'jornada',
        'division',
        'equipo',
        'equipo_local',
        'equipo_visitante',
        'arbitro',
        'resultado',
        'estado',
        'tipo_partido',
        'id_liga',
        'id_instalacion',
        'jugadores',
        'jugadores_locales',
        'ganador',
        'resultado_general',
    ];

    protected $casts = [
        'jugadores' => 'array',
        'jugadores_locales' => 'array',
        'fecha' => 'datetime',
    ];

    /**
     * Creador del partido (usuario del sistema).
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Detalles individuales del partido.
     */
    public function detalles()
    {
        return $this->hasMany(PartidoDetalle::class, 'partido_id')->with('usuarioLocal');
    }

    /**
     * Liga relacionada al partido.
     */
    public function liga()
    {
        return $this->belongsTo(Liga::class, 'id_liga')->withDefault(['nombre' => 'No asignada']);
    }

    /**
     * Instalación relacionada al partido.
     */
    public function instalacion()
    {
        return $this->belongsTo(Instalacion::class, 'id_instalacion')->withDefault(['nombre' => 'No asignada']);
    }

    /**
     * (OPCIONAL) Si en un futuro quieres usar la tabla pivot `partido_user`
     */
    public function participantes()
    {
        return $this->belongsToMany(User::class, 'partido_user', 'partido_id', 'user_id')->withTimestamps();
    }
    public function getGanadorAttribute()
    {
        if (empty($this->resultado)) {
            return 'Pendiente';
        }

        $partes = explode('-', $this->resultado);
        if (count($partes) !== 2) {
            return 'Resultado inválido';
        }

        $localScore = (int) trim($partes[0]);
        $visitanteScore = (int) trim($partes[1]);

        $localNombre = $this->equipo_local ?? 'Local';
        $visitanteNombre = $this->equipo_visitante ?? 'Visitante';

        if ($localScore > $visitanteScore) {
            return $localNombre;
        } elseif ($visitanteScore > $localScore) {
            return $visitanteNombre;
        } else {
            return 'Empate';
        }
    }

 public function jugadores()
{
    return $this->belongsToMany(
        User::class,
        'partido_user',   // nombre de la tabla pivote
        'partido_id',     // clave foránea de este modelo en la tabla pivote
        'usuario_id'      // clave foránea del otro modelo en la tabla pivote
    )->withTimestamps();
}
    public function arbitro()
    {
        return $this->belongsTo(User::class, 'arbitro_id');
    }
}

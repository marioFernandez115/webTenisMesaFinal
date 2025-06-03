<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PartidoDetalle;
use App\Models\User;
use App\Models\Liga;
use App\Models\Instalacion;

class Partido extends Model
{
    use HasFactory;

    protected $table = 'partido';
protected $fillable = [
    'usuario_id',
    'nombrePartido',
    'nombre',
    'fecha',
    'id_liga',
    'id_instalacion',
    'jornada',
    'division',
    'equipo',
    'arbitro', // <-- añadido
    'resultado',
    'estado',
    'tipo_partido',
    'jugadores', // almacenado como JSON
    'jugadores_locales', // <-- añadido
    'ganador',
    'resultado_general',
];

protected $casts = [
    'jugadores' => 'array',
    'jugadores_locales' => 'array', // <-- añadido para que se transforme automáticamente
    'fecha' => 'datetime',
];

    /**
     * Usuario que creó el partido.
     */
    public function jugador()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Jugadores participantes del partido (muchos a muchos).
     */
    public function jugadores()
    {
        return $this->belongsToMany(User::class, 'partido_user', 'partido_id', 'user_id')->withTimestamps();
    }

    /**
     * Liga relacionada al partido.
     */
    public function liga()
    {
        return $this->belongsTo(Liga::class, 'id_liga')->withDefault(['nombre' => 'No asignada']);
    }

    /**
     * Instalación donde se juega el partido.
     */
    public function instalacion()
    {
        return $this->belongsTo(Instalacion::class, 'id_instalacion')->withDefault(['nombre' => 'No asignada']);
    }

    /**
     * Detalles individuales del partido.
     * Incluye la relación con el usuario local (jugador local).
     */
    public function detalles()
    {
        return $this->hasMany(PartidoDetalle::class, 'partido_id')->with('usuario_local');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partido;
use App\Models\User;

class PartidoDetalle extends Model
{
    use HasFactory;

    protected $table = 'partido_detalles';

    protected $fillable = [
        'partido_id',
        'usuario_local_id',
        'jugador_local',
        'jugador_visitante',
        'juego_1',
        'juego_2',
        'juego_3',
        'juego_4',
        'juego_5',
        'juego_6',
    ];

    /**
     * Relación: este detalle pertenece a un partido.
     */
    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partido_id');
    }

    /**
     * Relación: jugador local (usuario del sistema).
     */
    public function usuario_local()
    {
        return $this->belongsTo(User::class, 'usuario_local_id');
    }
}

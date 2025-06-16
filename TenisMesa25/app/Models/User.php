<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nombreyapellidos',
        'email',
        'password',
        'telefono',
        'rol',
        'equipo',
        'division'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación muchos a muchos con Partidos
     */
    public function partidos()
{
    return $this->belongsToMany(
        Partido::class,
        'partido_user',
        'usuario_id', // clave foránea de este modelo en la tabla pivote
        'partido_id'  // clave foránea del otro modelo en la tabla pivote
    )->withTimestamps();
}

    /**
     * Nombre legible del equipo
     */
    public function getNombreEquipoAttribute()
    {
        $equipo = (string) $this->equipo;
    
        switch ($equipo) {
            case 'Rivas (Parque Sureste)':
                return 'Rivas (Parque Sureste)';
            case 'Rivas Promesas (Colegio Cigüeñas)':
                return 'Rivas Promesas (Colegio Cigüeñas)';
            default:
                return 'Sin equipo';
        }
    }
}

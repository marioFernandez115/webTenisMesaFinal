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
        'nombre',
        'apellido_1',
        'apellido_2',
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
        return $this->belongsToMany(Partido::class, 'partido_user', 'user_id', 'partido_id')

                    ->withTimestamps();
    }

    /**
     * Nombre legible del equipo
     */
    public function getNombreEquipoAttribute()
    {
        $equipo = (string) $this->equipo;
    
        switch ($equipo) {
            case '1':
                return 'Rivas (Parque Sureste)';
            case '2':
                return 'Rivas Promesas (Colegio Cigüeñas)';
            default:
                return 'Sin equipo';
        }
    }
}

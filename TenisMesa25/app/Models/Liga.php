<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liga extends Model
{
    use HasFactory;

    // Definir la tabla, si es necesario
    protected $table = 'ligas'; // Ajusta este nombre si es diferente en tu base de datos

    // Definir los campos que se pueden llenar
    protected $fillable = [
        'nombre',  // Aquí coloca los campos que tiene la tabla 'ligas'
    ];

    // Relación con el modelo Partido
    public function partidos()
    {
        return $this->hasMany(Partido::class, 'id_liga');
    }
}
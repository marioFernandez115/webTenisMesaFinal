<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PartidoDetalle;

class PartidoDetalleController extends Controller
{
    /**
     * Middleware para proteger rutas, si necesitas que solo ciertos roles puedan editar.
     * Puedes ajustarlo o eliminarlo según tus permisos.
     */
    public function __construct()
    {
        $this->middleware('auth');
               // Solo mantenimiento y capitan pueden actualizar detalles
        $this->middleware('role:mantenimiento,capitan')->only('update');
    }

    /**
     * Actualiza los juegos (sets) de un detalle de partido específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID del detalle del partido
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validar entrada: los juegos pueden ser números o string con puntuaciones, ajustar reglas si quieres
     $validatedData = $request->validate([
    'juego_1' => 'nullable|string|max:10',
    'juego_2' => 'nullable|string|max:10',
    'juego_3' => 'nullable|string|max:10',
    'juego_4' => 'nullable|string|max:10',
    'juego_5' => 'nullable|string|max:10',
    'juego_6' => 'nullable|string|max:10',
], [
    '*.string' => 'Cada juego debe ser una cadena de texto.',
]);

        // Buscar el detalle del partido
        $detalle = PartidoDetalle::findOrFail($id);

        // Asignar los valores validados a los campos correspondientes
        for ($i = 1; $i <= 6; $i++) {
            $campo = 'juego_' . $i;
            if (array_key_exists($campo, $validatedData)) {
                $detalle->{$campo} = $validatedData[$campo];
            }
        }

        // Guardar los cambios
        $detalle->save();

        // Redirigir de vuelta a la vista del partido con un mensaje de éxito
        // Asumiendo que el detalle tiene relación con el partido:
        return redirect()
            ->route('partidos.show', $detalle->partido_id)
            ->with('success', 'Sets actualizados correctamente.');
    }
}

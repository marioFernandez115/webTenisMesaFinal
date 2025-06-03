<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\PartidoDetalle;
use App\Models\User;
use App\Models\Liga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartidoController extends Controller
{
    public function index()
    {
        $partidos = Partido::with('liga', 'jugadores')->latest()->paginate(10);
        return view('partidos.index', [
            'partidos' => $partidos,
            'usuarios' => User::all(),
            'ligas' => Liga::all()
        ]);
    }

    public function create()
    {
        $acta = array_fill(0, 6, [
            'usuario_local_id' => null,
            'jugador_visitante' => null,
            'juego_1' => null,
            'juego_2' => null,
            'juego_3' => null,
            'juego_4' => null,
            'juego_5' => null,
            'juego_6' => null,
        ]);

        return view('partidos.create', [
            'usuarios' => User::all(),
            'ligas' => Liga::all(),
            'jornadas' => range(1, 22),
            'acta' => $acta
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombrePartido' => 'required|string|max:50',
            'nombre' => 'required|string|max:50',
            'jornada' => 'required|integer|min:1|max:22',
            'division' => 'required|string',
            'equipo' => 'required|integer',
            'fecha' => 'required|date',
            'resultado' => 'required|string|max:255',
            'jugadores_locales' => 'nullable|array|max:3',
            'jugadores_locales.*' => 'nullable|exists:users,id',
            'detalles' => 'nullable|array',
            'detalles.*.usuario_local_id' => 'nullable|exists:users,id',
            'detalles.*.jugador_visitante' => 'nullable|string|max:255',
            'detalles.*.juego_1' => 'nullable|string|max:10',
            'detalles.*.juego_2' => 'nullable|string|max:10',
            'detalles.*.juego_3' => 'nullable|string|max:10',
            'detalles.*.juego_4' => 'nullable|string|max:10',
            'detalles.*.juego_5' => 'nullable|string|max:10',
            'detalles.*.juego_6' => 'nullable|string|max:10',
        ]);

        $partido = Partido::create([
            'nombrePartido' => $validated['nombrePartido'],
            'nombre' => $validated['nombre'],
            'jornada' => $validated['jornada'],
            'division' => $validated['division'],
            'equipo' => $validated['equipo'],
            'fecha' => $validated['fecha'],
            'resultado' => $validated['resultado'],
            'usuario_id' => Auth::id(),
            'id_liga' => $request->id_liga ?? null,
            'id_instalacion' => $request->id_instalacion ?? null,
        ]);

        if (!empty($validated['jugadores_locales'])) {
            $partido->jugadores()->sync(array_filter($validated['jugadores_locales']));
        }

        if (!empty($validated['detalles'])) {
            foreach ($validated['detalles'] as $detalle) {
                $usuarioLocalId = $detalle['usuario_local_id'] ?? null;

                // Solo crear detalle si hay usuario_local_id válido o jugador visitante no vacío
                if ((!is_null($usuarioLocalId) && User::find($usuarioLocalId)) || !empty($detalle['jugador_visitante'])) {
                    if (!is_null($usuarioLocalId) && User::find($usuarioLocalId)) {
                        $detalle['jugador_local'] = User::find($usuarioLocalId)->name;
                        $detalle['usuario_local_id'] = $usuarioLocalId;
                    } else {
                        // En caso no haya usuario_local_id válido, poner null explícito para evitar error
                        $detalle['usuario_local_id'] = null;
                        $detalle['jugador_local'] = null;
                    }

                    $partido->detalles()->create($detalle);
                }
            }
        }

        return redirect()->route('partidos.index')->with('success', 'Partido creado correctamente.');
    }
    public function show($id)
    {
        $partido = Partido::with(['detalles.usuario_local'])->findOrFail($id);
        return view('partidos.show', compact('partido'));
    }

    public function edit($id)
    {
        $partido = Partido::with('jugadores', 'detalles')->findOrFail($id);
        return view('partidos.edit', [
            'partido' => $partido,
            'usuarios' => User::all(),
            'ligas' => Liga::all(),
            'jornadas' => range(1, 22),
        ]);
    }

     public function update(Request $request, Partido $partido)
    {
        $validated = $request->validate([
            'nombrePartido' => 'required|string|max:50',
            'nombre' => 'required|string|max:255',
            'jornada' => 'required|integer|min:1|max:22',
            'fecha' => 'required|date',
            'division' => 'required|string',
            'equipo' => 'required|integer',
            'resultado' => 'required|string',
            'jugadores' => 'nullable|array|max:8',
            'jugadores.*' => 'nullable|exists:users,id',
            'detalles' => 'nullable|array',
            'detalles.*.id' => 'nullable|integer|exists:partido_detalles,id',
            'detalles.*.usuario_local_id' => 'nullable|exists:users,id',
            'detalles.*.jugador_visitante' => 'nullable|string|max:255',
            'detalles.*.juego_1' => 'nullable|string|max:10',
            'detalles.*.juego_2' => 'nullable|string|max:10',
            'detalles.*.juego_3' => 'nullable|string|max:10',
            'detalles.*.juego_4' => 'nullable|string|max:10',
            'detalles.*.juego_5' => 'nullable|string|max:10',
            'detalles.*.juego_6' => 'nullable|string|max:10',
        ]);

        $partido->update([
            'nombrePartido' => $validated['nombrePartido'],
            'nombre' => $validated['nombre'],
            'jornada' => $validated['jornada'],
            'division' => $validated['division'],
            'equipo' => $validated['equipo'],
            'fecha' => $validated['fecha'],
            'resultado' => $validated['resultado'],
            'id_liga' => $request->id_liga ?? $partido->id_liga,
        ]);

        if (!empty($validated['jugadores'])) {
            $partido->jugadores()->sync(array_filter($validated['jugadores']));
        }

        if (!empty($validated['detalles'])) {
            foreach ($validated['detalles'] as $detalle) {
                $usuarioLocalId = $detalle['usuario_local_id'] ?? null;

                if (!empty($detalle['id'])) {
                    $detalleExistente = PartidoDetalle::find($detalle['id']);
                    if ($detalleExistente) {
                        if (!is_null($usuarioLocalId) && User::find($usuarioLocalId)) {
                            $detalle['jugador_local'] = User::find($usuarioLocalId)->name;
                            $detalle['usuario_local_id'] = $usuarioLocalId;
                            $detalleExistente->update($detalle);
                        }
                    }
                } else {
                    // Crear nuevo detalle solo si usuario_local_id válido o jugador visitante no vacío
                    if ((!is_null($usuarioLocalId) && User::find($usuarioLocalId)) || !empty($detalle['jugador_visitante'])) {
                        if (!is_null($usuarioLocalId) && User::find($usuarioLocalId)) {
                            $detalle['jugador_local'] = User::find($usuarioLocalId)->name;
                            $detalle['usuario_local_id'] = $usuarioLocalId;
                        } else {
                            $detalle['usuario_local_id'] = null;
                            $detalle['jugador_local'] = null;
                        }
                        $partido->detalles()->create($detalle);
                    }
                }
            }
        }

        return redirect()->route('partidos.index')->with('success', 'Partido actualizado correctamente');
    }

    public function destroy($id)
    {
        $partido = Partido::findOrFail($id);
        $partido->detalles()->delete();
        $partido->delete();

        return redirect()->route('partidos.index')->with('success', 'Partido eliminado correctamente');
    }
}

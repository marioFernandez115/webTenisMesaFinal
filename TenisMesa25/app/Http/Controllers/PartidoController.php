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
        $partidos = Partido::with('liga', 'jugadores')->orderBy('fecha', 'desc')->paginate(10);

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
            'equipo_local' => 'required|string|max:100',
            'equipo_visitante' => 'required|string|max:100',
            'jornada' => 'required|integer|min:1|max:22',
            'division' => 'required|string',
            'estado' => 'required|in:local,visitante',
            'fecha' => 'required|date',
            'arbitro' => 'nullable|string|max:255',
            'resultado' => 'required|string|max:255',
            'detalles' => 'required|array|size:6',
            'detalles.*.usuario_local_id' => 'required|exists:users,id',
            'detalles.*.jugador_visitante' => 'nullable|string|max:255',
            'detalles.*.juego_1' => 'nullable|string|max:10|regex:/^\d{1,2}-\d{1,2}$/',
            'detalles.*.juego_2' => 'nullable|string|max:10|regex:/^\d{1,2}-\d{1,2}$/',
            'detalles.*.juego_3' => 'nullable|string|max:10|regex:/^\d{1,2}-\d{1,2}$/',
            'detalles.*.juego_4' => 'nullable|string|max:10|regex:/^\d{1,2}-\d{1,2}$/',
            'detalles.*.juego_5' => 'nullable|string|max:10|regex:/^\d{1,2}-\d{1,2}$/',
            'detalles.*.juego_6' => 'nullable|string|max:10|regex:/^\d{1,2}-\d{1,2}$/',
        ]);
        $nombrePartido = $validated['nombrePartido'];

        $ganador = $validated['estado'] === 'local' ? $validated['equipo_local'] : $validated['equipo_visitante'];

        $partido = Partido::create([
            'nombrePartido' => $validated['nombrePartido'],
            'equipo_local' => $validated['equipo_local'],
            'equipo_visitante' => $validated['equipo_visitante'],
            'jornada' => $validated['jornada'],
            'division' => $validated['division'],
            'estado' => $validated['estado'],
            'fecha' => $validated['fecha'],
            'arbitro' => $validated['arbitro'] ?? null,
            'resultado' => $validated['resultado'],
            'usuario_id' => Auth::id(),
            'ganador' => $ganador,
            'id_liga' => $request->id_liga ?? null,
            'id_instalacion' => $request->id_instalacion ?? null,
        ]);

        // jugadores (opcional, puedes eliminar si no usas este campo)
        // if (!empty($validated['usuario_local_id'])) {
        //     $partido->jugadores()->sync(array_filter($validated['usuario_local_id']));
        // }

        // detalles
        if (!empty($validated['detalles'])) {
            foreach ($validated['detalles'] as $detalle) {
                $usuarioLocalId = $detalle['usuario_local_id'] ?? null;

                if ((!is_null($usuarioLocalId) && User::find($usuarioLocalId)) || !empty($detalle['jugador_visitante'])) {
                    if (!is_null($usuarioLocalId)) {
                        $detalle['jugador_local'] = User::find($usuarioLocalId)->nombreyapellidos;
                        $detalle['usuario_local_id'] = $usuarioLocalId;
                    } else {
                        $detalle['usuario_local_id'] = null;
                        $detalle['jugador_local'] = null;
                    }

                    $partido->detalles()->create($detalle);
                }
            }
        }

        return redirect()->route('partidos.index')->with('success', 'Partido creado correctamente.');
    }

    private function obtenerNombreLocal($nombrePartido, $nombreVisitante)
    {
        $pattern = '/\s*-\s*' . preg_quote($nombreVisitante, '/') . '/i';
        $nombreLocal = preg_replace($pattern, '', $nombrePartido);
        return $nombreLocal ?: 'Equipo Local';
    }

    public function show($id)
    {
        $partido = Partido::with(['detalles.usuarioLocal'])->findOrFail($id);
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
            'jornada' => 'required|integer|min:1|max:22',
            'fecha' => 'required|date',
            'division' => 'required|string',
            'equipo_local' => 'required|string|max:100',
            'equipo_visitante' => 'required|string|max:100',
            'estado' => 'required|in:local,visitante',
            'resultado' => 'required|string',
            'arbitro' => 'nullable|string|max:255',
            'jugadores' => 'nullable|array|max:8',
            'jugadores.*' => 'nullable|exists:users,id',
            'detalles' => 'required|array|size:6',
            'detalles.*.id' => 'nullable|integer|exists:partido_detalles,id',
            'detalles.*.usuario_local_id' => 'required|exists:users,id',
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
            'jornada' => $validated['jornada'],
            'division' => $validated['division'],
            'equipo_local' => $validated['equipo_local'],
            'equipo_visitante' => $validated['equipo_visitante'],
            'estado' => $validated['estado'],
            'fecha' => $validated['fecha'],
            'resultado' => $validated['resultado'],
            'arbitro' => $validated['arbitro'] ?? $partido->arbitro,
            'id_liga' => $request->id_liga ?? $partido->id_liga,
        ]);

        if (!empty($validated['jugadores'])) {
            $partido->jugadores()->sync(array_filter($validated['jugadores']));
        }

        // Actualizar detalles del partido
        if (!empty($validated['detalles'])) {
            foreach ($validated['detalles'] as $detalle) {
                if (!empty($detalle['id'])) {
                    $detalleExistente = \App\Models\PartidoDetalle::find($detalle['id']);
                    if ($detalleExistente) {
                        $detalleExistente->update([
                            'usuario_local_id' => $detalle['usuario_local_id'] ?? null,
                            'jugador_local' => isset($detalle['usuario_local_id']) && $detalle['usuario_local_id'] ? \App\Models\User::find($detalle['usuario_local_id'])->nombreyapellidos : null,
                            'jugador_visitante' => $detalle['jugador_visitante'] ?? null,
                            'juego_1' => $detalle['juego_1'] ?? null,
                            'juego_2' => $detalle['juego_2'] ?? null,
                            'juego_3' => $detalle['juego_3'] ?? null,
                            'juego_4' => $detalle['juego_4'] ?? null,
                            'juego_5' => $detalle['juego_5'] ?? null,
                            'juego_6' => $detalle['juego_6'] ?? null,
                        ]);
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
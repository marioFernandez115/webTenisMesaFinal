<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Partido;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
    
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }
    
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
    
        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }
    
        if ($request->filled('division')) {
            $query->where('division', $request->division);
        }

        $usuarios = $query->orderBy('id', 'desc')
            ->paginate($request->get('per_page', 20))
            ->appends($request->except('page'));

        return view('crud.listUser', compact('usuarios'));
    }

    public function create()
    {
        return view('crud.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_1' => 'required|string|max:255',
            'apellido_2' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|in:usuario,mantenimiento,admin_noticias,capitan',
            'equipo' => 'required|in:1,2',
            'division' => 'string',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'apellido_1' => $request->apellido_1,
            'apellido_2' => $request->apellido_2,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => $request->rol,
            'equipo' => $request->equipo,
            'division' => $request->division,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $btnText = 'Actualizar';  
        return view('crud.edit', compact('usuario', 'btnText'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_1' => 'required|string|max:255',
            'apellido_2' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users,email,' . $id,
            'rol' => 'required|in:usuario,mantenimiento,admin_noticias,capitan',
            'equipo' => 'string',
            'division' => 'string',
        ]);
    
        $usuario = User::findOrFail($id);
    
        $usuario->update([
            'nombre' => $request->nombre,
            'apellido_1' => $request->apellido_1,
            'apellido_2' => $request->apellido_2,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'rol' => $request->rol,
            'equipo' => $request->equipo,
            'division' => $request->division,
        ]);
    
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }
    
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }

    // ✅ Actualizado: Mostrar perfil del usuario con historial de partidos
    public function show($id)
    {
        $usuario = User::findOrFail($id);

        // Obtener solo los partidos donde ha participado este usuario
        $partidos = Partido::whereHas('jugadores', function ($query) use ($usuario) {
            $query->where('user_id', $usuario->id);
        })
        ->with('jugadores', 'liga')
        ->orderByDesc('fecha')
        ->get();

        return view('crud.show', compact('usuario', 'partidos'));
    }

    // Puedes eliminar esta función si ya no la usas
    public function historialJornadas($id)
    {
        // Mantenida por si tienes otras rutas que la utilizan
        $usuario = User::findOrFail($id);

        $partidos = Partido::whereHas('jugadores', function ($query) use ($usuario) {
            $query->where('user_id', $usuario->id);
        })->with('jugadores', 'liga')->get();

        $jornadas = [];

        foreach ($partidos as $partido) {
            foreach ($partido->jugadores as $jugador) {
                if ($jugador->id == $usuario->id) {
                    $jornadas_jugadas_casa = $partido->tipo_partido == 'casa' ? 1 : 0;
                    $jornadas_jugadas_fuera = $partido->tipo_partido == 'fuera' ? 1 : 0;

                    if (!isset($jornadas[$usuario->id])) {
                        $jornadas[$usuario->id] = [
                            'jugador' => $usuario,
                            'division' => $usuario->division,
                            'jornadas_jugadas_casa' => $jornadas_jugadas_casa,
                            'jornadas_jugadas_fuera' => $jornadas_jugadas_fuera,
                            'total' => $jornadas_jugadas_casa + $jornadas_jugadas_fuera,
                            'jornadas' => [],
                        ];
                    }

                    $jornadas[$usuario->id]['jornadas'][] = $partido->jornada;
                }
            }
        }

        return view('jornadas', compact('usuario', 'jornadas'));
    }
}

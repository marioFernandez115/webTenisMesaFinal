<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Partido;
use App\Models\Noticia;
use App\Models\Evento;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
   $query = User::query();

    // Filtro por nombre y apellidos
    if ($request->filled('nombreyapellidos')) {
        $query->where('nombreyapellidos', 'like', '%' . $request->nombreyapellidos . '%');
    }

    // Filtro por email
    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    // Filtro por rol
    if ($request->filled('rol')) {
        $query->where('rol', $request->rol);
    }

    // Filtro por división
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
    $request->merge([
        'equipo' => trim($request->equipo),
    ]);

    $request->validate([
        'nombreyapellidos' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:15',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'rol' => 'required|in:usuario,mantenimiento,admin_noticias,capitan',
        'equipo' => 'required|in:Rivas (Parque Sureste),Rivas Promesas (Colegio Cigüeñas)',
        'division' => 'string',
    ]);

    User::create([
        'nombreyapellidos' => $request->nombreyapellidos,
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
    $request->merge([
        'equipo' => trim($request->equipo),
    ]);

    $request->validate([
        'nombreyapellidos' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:15',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|confirmed',
        'rol' => 'required|in:usuario,mantenimiento,admin_noticias,capitan',
        'equipo' => 'required|in:Rivas (Parque Sureste),Rivas Promesas (Colegio Cigüeñas)',
        'division' => 'string',
    ]);

    $usuario = User::findOrFail($id);

    $data = [
        'nombreyapellidos' => $request->nombreyapellidos,
        'telefono' => $request->telefono,
        'email' => $request->email,
        'rol' => $request->rol,
        'equipo' => $request->equipo,
        'division' => $request->division,
    ];

    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $usuario->update($data);

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
        $query->where('usuario_id', $usuario->id);
    })
    ->with('jugadores', 'liga')
    ->orderByDesc('fecha')
    ->get();

    return view('crud.show', compact('usuario', 'partidos'));
}

    // Puedes eliminar esta función si ya no la usas
    public function historialJornadas($id)
    {
        $usuario = User::findOrFail($id);

    $partidos = Partido::whereHas('jugadores', function ($query) use ($usuario) {
        $query->where('usuario_id', $usuario->id);
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
public function noticiasIndex()
{
    $noticias = Noticia::orderBy('fecha', 'desc')->paginate(10);
    return view('events.noticias', compact('noticias'));
}
public function noticiaStore(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'fecha' => 'required|date',
        'imagen' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['titulo', 'descripcion', 'fecha']);

    if ($request->hasFile('imagen')) {
        $data['imagen'] = $request->file('imagen')->store('noticias', 'public');
    }

    Noticia::create($data);
    return redirect()->route('admin.noticias')->with('success', 'Noticia creada correctamente.');
}

public function noticiaDestroy($id)
{
    $noticia = Noticia::findOrFail($id);
    // Elimina la imagen del almacenamiento si existe
    if ($noticia->imagen) {
        \Storage::disk('public')->delete($noticia->imagen);
    }
    $noticia->delete();
    return redirect()->route('admin.noticias')->with('success', 'Noticia eliminada correctamente.');
}
public function noticiaCreate()
{
    return view('events.noticia_create');
}

// Gestión de Eventos
public function eventosIndex()
{
    $eventos = Evento::orderBy('fecha', 'desc')->paginate(10);
    return view('events.eventos', compact('eventos'));
}

public function eventoCreate()
{
    return view('events.evento_create');
}

public function eventoStore(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'fecha' => 'required|date',
        'imagen' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['titulo', 'descripcion', 'fecha']);

    if ($request->hasFile('imagen')) {
        $data['imagen'] = $request->file('imagen')->store('eventos', 'public');
    }

    Evento::create($data);
    return redirect()->route('admin.eventos')->with('success', 'Evento creado correctamente.');
}

public function eventoDestroy($id)
{
    $evento = Evento::findOrFail($id);
    // Elimina la imagen del almacenamiento si existe
    if ($evento->imagen) {
        \Storage::disk('public')->delete($evento->imagen);
    }
    $evento->delete();
    return redirect()->route('admin.eventos')->with('success', 'Evento eliminado correctamente.');
}
public function noticiaShow($id)
{
    $noticia = Noticia::findOrFail($id);
    return view('events.noticia_show', compact('noticia'));
}
public function noticiaEdit($id)
{
    $noticia = Noticia::findOrFail($id);
    return view('events.noticia_edit', compact('noticia'));
}
public function noticiaUpdate(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'fecha' => 'required|date',
        'imagen' => 'nullable|image|max:2048',
    ]);

    $noticia = Noticia::findOrFail($id);
    $data = $request->only(['titulo', 'descripcion', 'fecha']);

    if ($request->hasFile('imagen')) {
        // Elimina la imagen anterior si existe
        if ($noticia->imagen) {
            \Storage::disk('public')->delete($noticia->imagen);
        }
        $data['imagen'] = $request->file('imagen')->store('noticias', 'public');
    }

    $noticia->update($data);
    return redirect()->route('admin.noticias')->with('success', 'Noticia actualizada correctamente.');
}
// Mostrar un evento
public function eventoShow($id)
{
    $evento = Evento::findOrFail($id);
    return view('events.evento_show', compact('evento'));
}

// Editar un evento
public function eventoEdit($id)
{
    $evento = Evento::findOrFail($id);
    return view('events.evento_edit', compact('evento'));
} 
public function eventoUpdate(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'fecha' => 'required|date',
        'imagen' => 'nullable|image|max:2048',
    ]);

    $evento = Evento::findOrFail($id);
    $data = $request->only(['titulo', 'descripcion', 'fecha']);

    if ($request->hasFile('imagen')) {
        // Elimina la imagen anterior si existe
        if ($evento->imagen) {
            \Storage::disk('public')->delete($evento->imagen);
        }
        $data['imagen'] = $request->file('imagen')->store('eventos', 'public');
    }

    $evento->update($data);
    return redirect()->route('admin.eventos')->with('success', 'Evento actualizado correctamente.');
}
}

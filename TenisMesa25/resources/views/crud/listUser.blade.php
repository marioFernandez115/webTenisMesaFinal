@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-success mb-3">Nuevo Usuario</a>

    {{-- Formulario de búsqueda --}}
    <form method="GET" action="{{ route('usuarios.index') }}" class="row mb-4 g-2">
        <div class="col-md-3">
            <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
        </div>
        <div class="col-md-3">
            <input type="email" name="email" class="form-control" placeholder="Buscar por email" value="{{ request('email') }}">
        </div>
        <div class="col-md-2">
            <select name="rol" class="form-select">
                <option value="">-- Rol --</option>
                <option value="usuario" {{ request('rol') == 'usuario' ? 'selected' : '' }}>Usuario</option>
                <option value="mantenimiento" {{ request('rol') == 'mantenimiento' ? 'selected' : '' }}>Administrador</option>
                <option value="admin_noticias" {{ request('rol') == 'admin_noticias' ? 'selected' : '' }}>Admin Noticias</option>
                <option value="capitan" {{ request('rol') == 'capitan' ? 'selected' : '' }}>Capitán</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="division" class="form-select">
                <option value="">-- División --</option>
                <option value="Superdivisión (Femenina)" {{ request('division') == 'Superdivisión (Femenina)' ? 'selected' : '' }}>Superdivisión (Femenina)</option>
                <option value="Superdivisión (Masculina)" {{ request('division') == 'Superdivisión (Masculina)' ? 'selected' : '' }}>Superdivisión (Masculina)</option>
                <option value="División de Honor (Femenina)" {{ request('division') == 'División de Honor (Femenina)' ? 'selected' : '' }}>División de Honor (Femenina)</option>
                <option value="División de Honor (Masculina)" {{ request('division') == 'División de Honor (Masculina)' ? 'selected' : '' }}>División de Honor (Masculina)</option>
                <option value="Primera División (Femenina)" {{ request('division') == 'Primera División (Femenina)' ? 'selected' : '' }}>Primera División (Femenina)</option>
                <option value="Primera División (Masculina)" {{ request('division') == 'Primera División (Masculina)' ? 'selected' : '' }}>Primera División (Masculina)</option>
                <option value="Segunda División (Femenina)" {{ request('division') == 'Segunda División (Femenina)' ? 'selected' : '' }}>Segunda División (Femenina)</option>
                <option value="Segunda División (Masculina)" {{ request('division') == 'Segunda División (Masculina)' ? 'selected' : '' }}>Segunda División (Masculina)</option>
                <option value="Territorial 1ª (T1)" {{ request('division') == 'Territorial 1ª (T1)' ? 'selected' : '' }}>Territorial 1ª (T1)</option>
                <option value="Territorial 2ª (T2)" {{ request('division') == 'Territorial 2ª (T2)' ? 'selected' : '' }}>Territorial 2ª (T2)</option>
                <option value="Territorial 3ª (T3)" {{ request('division') == 'Territorial 3ª (T3)' ? 'selected' : '' }}>Territorial 3ª (T3)</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </div>
    </form>

    {{-- Tabla de usuarios --}}
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th>División</th>
                <th>Equipo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nombre ?? $usuario->name }}</td>
                    <td>{{ $usuario->apellido_1 }}</td>
                    <td>{{ $usuario->apellido_2 }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->rol }}</td>
                    <td>{{ $usuario->division }}</td>
                    <td>{{ $usuario->equipo }}</td>
                    <td>{{ $usuario->telefono }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('usuarios.show', ['id' => $usuario->id]) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('usuarios.edit', ['id' => $usuario->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('usuarios.destroy', ['id' => $usuario->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro que quieres eliminar este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} resultados
        </div>
        <div>
            {{ $usuarios->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-people-fill me-2"></i>Lista de Usuarios</h2>
        <a href="{{ route('usuarios.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Nuevo Usuario
        </a>
    </div>

    {{-- Formulario de búsqueda --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('usuarios.index') }}" class="row g-3">
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
                        <option value="admin_events" {{ request('rol') == 'admin_events' ? 'selected' : '' }}>Administrador Eventos y Noticias</option>
                        <option value="capitan" {{ request('rol') == 'capitan' ? 'selected' : '' }}>Capitán</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="division" class="form-select">
                        <option value="">-- División --</option>
                        @php
                            $divisiones = [
                                "Superdivisión (Femenina)", "Superdivisión (Masculina)",
                                "División de Honor (Femenina)", "División de Honor (Masculina)",
                                "Primera División (Femenina)", "Primera División (Masculina)",
                                "Segunda División (Femenina)", "Segunda División (Masculina)",
                                "Territorial 1ª (T1)", "Territorial 2ª (T2)", "Territorial 3ª (T3)"
                            ];
                        @endphp
                        @foreach($divisiones as $div)
                            <option value="{{ $div }}" {{ request('division') == $div ? 'selected' : '' }}>{{ $div }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabla de usuarios --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nombre y Apellidos</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>División</th>
                            <th>Equipo</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle text-center">
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->nombreyapellidos ?? $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td><span class="badge bg-info text-dark">{{ ucfirst($usuario->rol) }}</span></td>
                                <td>{{ $usuario->division ?? '-' }}</td>
                                <td>{{ $usuario->equipo ?? '-' }}</td>
                                <td>{{ $usuario->telefono ?? '-' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que quieres eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-between align-items-center mt-4">
        <small class="text-muted">
            Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} usuarios
        </small>
        <div>
            {{ $usuarios->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection

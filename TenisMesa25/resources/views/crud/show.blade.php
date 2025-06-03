@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Datos del Usuario</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered mb-0">
                <tr>
                    <th>ID</th>
                    <td>{{ $usuario->id }}</td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td>{{ $usuario->nombre }}</td>
                </tr>
                <tr>
                    <th>Primer Apellido</th>
                    <td>{{ $usuario->apellido_1 }}</td>
                </tr>
                <tr>
                    <th>Segundo Apellido</th>
                    <td>{{ $usuario->apellido_2 }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $usuario->email }}</td>
                </tr>
                <tr>
                    <th>Teléfono</th>
                    <td>{{ $usuario->telefono ?? 'No especificado' }}</td>
                </tr>
                <tr>
                    <th>Activo</th>
                    <td>
                        @if ($usuario->activo)
                            <span class="badge bg-success">Sí</span>
                        @else
                            <span class="badge bg-danger">No</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Rol</th>
                    <td><span class="badge bg-info text-dark">{{ ucfirst($usuario->rol) }}</span></td>
                </tr>
                <tr>
                    <th>Equipo</th>
                    <td>{{ $usuario->equipo ?? 'No asignado' }}</td>
                </tr>
                <tr>
                    <th>División</th>
                    <td>{{ $usuario->division ?? 'No asignada' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Historial de Partidos</h5>
            <span class="badge bg-light text-dark">Total: {{ $partidos->count() }} partidos</span>
        </div>
        <div class="card-body">
            @if($partidos->isEmpty())
                <div class="alert alert-info">No hay partidos registrados para este jugador.</div>
            @else
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Jornada</th>
                            <th>División</th>
                            <th>Equipo</th>
                            <th>Resultado</th>
                            <th>Liga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partidos as $partido)
                            <tr>
                                <td>{{ $partido->nombre }}</td>
                                <td>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $partido->jornada ?? '-' }}</td>
                                <td>{{ $partido->division ?? '-' }}</td>
                                <td>
                                    @if($partido->equipo == 1)
                                        Rivas (Parque Sureste)
                                    @elseif($partido->equipo == 2)
                                        Rivas Promesas (Colegio Cigüeñas)
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $partido->resultado ?? '-' }}</td>
                                <td>{{ $partido->liga->nombre ?? 'No asignada' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection

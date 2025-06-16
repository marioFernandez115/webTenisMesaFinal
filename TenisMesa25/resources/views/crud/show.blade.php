@extends('layouts.app')

@section('content')
<div class="container">
   <div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i>Datos del Usuario</h4>
    </div>
    <div class="card-body px-4">
        <div class="row g-3">
            <div class="col-md-6">
                <strong>ID:</strong>
                <div class="form-control-plaintext">{{ $usuario->id }}</div>
            </div>
            <div class="col-md-6">
                <strong>Nombre y Apellidos:</strong>
                <div class="form-control-plaintext">{{ $usuario->nombreyapellidos }}</div>
            </div>
           
            <div class="col-md-6">
                <strong>Email:</strong>
                <div class="form-control-plaintext">{{ $usuario->email }}</div>
            </div>
            <div class="col-md-6">
                <strong>Teléfono:</strong>
                <div class="form-control-plaintext">{{ $usuario->telefono ?? 'No especificado' }}</div>
            </div>
            <div class="col-md-6">
                <strong>Activo:</strong>
                <div>
                    @if ($usuario->activo)
                        <span class="badge bg-success">Sí</span>
                    @else
                        <span class="badge bg-danger">No</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <strong>Rol:</strong>
                <div><span class="badge bg-info text-dark">{{ ucfirst($usuario->rol) }}</span></div>
            </div>
            <div class="col-md-6">
                <strong>Equipo:</strong>
                <div class="form-control-plaintext">{{ $usuario->equipo ?? 'No asignado' }}</div>
            </div>
            <div class="col-md-6">
                <strong>División:</strong>
                <div class="form-control-plaintext">{{ $usuario->division ?? 'No asignada' }}</div>
            </div>
        </div>
    </div>
</div>
   <div class="card shadow-sm">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Historial de Partidos</h5>
        <span class="badge bg-light text-dark">Total: {{ $partidos->count() }} partidos</span>
    </div>
    <div class="card-body">
        @if($partidos->isEmpty())
            <div class="alert alert-info text-center">No hay partidos registrados para este jugador.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle table-striped table-hover">
                    <thead class="table-dark text-center">
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
                    <tbody class="text-center">
                        @foreach($partidos as $partido)
                            <tr>
                                <td>{{ $partido->nombre }}</td>
                                <td>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $partido->jornada ?? '-' }}</td>
                                <td>{{ $partido->division ?? '-' }}</td>
                                <td>
                                    @switch($partido->equipo)
                                        @case("Rivas (Parque Sureste)")
                                            Rivas (Parque Sureste)
                                            @break
                                        @case("Rivas Promesas (Colegio Cigüeñas)")
                                            Rivas Promesas (Colegio Cigüeñas)
                                            @break
                                        @default
                                            -
                                    @endswitch
                                </td>
                                <td>{{ $partido->resultado ?? '-' }}</td>
                                <td>{{ $partido->liga->nombre ?? 'No asignada' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

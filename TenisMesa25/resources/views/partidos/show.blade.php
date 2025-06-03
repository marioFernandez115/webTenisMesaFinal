@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm rounded mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start border-bottom pb-2 mb-3">
                <div>
                    <h1 class="h4 fw-semibold">Acta del Partido</h1>
                    <p class="text-muted mb-0">
                        Temporada: {{ date('Y') }}/{{ date('Y')+1 }} | Jornada: {{ $partido->jornada }}
                    </p>
                </div>
                <div class="text-end">
                    <p class="mb-1 text-muted">Categoría: <strong>División {{ $partido->division }}</strong></p>
                    <p class="mb-0 text-muted">Fecha: <strong>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</strong></p>
                </div>
            </div>

            {{-- Información de los equipos --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Local:</strong> {{ $partido->equipo }}</p>
                    <p><strong>Árbitro:</strong> <span class="text-danger fw-bold">{{ $partido->arbitro ?? 'Sin asignar' }}</span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Visitante:</strong> {{ $partido->nombre }}</p>

                </div>
            </div>

            {{-- Tabla de enfrentamientos --}}
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Letra Local</th>
                            <th>Jugador Local</th>
                            <th>Jugador Visitante</th>
                            <th>Letra Visitante</th>
                            <th>Juego 1</th>
                            <th>Juego 2</th>
                            <th>Juego 3</th>
                            <th>Juego 4</th>
                            <th>Juego 5</th>
                            <th>Juego 6</th>
                            @can('edit-acta')
                                <th>Acción</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $orden_locales = ['A', 'B', 'C', 'A', 'C', 'B'];
                            $orden_visitantes = ['Y', 'X', 'Z', 'X', 'Y', 'Z'];
                        @endphp

                        @foreach ($partido->detalles as $index => $detalle)
                            <tr>
                                {{-- Letra Local --}}
                                <td>{{ $orden_locales[$index] }}</td>

                                {{-- Jugador Local --}}
                                <td>{{ $detalle->usuario_local->name ?? 'Jugador no encontrado' }}</td>

                                {{-- Jugador Visitante --}}
                                <td>{{ $detalle->jugador_visitante }}</td>

                                {{-- Letra Visitante --}}
                                <td>{{ $orden_visitantes[$index] }}</td>

                                {{-- Formulario para juegos --}}
                                @can('edit-acta')
                                    <form action="{{ route('detalles.update', $detalle->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @for ($i = 1; $i <= 6; $i++)
                                            <td>
                                                <input type="text" name="juego_{{ $i }}" value="{{ $detalle->{'juego_'.$i} }}" class="form-control form-control-sm text-center" />
                                            </td>
                                        @endfor
                                        <td>
                                            <button class="btn btn-sm btn-primary">Guardar</button>
                                        </td>
                                    </form>
                                @else
                                    @for ($i = 1; $i <= 6; $i++)
                                        <td>{{ $detalle->{'juego_'.$i} ?? '-' }}</td>
                                    @endfor
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Resultado Final --}}
            <div class="text-center mt-4">
                <p class="h5 fw-bold text-dark">Ganador: {{ $partido->ganador ?? 'Pendiente' }}</p>
                <p class="h6 text-secondary">Resultado General: {{ $partido->resultado_general ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Botones de acción --}}
    <div class="text-center">
        <a href="{{ route('partidos.index') }}" class="btn btn-secondary">Volver al listado</a>
        @can('edit-acta')
            <a href="{{ route('partidos.edit', $partido->id) }}" class="btn btn-warning">Editar Partido</a>
        @endcan
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
   @auth

@if(in_array(Auth::user()->rol, ['mantenimiento', 'capitan']))
    <div class="mb-4 text-end">
        <a href="{{ route('partidos.create') }}" class="btn btn-success btn-lg shadow-sm">
            <i class="bi bi-plus-circle me-2"></i> Crear Partido
        </a>
    </div>
@endif
@endauth
<div class="row g-4">
    @foreach($partidos as $partido)
    <div class="col-12">
        <div class="card shadow p-4">
            {{-- Info secundaria (fecha, jornada, división) --}}
           <div class="row justify-content-center text-muted fs-6 mb-3 text-center">
    <div class="col-12 col-md-4 mb-1 mb-md-0">
        <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
    </div>
    <div class="col-12 col-md-4 mb-1 mb-md-0">
        Jornada: {{ $partido->jornada }}
    </div>
    <div class="col-12 col-md-4">
        División: {{ $partido->division }}
    </div>
</div>
            {{-- Título del partido --}}
<h2 class="text-center display-6 fw-bold mb-5" style="letter-spacing:1px;">
    {{ $partido->nombrePartido }}
</h2>
            {{-- Equipos y resultado centrado --}}
            <div class="row mb-3 fs-4 fw-bold align-items-center text-center">
             <div class="col-4 text-start">{{ $partido->equipo_local }}</div>
    <div class="col-4 text-primary">{{ $partido->resultado }}</div>
    <div class="col-4 text-end">{{ $partido->equipo_visitante }}</div>
            </div>            
            {{-- Botones de acción --}}
        
          <td>
    <div class="d-flex justify-content-center gap-1 mt-2">
        <a href="{{ route('partidos.show', $partido->id) }}" class="btn btn-sm btn-outline-info" title="Ver">
            <i class="bi bi-eye"></i>
        </a>

        @can('update', $partido)
            <a href="{{ route('partidos.edit', $partido->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                <i class="bi bi-pencil"></i>
            </a>
        @endcan

        @can('delete', $partido)
            <form action="{{ route('partidos.destroy', $partido->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este partido?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        @endcan
    </div>
</td>
        
        </div>
    </div>
    @endforeach
</div>

{{-- Paginación --}}
<div class="mt-4">
    {{ $partidos->links() }}
</div>

@endsection

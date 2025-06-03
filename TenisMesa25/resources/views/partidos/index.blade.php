@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Partidos</h1>

   @auth
    @if(in_array(Auth::user()->rol, ['mantenimiento', 'capitan']))
        <a href="{{ route('partidos.create') }}">Crear Partido</a>
    @endif
@endauth

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre Partido</th>
                <th>Nombre Visitante</th>
                <th>Fecha</th>
                <th>Jornada</th>
                <th>División</th>
                <th>Equipo</th>
                <th>Resultado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partidos as $partido)
            <tr>
                <td>{{ $partido->nombrePartido }}</td>
                <td>{{ $partido->nombre }}</td>
                <td>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</td>
                <td>{{ $partido->jornada }}</td>
                <td>{{ $partido->division }}</td>
                <td>{{ $partido->equipo }}</td>
                <td>{{ $partido->resultado }}</td>
                <td>
                    {{-- Ver Acta --}}
                    <a href="{{ route('partidos.show', $partido->id) }}" class="btn btn-info btn-sm">Ver Acta</a>

                    {{-- Editar --}}
                    @can('update', $partido)
                        <a href="{{ route('partidos.edit', $partido->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    @endcan

                    {{-- Eliminar --}}
                    @can('delete', $partido)
                        <form action="{{ route('partidos.destroy', $partido->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este partido?')">Eliminar</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $partidos->links() }} {{-- Paginación --}}
</div>
@endsection

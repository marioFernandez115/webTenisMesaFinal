@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6 space-y-4">
    <div class="flex justify-between items-center border-b pb-2">
        <div>
            <h1 class="text-xl font-semibold">Acta del Partido</h1>
            <p class="text-sm text-gray-500">Temporada: xx/xx | Jornada: "X"</p>
        </div>
        <div class="text-right">
            <p class="text-gray-600">Categoría: <strong>División "x"</strong></p>
            <p class="text-gray-600">Fecha: <strong>"x"</strong></p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <p><strong>Local:</strong> "x"</p>
            <p><strong>Árbitro:</strong> <span class="text-red-500 font-bold">"X"</span></p>
        </div>
        <div>X
            <p><strong>Visitante:</strong> "X"</p>

        </div>
    </div>

    <!-- Tabla de enfrentamientos -->
    <div class="overflow-auto">
        <table class="min-w-full text-sm text-left border mt-4">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">Jugador ABC</th>
                    <th class="px-4 py-2">Jugador XYZ</th>
                    <th class="px-4 py-2">Juego 1</th>
                    <th class="px-4 py-2">Juego 2</th>
                    <th class="px-4 py-2">Juego 3</th>
                    <th class="px-4 py-2">Juego 4</th>
                    <th class="px-4 py-2">Juego 5</th>
                    @can('edit-acta') <!-- Usuarios con rol mantenimiento o capitán -->
                        <th class="px-4 py-2">Acción</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($partidos as $partido)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $partido->jugador_local }}</td>
                    <td class="px-4 py-2">{{ $partido->jugador_visitante }}</td>
                    @for ($i = 1; $i <= 5; $i++)
                        <td class="px-4 py-2">
                            @can('edit-acta')
                                <input type="number" name="juegos[{{ $partido->id }}][{{ $i }}]" value="{{ $partido->{'juego_'.$i} }}" class="w-12 border-gray-300 rounded" />
                            @else
                                {{ $partido->{'juego_'.$i} }}
                            @endcan
                        </td>
                    @endfor
                    @can('edit-acta')
                    <td class="px-4 py-2">
                        <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Guardar</button>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Resultado Final -->
    <div class="mt-6 text-center">
        <p class="text-xl font-bold text-gray-800">Ganador: {{ $acta->ganador }}</p>
        <p class="text-lg text-gray-600">Resultado General: {{ $acta->resultado_general }}</p>
    </div>
</div>
@endsection

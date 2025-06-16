
{{-- Nombre del partido --}}
<div class="mb-3">
    <label for="nombrePartido" class="form-label">Nombre del Partido</label>
    <input type="text" class="form-control" id="nombrePartido" name="nombrePartido"
        value="{{ old('nombrePartido', $partido->nombrePartido ?? '') }}" required>
</div>
{{-- Equipo Local (solo puede ser uno de los dos) --}}
<div class="mb-3">
    <label for="equipo_local" class="form-label">Equipo Local</label>
    <select name="equipo_local" id="equipo_local" class="form-select" required>
        <option value="">-- Seleccionar Equipo Local --</option>
        <option value="Rivas (Parque Sureste)" {{ old('equipo_local', $partido->equipo_local ?? '') == 'Rivas (Parque Sureste)' ? 'selected' : '' }}>
            Rivas (Parque Sureste)
        </option>
        <option value="Rivas Promesas (Colegio Cigüeñas)" {{ old('equipo_local', $partido->equipo_local ?? '') == 'Rivas Promesas (Colegio Cigüeñas)' ? 'selected' : '' }}>
            Rivas Promesas (Colegio Cigüeñas)
        </option>
    </select>
</div>

{{-- Equipo Visitante --}}
<div class="mb-3">
    <label for="equipo_visitante" class="form-label">Equipo Visitante</label>
    <input type="text" class="form-control" id="equipo_visitante" name="equipo_visitante"
        value="{{ old('equipo_visitante', $partido->equipo_visitante ?? '') }}" required>
</div>

{{-- Fecha --}}
<div class="mb-3">
    <label for="fecha" class="form-label">Fecha</label>
    <input type="date" class="form-control" id="fecha" name="fecha"
        value="{{ old('fecha', isset($partido->fecha) ? $partido->fecha->format('Y-m-d') : '') }}" required>
</div>

{{-- Jornada --}}
<div class="mb-3">
    <label for="jornada" class="form-label">Jornada</label>
    <select name="jornada" id="jornada" class="form-select" required>
        @for ($i = 1; $i <= 22; $i++)
            <option value="{{ $i }}" {{ old('jornada', $partido->jornada ?? '') == $i ? 'selected' : '' }}>
                {{ $i }}
            </option>
        @endfor
    </select>
</div>

{{-- División --}}
<div class="mb-3">
    <label for="division" class="form-label">División</label>
    <select name="division" id="division" class="form-select" required>
        <option value="">-- Seleccionar División --</option>
        @foreach([
            'Superdivisión (Femenina)', 'Superdivisión (Masculina)',
            'División de Honor (Femenina)', 'División de Honor (Masculina)',
            'Primera División (Femenina)', 'Primera División (Masculina)',
            'Segunda División (Femenina)', 'Segunda División (Masculina)',
            'Tercera División (Femenina)', 'Tercera División (Masculina)',
            'Territorial 1ª (T1)', 'Territorial 2ª (T2)', 'Territorial 3ª (T3)'
        ] as $div)
            <option value="{{ $div }}" {{ old('division', $partido->division ?? '') == $div ? 'selected' : '' }}>
                {{ strpos($div, 'Territorial') !== false ? 'Autonómico' : 'Nacional' }} - {{ $div }}
            </option>
        @endforeach
    </select>
</div>

{{-- Árbitro --}}
<div class="form-group">
    <label for="arbitro">Árbitro</label>
    <input type="text" name="arbitro" id="arbitro" class="form-control" 
           value="{{ old('arbitro', $partido->arbitro ?? '') }}" placeholder="Ingrese nombre del árbitro">
</div>

{{-- Resultado --}}
<div class="mb-3">
    <label for="resultado" class="form-label">Resultado</label>
    <input type="text" class="form-control" id="resultado" name="resultado"
        value="{{ old('resultado', $partido->resultado ?? '') }}" required>
</div>

{{-- Lugar del partido --}}
<div class="mb-3">
    <label for="estado" class="form-label">Lugar del partido</label>
    <select name="estado" id="estado" class="form-select" required>
        <option value="">-- Seleccionar --</option>
        <option value="local" {{ old('estado', $partido->estado ?? '') == 'local' ? 'selected' : '' }}>Casa</option>
        <option value="visitante" {{ old('estado', $partido->estado ?? '') == 'visitante' ? 'selected' : '' }}>Fuera</option>
    </select>
</div>


{{-- Detalles del Acta --}}
<hr class="my-4">
<h5 class="mb-3">Detalles del Acta (6 Partidos)</h5>

@php
    $ordenLocal = ['A', 'B', 'C', 'A', 'C', 'B'];
    $ordenVisitante = ['Y', 'X', 'Z', 'X', 'Y', 'Z'];
@endphp

@foreach ($ordenLocal as $index => $letraLocal)
    <div class="border rounded p-3 mb-3 bg-light">
        <p class="mb-2 fw-bold">Partido {{ $index + 1 }}: {{ $letraLocal }} vs {{ $ordenVisitante[$index] }}</p>

        {{-- Campo oculto para el id del detalle (solo en edición) --}}
        @if(isset($acta[$index]['id']))
            <input type="hidden" name="detalles[{{ $index }}][id]" value="{{ $acta[$index]['id'] }}">
        @endif

        <input type="hidden" name="detalles[{{ $index }}][orden_local]" value="{{ $letraLocal }}">
        <input type="hidden" name="detalles[{{ $index }}][orden_visitante]" value="{{ $ordenVisitante[$index] }}">

        {{-- Jugador Local para este partido --}}
        <div class="mb-2">
            <label class="form-label">Jugador Local ({{ $letraLocal }})</label>
            <select name="detalles[{{ $index }}][usuario_local_id]" class="form-select" required>
                <option value="">-- Seleccionar jugador --</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}"
                        {{ old("detalles.$index.usuario_local_id", $acta[$index]['usuario_local_id'] ?? '') == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nombreyapellidos }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- Jugador Visitante --}}
        <div class="mb-2">
            <label class="form-label">Jugador Visitante ({{ $ordenVisitante[$index] }})</label>
            <input type="text" name="detalles[{{ $index }}][jugador_visitante]" class="form-control"
                value="{{ old("detalles.$index.jugador_visitante", $acta[$index]['jugador_visitante'] ?? '') }}"
                placeholder="Nombre completo">
        </div>
        {{-- Juegos --}}
        @for ($j = 1; $j <= 6; $j++)
            <div class="mb-2">
                <label class="form-label">Juego {{ $j }}</label>
                <input type="text" name="detalles[{{ $index }}][juego_{{ $j }}]" class="form-control"
                    value="{{ old("detalles.$index.juego_$j", $acta[$index]['juego_'.$j] ?? '') }}"
                    placeholder="Ej: 11-08"
                    pattern="^\d{1,2}-\d{1,2}$"
                    title="Formato: número-número, ej. 11-08">
            </div>
        @endfor
    </div>
@endforeach

{{-- Botón --}}
<div class="mb-4 text-end">
    <button type="submit" class="btn btn-success">{{ $btnText }}</button>
</div>
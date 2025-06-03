@extends('layouts.app')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        // Select2 para los selects de jugadores_locales (varios con name="jugadores_locales[x]")
        $('select[name^="jugadores_locales"]').select2({
            placeholder: "Selecciona un jugador",
            width: '100%'
        });

        // Select2 para liga e instalación si existen en el formulario
        $('#id_liga, #id_instalacion').select2({
            placeholder: "Selecciona una opción",
            width: '100%'
        });
    });
</script>
@endpush

<div class="container">
    <h1>Crear Partido</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Atención!</strong> Hay errores en el formulario.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('partidos.store') }}" method="POST">
        @csrf

        @include('partidos._form', [
            'usuarios' => $usuarios,
            'ligas' => $ligas,
            'jornadas' => $jornadas,
            'acta' => $acta ?? [],
            'btnText' => 'Crear Partido'
        ])
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Eventos</h2>
    @auth
        @if(auth()->user()->rol === 'mantenimiento' || auth()->user()->rol === 'admin_events')
            <a href="{{ route('admin.evento.create') }}" class="btn btn-success btn-lg animate__animated animate__pulse animate__infinite">
                Crear Evento
            </a>
        @endif
    @endauth
</div>

    @foreach($eventos as $evento)
        <div class="card mb-4 shadow-sm animate__animated animate__fadeInUp">
           @if($evento->imagen)
    <img src="{{ asset('img/ImagenNoticiasEventos/' . $evento->imagen) }}" class="card-img-top" style="max-height:200px; object-fit:cover;">
@endif

            <div class="card-body">
                <h4 class="card-title">{{ $evento->titulo }}</h4>
                <p class="card-text">{{ Str::limit($evento->descripcion, 150) }}</p>
                <p class="card-text"><small class="text-muted">📅 {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</small></p>

               <div class="d-flex gap-2">
    <a href="{{ route('admin.evento.show', $evento->id) }}" class="btn btn-info btn-sm animate__animated animate__fadeInLeft">Ver</a>

    @if(auth()->user() && (auth()->user()->rol === 'mantenimiento' || auth()->user()->rol === 'admin_events'))
        <a href="{{ route('admin.evento.edit', $evento->id) }}" class="btn btn-warning btn-sm animate__animated animate__fadeIn">Editar</a>
        <form action="{{ route('admin.evento.destroy', $evento->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este evento?')" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm animate__animated animate__fadeInRight">Eliminar</button>
        </form>
    @endif
</div>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $eventos->links() }}
    </div>
</div>
@endsection

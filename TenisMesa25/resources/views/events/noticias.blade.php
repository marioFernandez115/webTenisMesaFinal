@extends('layouts.app')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Noticias</h2>
        <a href="{{ route('admin.noticia.create') }}" class="btn btn-success btn-lg animate__animated animate__pulse animate__infinite">
            Crear Noticia
        </a>
    </div>

    @foreach($noticias as $noticia)
        <div class="card mb-4 shadow-sm animate__animated animate__fadeInUp" id="noticia-card-{{ $noticia->id }}">
            @if($noticia->imagen)
                <img src="{{ asset('storage/' . $noticia->imagen) }}" class="card-img-top" style="max-height:200px; object-fit:cover;">
            @endif

            <div class="card-body">
                <h4 class="card-title">{{ $noticia->titulo }}</h4>
                <p class="card-text text-truncate" style="max-height: 4.5em; overflow: hidden;">{{ $noticia->descripcion }}</p>
                <p class="card-text"><small class="text-muted">📅 {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</small></p>

                <div class="d-flex gap-2">
    <a href="{{ route('admin.noticia.show', $noticia->id) }}" class="btn btn-info btn-sm animate__animated animate__fadeInLeft">Ver</a>

    @if(auth()->user() && (auth()->user()->rol === 'mantenimiento' || auth()->user()->rol === 'admin_events'))
        <a href="{{ route('admin.noticia.edit', $noticia->id) }}" class="btn btn-warning btn-sm animate__animated animate__fadeIn">Editar</a>

        <form action="{{ route('admin.noticia.destroy', $noticia->id) }}" method="POST" class="d-inline" onsubmit="return eliminarConAnimacion(event, {{ $noticia->id }})">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm animate__animated animate__fadeInRight">Eliminar</button>
        </form>
    @endif
</div>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-center mt-4">
        {{ $noticias->links() }}
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endpush

@push('scripts')
<script>
    function eliminarConAnimacion(event, id) {
        event.preventDefault();
        const card = document.getElementById('noticia-card-' + id);
        card.classList.remove('animate__fadeInUp');
        card.classList.add('animate__fadeOutLeft');

        setTimeout(() => {
            event.target.submit();
        }, 600);
    }
</script>
@endpush

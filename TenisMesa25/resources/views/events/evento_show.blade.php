@extends('layouts.app')

@section('content')
<div class="container py-5 animate__animated animate__fadeIn">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-info text-white">
            <h3 class="mb-0">{{ $evento->titulo }}</h3>
        </div>
        <div class="card-body">

            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</p>

            @if($evento->imagen)
    <img src="{{ asset('img/ImagenNoticiasEventos/' . $evento->imagen) }}" class="card-img-top" style="max-height:200px; object-fit:cover;">
@endif

            <p class="mt-3">{{ $evento->descripcion }}</p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.eventos') }}" class="btn btn-secondary">Volver</a>
@auth
    @if(auth()->user()->rol === 'mantenimiento' || auth()->user()->rol === 'admin_events')
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editEventoModal">Editar</button>
    @endif
@endauth
            </div>

        </div>
    </div>
</div>

<!-- Modal de edición -->
<div class="modal fade" id="editEventoModal" tabindex="-1" aria-labelledby="editEventoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editEventoModalLabel">Editar Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.evento.update', $evento->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $evento->titulo }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ $evento->descripcion }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $evento->fecha }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagen actual:</label><br>
                        @if($evento->imagen)
                            <img src="{{ asset('storage/' . $evento->imagen) }}" class="img-thumbnail mb-2" style="max-width: 200px;">
                        @else
                            <p class="text-muted">No hay imagen</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label">Nueva Imagen (opcional)</label>
                        <input type="file" name="imagen" id="imagen" class="form-control">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (necesario para el modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

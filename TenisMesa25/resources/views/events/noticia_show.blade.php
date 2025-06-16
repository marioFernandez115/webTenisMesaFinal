@extends('layouts.app')

@section('content')
<div class="container py-5 animate__animated animate__fadeIn">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-info text-white">
            <h3 class="mb-0">{{ $noticia->titulo }}</h3>
        </div>
        <div class="card-body">

            <p class="text-muted"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</p>

            @if($noticia->imagen)
                <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="Imagen de la noticia" class="img-fluid rounded mb-3" style="max-width: 400px;">
            @endif

            <p class="mt-3">{{ $noticia->descripcion }}</p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.noticias') }}" class="btn btn-secondary animate__animated animate__fadeInLeft">Volver</a>
                <button class="btn btn-warning animate__animated animate__fadeInRight" data-bs-toggle="modal" data-bs-target="#editNoticiaModal">Editar</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal de edición -->
<div class="modal fade" id="editNoticiaModal" tabindex="-1" aria-labelledby="editNoticiaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg animate__animated animate__zoomIn">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editNoticiaModalLabel">Editar Noticia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.noticia.update', $noticia->id) }}" method="POST" enctype="multipart/form-data" id="noticia-edit-form">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $noticia->titulo }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ $noticia->descripcion }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $noticia->fecha }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagen actual:</label><br>
                        @if($noticia->imagen)
                            <img src="{{ asset('storage/' . $noticia->imagen) }}" class="img-thumbnail mb-2" style="max-width: 200px;">
                        @else
                            <p class="text-muted">No hay imagen</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label">Nueva Imagen (opcional)</label>
                        <input type="file" name="imagen" id="imagen" class="form-control">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg animate__animated animate__pulse animate__infinite">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endpush

@push('scripts')
<!-- Bootstrap Bundle JS para el modal -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("noticia-edit-form");
        form.classList.add("animate__animated", "animate__fadeInUp");
    });
</script>
@endpush

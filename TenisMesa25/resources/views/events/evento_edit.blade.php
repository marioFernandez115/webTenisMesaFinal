@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Editar Evento</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.evento.update', $evento->id) }}" method="POST" enctype="multipart/form-data" id="evento-form">
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
                                <div class="text-muted">No hay imagen</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Nueva Imagen (opcional)</label>
                            <input type="file" name="imagen" id="imagen" class="form-control">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg animate__animated animate__pulse animate__infinite">Actualizar</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Animación JS al cargar -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("evento-form");
        form.classList.add("animate__animated", "animate__fadeInUp");
    });
</script>
@endsection

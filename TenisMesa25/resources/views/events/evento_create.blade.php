@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Crear Evento</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.evento.store') }}" method="POST" enctype="multipart/form-data" id="evento-form">
                    @csrf

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" name="imagen" id="imagen" class="form-control">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg animate__animated animate__pulse animate__infinite">Guardar</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<!-- Animación de entrada -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("evento-form");
        form.classList.add("animate__animated", "animate__fadeInUp");
    });
</script>
@endsection

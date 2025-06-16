@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 animate__animated animate__fadeInUp">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Crear Noticia</h4>
                </div>
                <div class="card-body">

                    <form id="noticiaForm" action="{{ route('admin.noticia.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" required placeholder="Escribe el título de la noticia">
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required placeholder="Descripción detallada"></textarea>
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
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("noticiaForm");
        form.classList.add("animate__animated", "animate__fadeInUp");
    });
</script>
@endpush

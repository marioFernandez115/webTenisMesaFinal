@extends('layouts.app')

@section('content')


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success shadow-sm text-center">
                <h4 class="mb-2">¡Bienvenido, {{ Auth::user()->nombreyapellidos }} <i class="fa-solid fa-table-tennis-paddle-ball"></i>!</h4>
                <p class="mb-0">Ya has iniciado sesión correctamente.</p>
            </div>
        </div>
    </div>

    <div class="text-center mb-5">
        <h1 class="display-3 fw-bold gradient-text animate-pop">CLUB DEPORTIVO <br><span class="text-stroke">TENIS DE MESA RIVAS</span></h1>
       
    </div>

    <div class="text-center mb-5">
        <video 
            width="1200" 
            height="500" 
            autoplay 
            loop 
            muted 
            playsinline 
            class="rounded shadow" 
            style="object-fit: contain; pointer-events: none; background-color: #000;">
            <source src="{{ asset('img/videoInicio.mp4') }}" type="video/mp4">
            Tu navegador no soporta la reproducción de videos.
        </video>
    </div>

    <div class="row">
    <div class="col-md-6 mb-3">
        <h4 class="text-secondary">Últimos Eventos</h4>
        <div class="card shadow-sm">
            <img src="{{ asset('img/EventosPhoto.png') }}" class="card-img-top" alt="Evento de tenis de mesa" height="400" width="250">
            <div class="card-body">
                <h5 class="card-title">Eventos Nuevos Tenis de Mesa Rivas Vaciamadrid!</h5>
                
                <a href="{{ route('admin.eventos') }}" class="btn btn-primary">Ver eventos</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <h4 class="text-secondary">Noticias del Club</h4>
        <div class="card shadow-sm">
            <img src="{{ asset('img/NoticiasPhoto.png') }}" class="card-img-top" alt="Noticia del club" height="400" width="250">
            <div class="card-body">
                <h5 class="card-title">Noticias Nuevas Tenis de Mesa Rivas Vaciamadrid!</h5>
                <a href="{{ route('admin.noticias') }}" class="btn btn-primary">Ver Noticias</a>
            </div>
        </div>
    </div>
</div>
@endsection
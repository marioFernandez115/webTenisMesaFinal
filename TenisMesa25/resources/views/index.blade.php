
@extends('layouts.app')
@section('title', 'Inicio | Tenis de mesa')

@section('header')

@endsection

@section('content')
<div class="container py-5">

    <div class="text-center mb-4">
        <h1 class="display-4 text-primary">Club Deportivo Tenis de Mesa Rivas</h1>
        <p class="lead">Este es el lugar donde encontrarás todo lo relacionado con el tenis de mesa en Rivas Vaciamadrid: noticias, eventos y mucho más.</p>
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
    <div class="text-center mb-5">
        <h3 class="text-secondary">¿Te apasiona el tenis de mesa?</h3>
        <p>Únete a nuestro club y forma parte de esta gran familia deportiva.</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">¡Registrate!</a>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <h4 class="text-secondary">Últimos Eventos</h4>
            <div class="card">
                <img src="{{ asset('img/logoTenisDeMesa.jpg') }}" class="card-img-top" alt="Evento de tenis de mesa" height="400" width="250">
                <div class="card-body">
                    <h5 class="card-title">Ver todos los Eventos Proximos</h5>
                    <p class="card-text">¡Entra y informate sobre Proximos eventos!</p>
                    <a href="{{route('login') }}" class="btn btn-primary">Iniciar sesion para ver Eventos</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <h4 class="text-secondary">Noticias del Club</h4>
            <div class="card">
                <img src="{{ asset('img/logoTenisDeMesa.jpg') }}" class="card-img-top" alt="Noticia del club" height="400" width="250">
                <div class="card-body">
                    <h5 class="card-title">Ver las nuevas noticias</h5>
                    <p class="card-text">¡Entra y informate sobre las nuevas Noticias!</p>
                    <a href="{{route('login') }}" class="btn btn-primary">Iniciar sesion para ver Noticas</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
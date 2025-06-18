@extends('layouts.app')
@section('title', 'Inicio | Tenis de mesa')

@section('header')
<!-- Puedes añadir aquí cabeceras específicas -->
@endsection

@section('content')
<div class="container py-5">

    <div class="text-center mb-5 fade-in-super">
    <h1 class="display-3 fw-bold gradient-text animate-pop">CLUB DEPORTIVO <br><span class="text-stroke">TENIS DE MESA RIVAS</span></h1>
    
</div>

   <div class="video-responsive text-center mb-5">
    <video 
        autoplay 
        loop 
        muted 
        playsinline 
        class="rounded shadow"
        style="object-fit: contain; pointer-events: none; background-color: #000; width: 100%; height: 100%; position: absolute; top: 0; left: 0;">
        <source src="{{ asset('img/videoInicio.mp4') }}" type="video/mp4">
        Tu navegador no soporta la reproducción de videos.
    </video>
</div>

    <div class="text-center mb-5 fade-in" style="transition-delay: 0.6s;">
        <h3 class="text-secondary">¿Te apasiona el tenis de mesa?</h3>
        <p>Únete a nuestro club y forma parte de esta gran familia deportiva.</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg btn-animated">¡Regístrate!</a>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3 fade-slide-up">
            <h4 class="text-secondary">Últimos Eventos</h4>
            <div class="card shadow-sm">
                <img src="{{ asset('img/EventosPhoto.png') }}" class="card-img-top" alt="Evento de tenis de mesa" style="height:400px; object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title">Ver todos los Eventos Próximos</h5>
                    <p class="card-text">¡Entra y infórmate sobre próximos eventos!</p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-animated">Iniciar sesión para ver Eventos</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3 fade-slide-up" style="transition-delay: 0.2s;">
            <h4 class="text-secondary">Noticias del Club</h4>
            <div class="card shadow-sm">
                <img src="{{ asset('img/NoticiasPhoto.png') }}" class="card-img-top" alt="Noticia del club" style="height:400px; object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title">Ver las nuevas noticias</h5>
                    <p class="card-text">¡Entra y infórmate sobre las nuevas noticias!</p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-animated">Iniciar sesión para ver Noticias</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para animar los cards al hacer scroll -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fadeSlideElems = document.querySelectorAll('.fade-slide-up');

        function checkVisibility() {
            const triggerBottom = window.innerHeight * 0.9;

            fadeSlideElems.forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < triggerBottom) {
                    el.classList.add('visible');
                }
            });
        }

        window.addEventListener('scroll', checkVisibility);
        checkVisibility(); // también al cargar
    });
</script>

@endsection

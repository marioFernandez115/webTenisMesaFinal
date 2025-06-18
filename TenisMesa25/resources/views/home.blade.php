@extends('layouts.app')

@section('content')


<div class="container py-5">
<div class="row justify-content-center">
    <div class="col-md-10">
        <div id="bienvenida" class="custom-welcome-box shadow-lg text-center rounded-4 p-5" style="opacity: 0;">
            <h2 id="bienvenidaTexto" class="fw-bold display-5 mb-3 text-white"></h2>
            <p class="lead text-light mb-0">Ya has iniciado sesión correctamente. ¡A jugar! 🏓</p>
        </div>
    </div>
</div>

    <div class="text-center mb-5">
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
<script>
        document.addEventListener("DOMContentLoaded", () => {
        // Aparece la caja con efecto
        gsap.to("#bienvenida", {
            opacity: 1,
            y: -20,
            duration: 1.2,
            ease: "power4.out"
        });

        // Escribir letra a letra el saludo
        const texto = "¡Bienvenido, {{ Auth::user()->nombreyapellidos }}!";
        const textoElemento = document.getElementById("bienvenidaTexto");
        let i = 0;

        function escribir() {
            if (i < texto.length) {
                textoElemento.textContent += texto.charAt(i);
                i++;
                setTimeout(escribir, 60);
            } else {
                lanzarConfeti();
            }
        }

        escribir();

        // 🎉 Confeti animado
        function lanzarConfeti() {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 }
            });
        }
    });
</script>
@endsection
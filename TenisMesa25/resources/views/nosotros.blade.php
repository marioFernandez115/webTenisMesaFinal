
@extends('layouts.app')
@section('title', 'Sobre Nosotros | Tenis de mesa')

@section('header')
@endsection

@section('content')

<style>
    .imgNosotros {
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
        transition: transform 0.5s cubic-bezier(.4,2,.6,1), box-shadow 0.5s;
    }
    .imgNosotros:hover {
        transform: scale(1.05) rotate(-2deg);
        box-shadow: 0 16px 48px rgba(0,0,0,0.25);
    }
    .section-card {
        background: #f8f9fa;
        border-radius: 18px;
        padding: 2rem 2rem 1.5rem 2rem;
        box-shadow: 0 4px 24px rgba(0,120,255,0.08);
        margin-bottom: 1.5rem;
        transition: box-shadow 0.4s;
    }
    .section-card:hover {
        box-shadow: 0 8px 32px rgba(0,120,255,0.18);
    }
    /* Animaciones */
    .fade-in-up {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s, transform 0.8s;
    }
    .fade-in-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<div class="container py-5 text-center">
    <!-- Título -->
    <h1 class="display-4 fade-in-up" style="color: #0078FF; font-weight: 800; text-shadow: 0 1px 3px rgba(0,0,0,0.2);">
        Sobre Nosotros
    </h1>
    <p class="lead fade-in-up">
        🏓 En el Club de Tenis de Mesa Rivas, vivimos la emoción del juego punto a punto.
        Formamos parte de una comunidad vibrante donde entrenar, competir y disfrutar
        se convierte en una experiencia inolvidable. ¡Súmate a nuestro equipo! 🏓
    </p>

    <!-- Logo principal -->
    <div class="my-5 fade-in-up">
        <img src="{{ asset('img/logoTenisDeMesa.jpg') }}" alt="Logo Club Tenis de Mesa Rivas" class="imgNosotros img-fluid" style="max-width: 320px;">
        <p class="mt-3 text-secondary">
            Nuestro escudo representa la pasión, el esfuerzo y la unión de todos los que formamos parte del club.<br>
           impulsando el tenis de mesa en Rivas y la Comunidad de Madrid.
        </p>
    </div>
      
      <!-- Nuestra Comunidad -->
    <div class="row my-5 align-items-center fade-in-up">
        <div class="col-md-6">
            <div class="section-card text-start">
                <h2 class="display-5 text-primary">Nuestra Comunidad</h2>
                <p class="lead">
                    Somos más que un club: somos una familia unida por la pasión por el tenis de mesa.
                    Compartimos noticias, organizamos eventos y fomentamos un entorno inclusivo
                    donde jugadores de todos los niveles pueden crecer y disfrutar del deporte.
                </p>
                <ul>
                    <li>Actividades sociales y deportivas durante todo el año.</li>
                    <li>Apoyo a la cantera y a los nuevos jugadores.</li>
                    <li>Colaboración con escuelas y asociaciones locales.</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <img class="imgNosotros img-fluid" src="{{ asset('img/Comunidad.jpg') }}" alt="Comunidad Tenis de Mesa">
        </div>
    </div>
   <!-- Nuestro Equipo -->
    <div class="row my-5 align-items-center fade-in-up">
        <div class="col-md-6 text-center order-md-1">
            <img class="imgNosotros img-fluid" src="{{ asset('img/Campo.jpg') }}" alt="Equipo Tenis de Mesa">
        </div>
        <div class="col-md-6 order-md-2">
            <div class="section-card text-start">
                <h2 class="display-5 text-primary">Nuestro Equipo</h2>
                <p class="lead">
                    Entrenadores, jugadores y colaboradores comprometidos con el crecimiento del tenis de mesa.
                    Nos esforzamos en cada entrenamiento y en cada partido, trabajando juntos con respeto,
                    esfuerzo y espíritu deportivo.
                </p>
                <ul>
                    <li>Entrenadores titulados y con experiencia nacional.</li>
                    <li>Equipos en todas las categorías: desde base hasta nacional.</li>
                    <li>Valores: respeto, superación, compañerismo y diversión.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    // Animación JS: fade-in-up al hacer scroll
    document.addEventListener('DOMContentLoaded', function() {
        function revealOnScroll() {
            document.querySelectorAll('.fade-in-up').forEach(function(el) {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight - 60) {
                    el.classList.add('visible');
                }
            });
        }
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll();
    });
</script>
@endsection
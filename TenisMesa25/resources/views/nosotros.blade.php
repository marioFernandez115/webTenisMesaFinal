@extends('layouts.app')
@section('title', 'Sobre Nosotros | Tenis de mesa')

@section('header')
@endsection

@section('content')


<div class="container py-5 text-center">
    <!-- Título -->
   <h1 class="display-4 fade-up" style="color: #0078FF; font-weight: 800; text-shadow: 0 1px 3px rgba(0,0,0,0.2);">
  Sobre Nosotros
</h1>
    <p class="lead fade-up fade-delay-1">
        🏓 En el Club de Tenis de Mesa Rivas, vivimos la emoción del juego punto a punto.
        Formamos parte de una comunidad vibrante donde entrenar, competir y disfrutar
        se convierte en una experiencia inolvidable. ¡Súmate a nuestro equipo! 🏓
    </p>

    <!-- Nuestra Comunidad -->
    <div class="row my-5 align-items-center fade-up fade-delay-2">
        <div class="col-md-6">
            <div class="section-card text-start">
                <h2 class="display-5 text-primary">Nuestra Comunidad</h2>
                <p class="lead">
                    Somos más que un club: somos una familia unida por la pasión por el tenis de mesa.
                    Compartimos noticias, organizamos eventos y fomentamos un entorno inclusivo
                    donde jugadores de todos los niveles pueden crecer y disfrutar del deporte.
                </p>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <img class="imgNosotros img-fluid" src="{{ asset('img/comunidad.jpg') }}" alt="Comunidad Tenis de Mesa">
        </div>
    </div>

    <!-- Nuestro Equipo -->
    <div class="row my-5 align-items-center fade-up fade-delay-3">
        <div class="col-md-6 text-center order-md-1">
            <img class="imgNosotros img-fluid" src="{{ asset('img/equipo.jpg') }}" alt="Equipo Tenis de Mesa">
        </div>
        <div class="col-md-6 order-md-2">
            <div class="section-card text-start">
                <h2 class="display-5 text-primary">Nuestro Equipo</h2>
                <p class="lead">
                    Entrenadores, jugadores y colaboradores comprometidos con el crecimiento del tenis de mesa.
                    Nos esforzamos en cada entrenamiento y en cada partido, trabajando juntos con respeto,
                    esfuerzo y espíritu deportivo.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
